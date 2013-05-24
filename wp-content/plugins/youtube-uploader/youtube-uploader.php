<?php
/*
 Plugin Name: Youtube uploader
 Plugin URI: http://www.php-code.net/2010/07/youtube-uploader-wordpress-plugin/
 Description: Managing your YouTube videos in your wp-admin
 Author: Dan Harabor
 Version: 0.3
 Author URI: http://www.php-code.net/
 */


add_action('init', 'youtubeuploader_init');

function youtubeuploader_init() {
	@ini_set('upload_max_filesize', '500M');
	@ini_set('post_max_size', '500M');
	require_once('youtube_uploader.class.php');
	add_action('admin_menu', 'youtubeuploader_menu');
	wp_enqueue_script('jquery');
	wp_enqueue_script('myPluginScript', WP_PLUGIN_URL . '/youtube-uploader/youtubeuploader.js');
	add_thickbox();
	include(dirname(__FILE__).'/media-upload.php');
}

add_action('wp_ajax_update_youtube_video', 'youtubeuploader_update_video' );

function youtubeuploader_update_video(){
	$youtube_api = youtubeuploader_login();
	$update_data = $youtube_api->updateVideoData(array('title'=>$_POST['title'],'description'=>$_POST['description'],'keywords'=>$_POST['tags'],'category'=>$_POST['category'],'videoId'=>$_POST['videoId']));
	$updated_video_data = $youtube_api->formatVideoResponse($update_data['output']);
	echo get_youtube_item($updated_video_data,$_POST['type']);
	die();
}

function youtubeuploader_menu(){
	if (function_exists('add_submenu_page')){
		add_submenu_page('options-general.php','Youtube uploader','Youtube uploader','upload_files','youtubeuploader_menu','youtubeuploader_settings');
	}
}

function youtubeuploader_settings(){
	global $current_user;
	if($_POST['youtube_uploader_settings'] == 1){
		youtubeuploader_save_settings();
		echo '<div class="updated fade"><p>Settings saved</p></div>';
	}
	if (empty($settings)){
		$settings = youtubeuploader_get_settings();
	}
	?>
<div class="wrap">
<h2>Change your youtube uploader settings</h2>
</div>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="youtube_auth_options">
<table class="form-table">
	<tbody>
		<tr valign="top">
			<td scope="row"><label for="developerKey">Developer key</label></td>
			<td>
				<input type="text" class="regular-text"	value="<?php echo !empty($settings['developerKey'])?$settings['developerKey']:''?>"	id="developerKey" name="developerKey" /> 
				<span class="description">Get your <a href="http://code.google.com/apis/youtube/dashboard/"	target="_blank">developer key</a></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row" width="100"><label for="auth_options_label">Authentification</label></td>
			<td>
			<div id="auth_options_labels">
				<label title="authSessionToken" id="authSessionToken"><input type="radio" value="sessionToken" name="authType" <?php echo (!empty($settings['authType']) && $settings['authType']=='sessionToken')?'CHECKED':''?>>Use Auth Session Token</label> 
				<label title="authUsernamePassword"	id="authUsernamePassword"><input type="radio" value="usernamePassword" name="authType" <?php echo (!empty($settings['authType']) && $settings['authType']=='usernamePassword')?'checked="CHECKED"':''?>>Use Username/Password</label>
			</div>
			</td>
		</tr>
		<tr valign="top">
			<td width="100"></td>
			<td>
			<div id="auth_options">
				<div id="authSessionTokenOptions" style="<?php echo (!empty($settings['authType']) && $settings['authType']=='sessionToken')?'display:block':'display:none'?>">
					<? if (!empty($settings['sessionToken'])){ ?> 
					<span id="sessionTokenDescription">Your session token is : <?php echo $settings['sessionToken']?></span>
					<? } else {	?> 
					<span id="sessionTokenDescription">You will be asked to authorize the application only once. Click <a class="thickbox" href="<?php echo plugins_url().'/youtube-uploader/auth.php'?>?TB_iframe=true&amp;width=640&amp;height=450">here</a> to authorize the application</span> 
					<?
					}
					?> 
					<input type="hidden" name="sessionToken" id="sessionToken" value="<?php echo !empty($settings['sessionToken'])?$settings['sessionToken']:''?>">
				</div>
				<div id="authUsernamePasswordOptions" style="<?php echo (!empty($settings['authType']) && $settings['authType']=='usernamePassword')?'display:block':'display:none'?>">
					Login to youtube using your username and password. Don't use this option unless you are sure that no one else has access to your wordpress administration. 
					<br>Username : <label title="username"><input type="text" name="username" value="<?php echo (!empty($settings['username']))?$settings['username']:''?>"></label>
					<br>Password : <label title="password"><input type="password" name="password" value="<?php echo (!empty($settings['password']))?$settings['password']:''?>"></label>
				</div>
			</div>
			</td>
		</tr>

	</tbody>
</table>
<input class="button-primary" type="submit" value="Save settings" /> <input
	type="hidden" name="youtube_uploader_settings" value="1" /></form>
<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready(function($){
		$("#auth_options_labels label").each(function (i) {
			$(this).click(function(j){
				$("#auth_options div").css('display','none');
				thisid=$(this).attr('id');
				$('#'+$(this).attr('id')+'Options').css('display','block');
			});
		});
	});
	//]]>
	</script>
<?php
}

function youtubeuploader_save_settings(){
	global $current_user;
	get_currentuserinfo();
	$options['developerKey'] = $_POST['developerKey'];
	$options['authType'] = $_POST['authType'];
	if ($_POST['authType']=='usernamePassword'){
		$options['username'] = $_POST['username'];
	 $options['password'] = $_POST['password'];
	} else {
		$options['sessionToken'] = $_POST['sessionToken'];
	}
	foreach ($options as $key=>$value){
		$class[$key] = $value;
	}
	if (function_exists('update_user_meta')){
		update_user_meta($current_user->ID, 'youtube_uploader', $class);
	} else {
		update_usermeta($current_user->ID,'youtube_uploader', $class);
	}
}

function youtubeuploader_get_settings(){
	global $current_user;
	get_currentuserinfo();
	if (function_exists('get_user_meta')){
		$return = get_user_meta($current_user->ID,'youtube_uploader',true);
	} else {
		$return = get_usermeta($current_user->ID,'youtube_uploader');
	}
	return $return;
}

function get_youtube_item($mediaInfo,$type='html'){
	$tags='';
	$all_categories = youtube_uploader::getCategories();
	$embed_width = 480;
	$embed_height = 385;
	$insert_into_post_html = $html = '<object width="'.$embed_width.'" height="'.$embed_height.'"><param name="movie" value="http://www.youtube.com/v/'.$mediaInfo[0]['videoId'].'&hl=en_US&fs=1&rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$mediaInfo[0]['videoId'].'&hl=en_US&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$embedWidth.'" height="'.$embedHeight.'"></embed></object>';
	$return = "
	<div id='media_upload_content'>
	<table class='slidetoggle describe startclosed' style='display:block'>
		<thead class='media-item-info' id='media-head-youtube'>
		<tr>
			<td class='A1B1' id='thumbnail-head-youtube' rowspan='5'><img class='thumbnail' src='".$mediaInfo[0]['thumbnails']['default']."?r=".rand()."' alt='' /></td>
			<td><strong>Video id:</strong> ".$mediaInfo[0]['videoId']." (<span id='refreshvideo' style='display:none'>Refreshing</span><a href='javascript:;' onClick=\"youtubeRefresh('".$type."',this)\" >Refresh</a>)</td>
		</tr>
		<tr><td><strong>Status:</strong> ".$mediaInfo[0]['status']." ".ucfirst($mediaInfo[0]['reason'])."</td></tr>
		<tr><td><strong>Upload date:</strong>".(!empty($mediaInfo[0]['published'])?$mediaInfo[0]['published']:'')."</td></tr>

		<tr><td class='A1B1'></td></tr>
		</thead>
		<tbody>
		<tr><td colspan='2' class='imgedit-response' id='imgedit-response-youtube'></td></tr>
		<tr><td style='display:none' colspan='2' class='image-editor' id='image-editor-youtube'></td></tr>
		<tr class='post_title'>
			<th valign='top' scope='row' class='label'><label for='youtube_uploader_title'><span class='alignleft'>Title</span><span class='alignright'></span><br class='clear' /></label></th>
			<td class='field'><input type='text' class='text' id='youtube_uploader_title' name='youtube_uploader_title' value='".$mediaInfo[0]['title']."'/></td>
		</tr>
		<tr class='post_excerpt'>
			<th valign='top' scope='row' class='label'><label for='youtube_uploader_tags'><span class='alignleft'>Tags</span><span class='alignright'></span><br class='clear' /></label></th>
			<td class='field'><input type='text' class='text' id='youtube_uploader_tags' name='youtube_uploader_tags' value='".$mediaInfo[0]['tags']."'/></td>
		</tr>
		<tr class='post_content'>
			<th valign='top' scope='row' class='label'><label for='youtube_uploader_description'><span class='alignleft'>Description</span><span class='alignright'></span><br class='clear' /></label></th>
			<td class='field'><textarea type='text' id='youtube_uploader_description' name='youtube_uploader_description'>".$mediaInfo[0]['description']."</textarea></td>
		</tr>
        <tr class='post_content'>
			<th valign='top' scope='row' class='label'><label for='youtube_uploader_categories'><span class='alignleft'>Categories</span><span class='alignright'></span><br class='clear' /></label></th>
			<td class='field'>
			<select name='youtube_uploader_categories' id='youtube_uploader_categories'>";
			foreach ($all_categories as $category){
				$return.="<option value='".$category->Value."' ".(($category->Value==$mediaInfo[0]['category'])?'selected':'').">".$category->Description."</option>";
			}
			$return.="
</select>

			</td>
		</tr>
		<tr class='submit'><td></td><td class='savesend'><input type='submit' class='button' name='send' value='Insert into Post' onclick=\"insertIntoPost('".stripslashes(htmlspecialchars($insert_into_post_html))."');\"/> <span id='updateVideoLabel' style='display:none'>Updating</span><input type='button' name='updateYoutubeVideo' id='updateYoutubeVideo' value = 'Update video' onclick=\"updateYoutubeVideo('".$mediaInfo[0]['videoId']."','".$type."',this);\"/></td></tr>
	</tbody>
	</table>
	</div>
";
	echo $return;
}


function youtubeuploader_login(){
	$settings = youtubeuploader_get_settings();
	$youtube_api = new youtube_uploader(array('developerKey'=>$settings['developerKey']));
	if ($settings['authType']=='sessionToken'){
		$client_result = $youtube_api->setSessionToken($settings['sessionToken']);
	} elseif ($settings['authType']=='usernamePassword'){
		$client_result = $youtube_api->clientLoginAuth($settings['username'],$settings['password']);
	} 
	return $youtube_api;
}

?>
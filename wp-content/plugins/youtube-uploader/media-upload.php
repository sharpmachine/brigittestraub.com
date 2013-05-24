<?php
function youtube_wp_upload_tabs ($tabs) {
	$new_tab = array('youtube_uploader' => 'Youtube uploader');
	$ret = array_merge($tabs,$new_tab);
	return $ret;
}
add_filter('media_upload_tabs', 'youtube_wp_upload_tabs');

function media_upload_youtube_uploader() {
	return wp_iframe( 'media_youtube_uploader_form', $errors );
}

function media_upload_youtube_html(){
	return wp_iframe('media_youtube_html',$errors);
}

add_action('media_upload_youtube_uploader', 'media_upload_youtube_uploader');
add_action('media_upload_youtube_html','media_upload_youtube_html');
add_action('media_upload_youtube_update','media_upload_youtube_update');
add_action('get_youtube_item','get_youtube_item');

function media_youtube_uploader_form(){
	global $type, $tab;
	wp_enqueue_script('jquery');
	wp_enqueue_script('myPluginScript', WP_PLUGIN_URL . '/youtube-uploader/youtubeuploader.js');
	media_upload_header();
	$settings = youtubeuploader_get_settings();
	if (empty($settings['developerKey'])){
		?>
		You must choose a developer key from the settings page
		<?php
		exit;
	}

	$youtube_api = youtubeuploader_login(); 
	$step = $_REQUEST['step']?intval($_REQUEST['step']):1;
	if ($step==2){
		$browser_upload = $youtube_api->getUploadToken(array('title'=>$_POST['title'],'description'=>$_POST['description'],'keywords'=>$_POST['tags'],'category'=>$_POST['category']));
		if ($browser_upload['status']=='error'){
			$errorMsg = $browser_upload['status'];
			$step=1;
		}
		if (empty($browser_upload['url'])){
			$errorMsg = "Invalid youtube authentification";
			$step=1;
		}
		if (!esc_attr($_POST['title'])){
			$errorMsg = 'You must enter a title';
			$step=1;
		}
		if (!esc_attr($_POST['category'])){
			$errorMsg = 'You must enter a catgory';
			$step = 1;
		}
		
		
	}
	
	
	// If Mac and mod_security, no Flash. :(
	$flash = true;
	if ( false !== strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'mac') && apache_mod_loaded('mod_security') )
	$flash = false;

	$flash = apply_filters('flash_uploader', $flash);
	$post_id = isset($_REQUEST['post_id']) ? intval($_REQUEST['post_id']) : 0;
	$categories = $youtube_api->getCategories();
	if ($step==1){
		?>
<form name="f1" action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
	<input type="hidden" name="post_id" value="<?=$post_id?>"> 
	<input type="hidden" name="step" value="2">
	<h3 class="media-title">Upload videos on youtube:</h3>
	<div id="media-items"><? if (!empty($errorMsg)){?>
		<div id="message" class="updated fade">
			<p><?php echo $errorMsg ?></p>
		</div>
		<?php } ?>
		<div class="media-item media-blank" style="display: none;">
			<table class="describe">
				<tbody>
				<tr>
				<th valign="top" class="label" scope="row"><span class="alignleft">
					<label for="title">Username</label></span> 
					<span class="alignright"><abbr class="required" title="required">*</abbr></span>
				</th>
				<td class="field">
					<input type="text" aria-required="true" value="" name="title" id="title">
				</td>
				</tr>
	</tbody>
</table>
</div>
<div class="media-item media-blank"><b><?php echo !empty($youtube_api->username)?'Upload video as '.$youtube_api->username:''?></b></div>
<div class="media-item media-blank">
<table class="describe">
	<tbody>
		<tr>
			<th valign="top" class="label" scope="row">
				<span class="alignleft"><label for="title">Title</label></span> 
				<span class="alignright"><abbr class="required" title="required">*</abbr></span>
			</th>
			<td class="field">
				<input type="text" aria-required="true" value="<?php echo esc_attr($_POST['title'])?>" name="title" id="title"></td>
			</tr>
		<tr>
			<th valign="top" class="label" scope="row">
				<span class="alignleft"><label for="description">Description</label></span>
			</th>
			<td class="field"><textarea name="description" id="description"><?php echo esc_attr($_POST['description'])?></textarea></td>
		</tr>
		<tr>
			<th valign="top" class="label" scope="row">
				<span class="alignleft"><label for="tags">Tags</label></span></th>
			<td class="field"><input type="text" name="tags" id="tags" value="<?php echo esc_attr($_POST['tags'])?>"></td>
		</tr>
		<tr>
			<th valign="top" class="label" scope="row"><span class="alignleft"><label
				for="category">Categories</label></span> <span class="alignright"><abbr
				class="required" title="required">*</abbr></span></th>
			<td class="field"><select name="category">
			<?php
			foreach ($categories as $category){
			?>
				<option name="<?=$category->Value?>" <?php echo ($_POST['category']==$category->Value)?'selected':''?>><?=$category->Value?></option>
			<?php
			}
			?>
			</select></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="Next" name="nextbutton"	class="button">
			</td>
		</tr>
	</tbody>
</table>
</div>
</div>
</form>
			<?php
	} else {
		//Youtube doesn't like | in their next_url so we need to replace with something else
		$auth_string = "auth_cookie=".((is_ssl())?base64_encode($_COOKIE['SECURE_AUTH_COOKIE']):base64_encode($_COOKIE[AUTH_COOKIE]))."&logged_in_cookie=".base64_encode($_COOKIE[LOGGED_IN_COOKIE]);
		$next_url = WP_PLUGIN_URL.'/youtube-uploader/response.php?'.$auth_string;
		$flash_action_url = $browser_upload['url'].'?nexturl='.urlencode($next_url);
		$html_action_url = $browser_upload['url'].'?nexturl='.urlencode(admin_url('media-upload.php').'?post_id='.$_GET['post_id'].'&type='.$_GET['type'].'&tab=youtube_html&html_upload=1');
    	$upload_token = $browser_upload['token'];
		?>

<script type="text/javascript">
//<![CDATA[
var uploaderMode = 0;
jQuery(document).ready(function($){
	uploaderMode = getUserSetting('uploader');
	$('.upload-html-bypass a').click(function(){deleteUserSetting('uploader');uploaderMode=0;swfuploadPreLoad();return false;});
	$('.upload-flash-bypass a').click(function(){setUserSetting('uploader', '1');uploaderMode=1;swfuploadPreLoad();return false;});
});
//]]>
</script>
<div id="media-upload-notice"><?php if (isset($errors['upload_notice']) ) { ?>
<?php echo $errors['upload_notice']; ?> <?php } ?></div>
<div id="media-upload-error"><?php if (isset($errors['upload_error']) && is_wp_error($errors['upload_error'])) { ?>
<?php echo $errors['upload_error']->get_error_message(); ?> <?php } ?></div>

<?php do_action('pre-upload-ui'); ?>

<?php if ( $flash ) : ?>
<script type="text/javascript">
//<![CDATA[
var swfu;
var youtubeCheckUrl = '<?=WP_PLUGIN_URL.'/youtube-uploader/response.php'?>';

SWFUpload.onload = function() {
	var settings = {
			file_post_name : "file", 
			button_text: '<span class="button"><?php _e('Select Files'); ?></span>',
			button_text_style: '.button { text-align: center; font-weight: bold; font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif; }',
			button_height: "24",
			button_width: "132",
			button_text_top_padding: 2,
			button_image_url: '<?php echo includes_url('images/upload.png'); ?>',
			button_placeholder_id: "flash-browse-button",
			upload_url : "<?php echo esc_attr( $flash_action_url ); ?>",
			flash_url : "<?php echo includes_url('js/swfupload/swfupload.swf'); ?>",
			file_post_name: "async-upload",
			file_types: "<?php echo apply_filters('upload_file_glob', '*.*'); ?>",
			file_queue_limit : 1,

			post_params : {
				"post_id" : "<?php echo $post_id; ?>",
				"_wpnonce" : "<?php echo wp_create_nonce('media-form'); ?>",
				"type" : "<?php echo $type; ?>",
				"tab" : "<?php echo $tab; ?>",
				"short" : "1",
				"token" : "<?php echo $upload_token; ?>"
			},
			file_size_limit : "<?php echo wp_max_upload_size(); ?>b",
			file_dialog_start_handler : fileDialogStart,
			file_queued_handler : fileQueued,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : youtubeUploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			swfupload_pre_load_handler: swfuploadPreLoad,
			swfupload_load_failed_handler: swfuploadLoadFailed,
			custom_settings : {
				degraded_element_id : "html-upload-ui", // id of the element displayed when swfupload is unavailable
				swfupload_element_id : "flash-upload-ui" // id of the element displayed when swfupload is available
			}
			
		};
		swfu = new SWFUpload(settings);
};
//]]>
</script>

<div id="flash-upload-ui"><?php do_action('pre-flash-upload-ui'); ?>

<div><?php _e( 'Choose files to upload' ); ?>
<div id="flash-browse-button"></div>
	<span><input id="cancel-upload" disabled="disabled"	onclick="cancelUpload()" type="button" 	value="<?php esc_attr_e('Cancel Upload'); ?>" class="button" /></span>
</div>
<?php do_action('post-flash-upload-ui'); ?>
<p class="howto"><?php _e('After a file has been uploaded, you can add titles and descriptions.'); ?></p>
</div>
<?php endif; // $flash ?>

<div id="html-upload-ui">
<form enctype="multipart/form-data" method="post" action="<?=$html_action_url?>" class="media-upload-form type-form validate" id="file-form"><?php do_action('pre-html-upload-ui'); ?>
<p id="async-upload-wrap">
	<label class="screen-reader-text"	for="async-upload"><?php _e('Upload'); ?></label> 
	<input type="hidden" name="token" value="<?=$upload_token?>"> 
	<input type="file" name="file" id="async-upload" /> 
	<input type="submit" class="button" name="html-upload" value="<?php esc_attr_e('Upload'); ?>" /> 
	<a href="#" onclick="try{top.tb_remove();}catch(e){}; return false;"><?php _e('Cancel'); ?></a>
</p>
<div class="clear"></div>
<?php if ( is_lighttpd_before_150() ): ?>
<p><?php _e('If you want to use all capabilities of the uploader, like uploading multiple files at once, please upgrade to lighttpd 1.5.'); ?></p>
<?php endif;?> <?php do_action('post-html-upload-ui', $flash); ?>

</div>
<div id="media-items">
</form>
</div>

<?php do_action('post-upload-ui'); ?>
<?php
	}
}

function media_youtube_html(){
	global $redir_tab,$type,$tab;
	$youtube_api = youtubeuploader_login();
	$uploaded_video = $youtube_api->getUploadedVideos(array('start-index'=>1,'max-results'=>1));
	$media_info = $youtube_api->formatVideoResponse($uploaded_video['output']);//formatVideoResponse();
	if ($_GET['html_upload']==1){
		$redir_tab = 'youtube_uploader';
		wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('myPluginScript', WP_PLUGIN_URL . '/youtube-uploader/youtubeuploader.js');
		media_upload_header();
		return get_youtube_item($media_info);
	} else {
		if ( is_ssl() && empty($_COOKIE[SECURE_AUTH_COOKIE]) && !empty($_REQUEST['auth_cookie']) )
		$_COOKIE[SECURE_AUTH_COOKIE] = $_REQUEST['auth_cookie'];
		elseif ( empty($_COOKIE[AUTH_COOKIE]) && !empty($_REQUEST['auth_cookie']) )
		$_COOKIE[AUTH_COOKIE] = $_REQUEST['auth_cookie'];
		if ( empty($_COOKIE[LOGGED_IN_COOKIE]) && !empty($_REQUEST['logged_in_cookie']) )
		$_COOKIE[LOGGED_IN_COOKIE] = $_REQUEST['logged_in_cookie'];

		wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('myPluginScript', WP_PLUGIN_URL . '/youtube-uploader/youtubeuploader.js');
		return get_youtube_item($media_info);
	}
}

?>

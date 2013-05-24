<?php
global $wpdb;

/* White Gold Options */
class wgOptions {
	function getOptions() {
		$options = get_option('wg_options');
		if (!is_array($options)) {
					$options['wg_about_twitter_enabled'] = 'none';
					$options['wg_about_desc'] = '';
					$options['wg_twitter_username'] = '';
					$options['wg_add_to_any_enabled'] = true;
					$options['wg_categories_enabled'] = true;
					$options['wg_tags_enabled'] = true;
					$options['wg_author_enabled'] = true;
					$options['wg_date_enabled'] = true;
					$options['wg_comments_num_enabled'] = true;
					update_option('wg_options', $options);
		}
		return $options;
	}
	function add() {
		if(isset($_POST['wg_save'])) {
			$options = wgOptions::getOptions();
			if($_POST['wg_about_twitter_enabled'] == 'twitter') {
				$options['wg_about_twitter_enabled'] = 'twitter';
			}
			else if($_POST['wg_about_twitter_enabled'] == 'about') {
				$options['wg_about_twitter_enabled'] = 'about';
			}
			else {
				$options['wg_about_twitter_enabled'] = 'none';
			}
			$options['wg_about_desc'] = stripslashes($_POST['wg_about_desc']);
			$options['wg_twitter_username'] = stripslashes($_POST['wg_twitter_username']);

			if($_POST['wg_add_to_any_enabled']) {
				$options['wg_add_to_any_enabled'] = (bool)true;
			} else {
				$options['wg_add_to_any_enabled'] = (bool)false;
			}

			if($_POST['wg_categories_enabled']) {
				$options['wg_categories_enabled'] = (bool)true;
			} else {
				$options['wg_categories_enabled'] = (bool)false;
			}

			if($_POST['wg_tags_enabled']) {
				$options['wg_tags_enabled'] = (bool)true;
			} else {
				$options['wg_tags_enabled'] = (bool)false;
			}

			if($_POST['wg_author_enabled']) {
				$options['wg_author_enabled'] = (bool)true;
			} else {
				$options['wg_author_enabled'] = (bool)false;
			}

			if($_POST['wg_date_enabled']) {
				$options['wg_date_enabled'] = (bool)true;
			} else {
				$options['wg_date_enabled'] = (bool)false;
			}
			
			if($_POST['wg_comments_num_enabled']) {
				$options['wg_comments_num_enabled'] = (bool)true;
			} else {
				$options['wg_comments_num_enabled'] = (bool)false;
			}

			update_option('wg_options', $options);
		} else {
			wgOptions::getOptions();
		}
		add_theme_page(__('White Gold Theme Options', 'White Gold'), __('White Gold Theme Options', 'White Gold'), 'edit_themes', basename(__FILE__), array('wgOptions', 'display'));
	}

	function display() {
		$options = wgOptions::getOptions();
?>
	<form action="#" method="post" enctype="multipart/form-data" name="wg_form" id="wg_form">
	<div class="wrap">
		<h2><?php _e('White Gold Theme Options', 'White Gold'); ?></h2>
		<?php if(isset($_POST['wg_save'])) { ?>
			<div style="background: #FFF299; padding: 5px; border: 1px #FFDE99 solid;"><?php _e('Settings Saved'); ?></div>
		<?php } ?>
		<hr>
		<h3><?php _e('About Me or Twitter Options', 'White Gold'); ?></h3>
		<table cellspacing="10" style="background: #E3F6CE;">
		<tr>
		 <td align="right"><?php _e('Display in heading:', 'White Gold'); ?></td>
		 <td>
			<input name="wg_about_twitter_enabled" type="radio" value="none" <?php if($options['wg_about_twitter_enabled'] == "none") echo 'checked'; ?> /><label><?php _e('Nothing', 'White Gold'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="wg_about_twitter_enabled" type="radio" value="about" <?php if($options['wg_about_twitter_enabled'] == "about") echo 'checked'; ?> /><label><?php _e('About Me', 'White Gold'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="wg_about_twitter_enabled" type="radio" value="twitter" <?php if($options['wg_about_twitter_enabled'] == "twitter") echo 'checked'; ?> /><label><?php _e('Twitter', 'White Gold'); ?></label>
		 </td>
		</tr>
		<tr>
		 <td align="right"><?php _e('About Me:', 'White Gold'); ?><br /><?php _e('(<i>Short Description about<br />yourself or your blog</i>)', 'White Gold'); ?></td>
		 <td><textarea name="wg_about_desc" id="wg_about_desc" rows="3" cols="30"><?php echo($options['wg_about_desc']); ?></textarea></td>
		</tr>
		<tr>
		 <td align="right"><?php _e('Twitter username:', 'White Gold'); ?></td>
		 <td><input type="text" name="wg_twitter_username" id="wg_twitter_username" size="40" value="<?php echo($options['wg_twitter_username']); ?>"></td>
		</tr>
		</table>
		<hr>
		<h3><?php _e('Add to any sharing option', 'White Gold'); ?></h3>
		<table cellspacing="10" style="background: #F2F5A9;">
		<tr>
			<td><?php _e('Display add to any button below each post ?', 'White Gold'); ?></td>
			<td><input name="wg_add_to_any_enabled" type="checkbox" value="checkbox" <?php if($options['wg_add_to_any_enabled']) echo "checked='checked'"; ?> /></td>
		</tr>
		</table>
		<hr>
		<h3><?php _e('Categories and Tags options', 'White Gold'); ?></h3>
		<table cellspacing="10" style="background: #CEE3F6;">
		<tr>
			<td><?php _e('Display Categories under each post ?', 'White Gold'); ?></td>
			<td><input name="wg_categories_enabled" type="checkbox" value="checkbox" <?php if($options['wg_categories_enabled']) echo "checked='checked'"; ?> /></td>
		</tr>
		<tr>
			<td><?php _e('Display Tags under each post ?', 'White Gold'); ?></td>
			<td><input name="wg_tags_enabled" type="checkbox" value="checkbox" <?php if($options['wg_tags_enabled']) echo "checked='checked'"; ?> /></td>
		</tr>
		</table>
		<hr>
		<h3><?php _e('Date and Author options for individual pages (not posts)', 'White Gold'); ?></h3>
		<table cellspacing="10" style="background: #F5D0A9;">
		<tr>
			<td>Display author name in the pages ?</td>
			<td><input name="wg_author_enabled" type="checkbox" value="checkbox" <?php if($options['wg_author_enabled']) echo "checked='checked'"; ?> /></td>
		</tr>
		<tr>
			<td>Display date in the pages ?</td>
			<td><input name="wg_date_enabled" type="checkbox" value="checkbox" <?php if($options['wg_date_enabled']) echo "checked='checked'"; ?> /></td>
		</tr>
		<tr>
			<td>Display number of comments in the pages ?</td>
			<td><input name="wg_comments_num_enabled" type="checkbox" value="checkbox" <?php if($options['wg_comments_num_enabled']) echo "checked='checked'"; ?> /></td>
		</tr>
		</table>
		<p class="submit">
			<input class="button-primary" type="submit" name="wg_save" value="<?php _e('Save Changes', 'White Gold'); ?>" />
		</p>
	</div>
<?php
	}
}
// Adding theme option
add_action('admin_menu', array('wgOptions', 'add'));

/* Sidebar Function */
if ( function_exists('register_sidebars') )
    register_sidebars(2,array('before_widget' => '<li>','after_widget' => '</li>','before_title' => '<h2>','after_title' => '</h2>'));
?>
<?php
function remove_title_attribute($subject) {
$result = preg_replace('/title=\"(.*?)\"/','',$subject);
return $result;
}
?>
<?php
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="com-wrapper <?php if (1 == $comment->user_id) echo "admin"; ?>">
	        	<div id="comment-<?php comment_ID(); ?>" class="com-header">
					<span class="avtar"><?php if(function_exists('get_avatar')) { echo get_avatar($comment, '40'); } ?></span>
	            </div>
                <div class="com-metadata">
                    <p class="commentauthor"><?php comment_author_link() ?></p>
                    <p class="commentmetadata">
                        <a href="#comment-<?php comment_ID() ?>" title=""><?php printf( __('%1$s at %2$s', 'default'), get_comment_time(__('F jS, Y', 'default')), get_comment_time(__('H:i', 'default')) ); ?></a>
                   	    <?php edit_comment_link(__('Edit', 'default'),'&nbsp;&nbsp;',''); ?>
                    </p>
                    <?php if ($comment->comment_approved == '0') { ?>
    	                <p><?php _e('Your comment is awaiting moderation', 'default'); ?></p>
    	            <?php } ?>
                </div>
                <div class="clear"></div>
                <div class="com-text">
    				<?php comment_text() ?>
                    <div class="reply">
    			    	<p><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
    			    </div>
					<div class="nav_top"><a href="#wrapper">[top]</a></div>
                </div>
            </div>
<?php
        }

function mytheme_ping($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>

        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="com-wrapper <?php if (1 == $comment->user_id) echo "admin"; ?>">
	        	<div id="comment-<?php comment_ID(); ?>" class="com-header">
					<span class="avtar"><?php if(function_exists('get_avatar')) { echo get_avatar($comment, '40'); } ?></span>
	            </div>
                <div class="com-metadata">
                    <p class="commentauthor"><?php comment_author_link() ?></p>
                    <p class="commentmetadata">
                        <a href="#comment-<?php comment_ID() ?>" title=""><?php printf( __('%1$s at %2$s', 'default'), get_comment_time(__('F jS, Y', 'default')), get_comment_time(__('H:i', 'default')) ); ?></a>
                   	    <?php edit_comment_link(__('Edit', 'default'),'&nbsp;&nbsp;',''); ?>
                    </p>
                    <?php if ($comment->comment_approved == '0') { ?>
    	                <p><?php _e('Your comment is awaiting moderation', 'default'); ?></p>
    	            <?php } ?>
                </div>
                <div class="clear"></div>
                <div class="com-text">
    				<?php comment_text() ?>
                    <div class="reply">
    			    	<p><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
    			    </div>
                </div>
            </div>
<?php
        }

?>
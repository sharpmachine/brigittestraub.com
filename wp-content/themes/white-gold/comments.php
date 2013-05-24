<?php
	// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments', 'default'); ?>.</p>

			<?php
			return;
		}
	}
	
	if (function_exists('wp_list_comments')) {
	if ( have_comments() ) {
?>
<?php $commentscount = 0; if ( ! empty($comments_by_type['comment']) ) {
	$commentscount = count($comments_by_type['comment']); } ?>
<?php $pingscount = 0; if ( ! empty($comments_by_type['pings']) ) {
	$pingscount = count($comments_by_type['pings']); } ?>
<div class="com">
	<ul class="tabs">
		<li id="tab1"><a href="#commentstab"><h2 id="comments"><?php printf(__('Comments (%s)', 'default'), $commentscount); ?></h2></a></li>
		<li id="tab2"><a href="#trackbackstab"><h2 id="trackbacks"><?php printf(__('Trackbacks (%s)', 'default'), $pingscount); ?></h2></a></li>
	</ul>
	<div>
		<a name="comments" id="commentstab"></a>
		<div style="height: 15px;"></div>
		<ul class="commentslist">
			<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
		</ul>
	</div>
	<div>
		<a name="trackbacks" id="trackbackstab"></a>
		<div style="height: 15px;"></div>
		<ul class="commentslist">
            <?php wp_list_comments('type=pings&callback=mytheme_ping'); ?>
		</ul>
	</div>
</div>	
<?php } 
}
?>


<?php if ('open' == $post->comment_status) : ?>
<div class="leavereply">
<h2 id="respond" class="title-2 block"><?php _e('Write a comment', 'default'); ?></h2>
<?php if (function_exists('cancel_comment_reply_link')) {
//2.7 comment loop code ?>
<div id="cancel-comment-reply">
	<small><?php cancel_comment_reply_link();?></small>
</div>
<?php } ?>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<?php
	$login_link = get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode(get_permalink());
	printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'default'), $login_link);
?>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) :
	if (function_exists('wp_logout_url')) {
		$logout_link = wp_logout_url();
	} else {
		$logout_link = get_option('siteurl') . '/wp-login.php?action=logout';
	} ?>

<p><?php _e('Logged in as', 'default'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo $logout_link ?>" title="<?php _e('Log out of this account', 'default'); ?>"><?php _e('Log out', 'default'); ?> &raquo;</a></p>

<?php else : ?>
<p><label for="author" class="author"><?php _e('Name', 'default'); ?> <?php if ($req) echo __('(required)', 'default'); ?></label><br />
<div class="textbox"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="50" tabindex="1" /></div></p>
<p><label for="email" class="email"><?php _e('Mail (will not be published)', 'default'); ?> <?php if ($req) echo __('(required)', 'default'); ?></label><br />
<div class="textbox"><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="50" tabindex="2" /></div></p>
<p><label for="url" class="website"><?php _e('Website', 'default'); ?></label><br />
<div class="textbox"><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="50" tabindex="3" /></div></p>

<?php endif; ?>

<?php if (function_exists('cancel_comment_reply_link')) {
//2.7 comment loop code ?>
<p>
 <?php comment_id_fields(); ?>
</p>
<?php } ?>


<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><div class="textarea"><textarea name="comment" id="commenttxt" rows="10" tabindex="4" cols="55"></textarea></div></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'default'); ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>      
<!-- Banner -->
<div id="banner">
	<div class="logo"><h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1><p class="description"><?php bloginfo('description'); ?></p></div>
	<?php if($options['wg_about_twitter_enabled'] == 'about' || $options['wg_about_twitter_enabled'] == 'twitter') { ?>
	<div class="aboutortweet">
		<div class="abouttweettop"></div>
		<div class="abouttweetcenter"><?php include(TEMPLATEPATH . "/aboutortweet.php"); ?></div>
		<div class="abouttweetbottom"></div>
	</div>
	<?php } ?>
	<div class="clear"></div>
	<br />
</div>
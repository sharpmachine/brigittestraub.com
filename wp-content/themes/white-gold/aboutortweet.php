<?php if($options['wg_about_twitter_enabled'] == 'about') { ?>
<div class="gravatar-tweet"><?php if(function_exists('get_avatar')) { echo get_avatar(get_bloginfo('admin_email'),40); } ?></div>
<div class="about-tweet"><?php echo $options['wg_about_desc']; ?></div>
<div class="clear"></div>
<?php } else if($options['wg_about_twitter_enabled'] == 'twitter') { ?>
<div class="gravatar-tweet"><img id="twitterbird" src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter-bird.png" /></div>
<div class="about-tweet"><ul id="twitter_update_list"></ul>
	<!--a href="http://twitter.com/nischalmaniar" id="twitter-link" style="display:block;text-align:right;"><?php //_e('follow me on Twitter'); ?></a-->
	<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
	<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $options['wg_twitter_username']; ?>.json?callback=twitterCallback2&amp;count=1"></script></div>
<div class="clear"></div>
<?php } ?>
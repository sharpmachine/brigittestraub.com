<div class="sidebar">
<ul id="leftsidebar">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
	<li>
		<h2><?php _e('Archives'); ?></h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
	<li>
		<h2><?php _e('Tags'); ?></h2>
		<div>
		<?php wp_tag_cloud(); ?>
		</div>
	</li>
	<?php endif; ?>
</ul>
</div>
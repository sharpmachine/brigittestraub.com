<div class="sidebar">
<ul id="rightsidebar">
	<li id="search">
		<div class="search-back">
			<form action="<?php bloginfo('home'); ?>/" method="post" id="srch-frm">
                <input type="text" value="" name="s" id="s" />
                <!--input name="searchsubmit" id="searchsubmit" type="submit" value="" /-->
            </form>
		</div>
	</li>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>
	<li>
		<h2><?php _e('Recent Posts'); ?></h2>
		<ul>
			<?php wp_get_archives('type=postbypost'); ?>
		</ul>
	</li>
	<?php endif; ?>
</ul>	
</div>
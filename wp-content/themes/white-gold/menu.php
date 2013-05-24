<div id="menu-div">
<ul id="menu">
	<li<?php if(!is_page() ) {?> class="current_page_item"<?php }?>><a class="home" href="<?php bloginfo('home'); ?>"></a></li>
    <?php echo remove_title_attribute(wp_list_pages('depth=1&echo=0&title_li=')); ?>
	<li><a class="last" href="javascript:void(0);"></a></li>
</ul>
</div>
<div class="clear"></div>
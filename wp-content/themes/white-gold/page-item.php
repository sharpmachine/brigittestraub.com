<div class="post-header">
	<div class="post-title">
		<h2><?php the_title(); ?></h2>
	</div>
	<?php if($options['wg_comments_num_enabled']) { ?>
	<div class="post-comment"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/comment-icon.png" />&nbsp;&nbsp;<a href="<?php comments_link(); ?>"><?php comments_number( __( '0 comments', 'default' ), __( '1 comment', 'default' ), __( '% comments', 'default' ),  __( 'comments', 'default' )); ?></a></div>
	<?php } ?>
	<div class="clear"></div>
</div>
<div class="post-meta">
	<?php if($options['wg_date_enabled']) { ?>
	<div class="post-date"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/calendar-icon.png" />&nbsp;&nbsp;<?php the_time(__('jS M y', 'default')) ?></div>
	<?php } ?>
	<?php if($options['wg_author_enabled']) { ?>
	<div class="post-admin"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/user-icon.png" />&nbsp;&nbsp;<?php the_author() ?></div>
	<?php } ?>
	<div class="clear"></div>
</div>
<div class="post_content">
	<?php the_content(__('Read the rest of this entry &raquo;', 'default')); ?>
</div>
<?php if($options['wg_add_to_any_enabled'] && !is_page()) { ?>
<div class="add-to-any">
	<a class="a2a_dd" href="http://www.addtoany.com/share_save?linkname=&amp;linkurl=<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/share-to-any.png" onmouseout="this.src='<?php bloginfo('stylesheet_directory'); ?>/images/share-to-any.png'" onmouseover="this.src='<?php bloginfo('stylesheet_directory'); ?>/images/share-to-any-hover.png'" /></a><script type="text/javascript">a2a_linkname=document.title;a2a_linkurl="<?php the_permalink() ?>";a2a_onclick=1;</script><script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>
</div>
<?php } ?>
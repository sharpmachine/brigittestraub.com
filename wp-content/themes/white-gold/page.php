<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <?php
	$options = get_option('wg_options');
  ?>
  <?php get_header(); ?>
</head>

<body>
<div id="wrapper">
	<?php include(TEMPLATEPATH . "/banner.php"); ?>
	<?php include(TEMPLATEPATH . "/menu.php"); ?>
	<div id="content">
		<?php include(TEMPLATEPATH . "/leftsidebar.php"); ?>
		<div class="container">
			<ul class="posts">
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<li>
					<?php include (TEMPLATEPATH . "/page-item.php"); ?>
					<?php if (function_exists('wp_list_comments')): ?>
					<!-- WP 2.7 and above -->
					<?php comments_template('', true); ?>

					<?php else : ?>
					<!-- WP 2.6 and below -->
					<?php comments_template(); ?>
					<?php endif; ?>
				 </li>
				<?php endwhile; ?>
				<?php else : ?>
				<li>
					<?php include (TEMPLATEPATH . "/missing.php"); ?>
				</li>
				<?php endif; ?>
				<li>
				  <?php if (!is_page()) { ?>
				  <div class="navigation">
					<?php include(TEMPLATEPATH . "/navigation.php"); ?>
				  </div>
				  <?php } ?>
				</li>
			</ul>
		</div>
		<?php include(TEMPLATEPATH . "/rightsidebar.php"); ?>
	</div>
	<?php get_footer(); ?>
</div>	
</body>

</html>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/tabbedcomments.js"></script>
<script type="text/javascript">
	document.write('<style type="text/css">');    
	document.write('div.domtab div{display:none;}<');
	document.write('/s'+'tyle>');    
</script>
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<?php wp_head(); ?>	
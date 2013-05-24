<?php
// connexion a la config WP

function feedburner() {
	$feedburner = get_option('etb_feedburner');

	if (isset($feedburner) && !empty($feedburner)) {
	echo '<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://feeds2.feedburner.com/'.$feedburner.'" />'."\n";
	}
	
	else {
	echo '<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="'.get_bloginfo( 'rss2_url' ).'" />'."\n";
	}
}

add_action('wp_head', 'feedburner');

?>
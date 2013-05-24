<?php
/*
Plugin Name: Text Widget oEmbed
Plugin URI: http://wordpress.org/extend/plugins/text-widget-oembed
Description: Allows oEmbed and the [embed] shortcode to be used in sidebar text widgets.
Author: Daisy Olsen
Version: 1.0
Author URI: http://daisyolsen.com/
*/

add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );
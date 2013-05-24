<?php
/*
   Plugin Name: My Library
   Plugin URI: http://www.xormedia.com/my-library
   Description: A plugin for displaying items in your personal library
   Version: 0.9.2
   Author: Ross McFarland
   Author URI: http://www.xormedia.com/
   License: GPL2

   Copyright 2011 Ross McFarland (email: rwmcfa1@neces.com)
 
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License, version 2, as 
   published by the Free Software Foundation.
 
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
 
   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin St, Fifth Floor, 
   Boston, MA  02110-1301  USA
 */

define('MY_LIBRARY_VERSION', '0.9.2');
define('MY_LIBRARY_URL', plugins_url() . '/my-library/');
define('MY_LIBRARY_IMAGES_URL', MY_LIBRARY_URL . 'images/');

if (is_admin()) {
    require_once dirname( __FILE__ ) . '/admin.php';
}

include_once dirname( __FILE__ ) . '/db.php';
include_once dirname( __FILE__ ) . '/widget.php';
include_once dirname( __FILE__ ) . '/shortcodes.php';

function my_library_enqueue_styles() {
?>
<style type="text/css">
.my-library-1-star,
.my-library-2-star,
.my-library-3-star,
.my-library-4-star,
.my-library-5-star {
    background: transparent url("<?php echo MY_LIBRARY_IMAGES_URL . 'star.png' ?>");
}
</style>
<?php

    wp_register_style('my_library.css', MY_LIBRARY_URL . 'my_library.css');
    wp_enqueue_style('my_library.css');
}

register_activation_hook(__FILE__,'my_library_install');
register_deactivation_hook(__FILE__,'my_library_uninstall');
add_action('plugins_loaded', 'my_libary_update_check');
add_action('wp_print_styles', 'my_library_enqueue_styles');
?>

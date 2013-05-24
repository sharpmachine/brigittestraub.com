<?php

function array_get($array, $key, $default) {
    $val = $array[$key];
    if (!$val) {
        $val = $default;
    }
    return $val;
}

function my_library_shortcode($attrs) {
    static $defaults = array('order' => 'rating desc', 'limit' => 4);

    // this seems to be smart about only calling it once ...
    add_action('wp_print_styles', 'my_library_enqueue_styles');

    if ($attrs) {
        $attrs = array_merge($defaults, $attrs);
    } else {
        $attrs = $defaults;
    }

    $amazon_affiliate = get_option('my-library-amazon-affiliate', 'xm0c1-20');
    if ($amazon_affiliate == '') {
        $amazon_affiliate = 'xm0c1-20';
    }

    $html = '';

    $items = my_library_list($attrs['order'], $attrs['limit'], 0);
    if ($attrs['title']) {
        $html .= "<h3>" . $attrs['title'] . "</h3>";
    }
    $html .= "<ul class='my-library-row'>";
    foreach ($items as $item) {
        $html .= "<li>
            <a href='http://www.amazon.com/dp/$item->asin?tag=$amazon_affiliate'>
                <img src='http://images.amazon.com/images/P/$item->asin.01.T.jpg' alt='$item->name' title='$item->name'>
                <div class='my-library-$item->rating-star'></div>
                <span>$item->name</span>
            </a>
        </li>";
    }
    $html .= "</ul>";

    return $html;
}

add_shortcode('my_library', 'my_library_shortcode');

?>

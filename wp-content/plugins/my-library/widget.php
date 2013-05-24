<?php

add_action('init', 'my_library_register_widget');

function my_library_register_widget() {
    function my_library_widget($args) {
        extract($args);
        $amazon_affiliate = get_option('my-library-amazon-affiliate', 'xm0c1-20');
        if ($amazon_affiliate == '') {
            $amazon_affiliate = 'xm0c1-20';
        }
        $items = my_library_list('added desc',
            get_option('my-library-items-to-show', 2), 0);
        $options = get_option('my_library_widget');
?>
<?php echo $before_widget; ?>
<?php echo $before_title . $options['title'] . $after_title; ?>
    <div id="my-library-widget">
<?php
    foreach ($items as $item) :
?>
        <div>
            <a href="http://www.amazon.com/dp/<?php echo $item->asin . '?tag=' . $amazon_affiliate ?>">
                    <img src="http://images.amazon.com/images/P/<?php echo $item->asin ?>.01.T.jpg" alt="<?php echo $item->name ?>" title="<?php echo $item->name ?>">
            </a>
            <div class="my-library-<?php echo $item->rating ?>-star"></div>
        </div>
<?php
    endforeach;
    $see_more_page = get_option('my-library-see-more-page');
    if ($see_more_page) {
?>
        <div>
            <a href="<?php echo $see_more_page ?>">(see more)</a>
        </div>
<?php
    }
?>
    </div>
<?php echo $after_widget; ?>
<?php
    }

    function my_library_widget_control() {
        $options = $newoptions = get_option('my_library_widget');
        if (isset($_POST['my-library-submit']) && $_POST["my-library-submit"]) {
            $newoptions['title'] = strip_tags(stripslashes($_POST["my-library-title"]));
            if (empty($newoptions['title']))
                $newoptions['title'] = __("I'm Currently Reading");
        }
	if ($options != $newoptions) {
	    $options = $newoptions;
	    update_option('my_library_widget', $options);
        }
        $title = htmlspecialchars($options['title'], ENT_QUOTES);
?>
    <p><label for="my-library-title"><?php _e('Title:'); ?> <input style="width: 250px;" id="my-library-title" name="my-library-title" type="text" value="<?php echo $title; ?>" /></label></p>
    <input type="hidden" id="my-library-submit" name="my-library-submit" value="1" />
<?php
    }

    wp_register_sidebar_widget('my_library', 'My Library', 'my_library_widget', null, 'my_library');
    wp_register_widget_control('my_library', 'My Library', 'my_library_widget_control', null, 75, 'my_library');

    if (is_active_widget('my_library_widget')) {
        add_action('wp_print_styles', 'my_library_enqueue_styles');
    }
}
?>

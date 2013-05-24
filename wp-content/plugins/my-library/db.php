<?php

global $my_library_db_version;
$my_library_db_version = "1.0";

function my_library_install() {
    global $wpdb;
    global $my_library_db_version;

    $table_name = $wpdb->prefix . 'my_library_items';
    $sql = "CREATE TABLE `" . $table_name . "` (
	  id mediumint(9) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
          name varchar(255) NOT NULL,
          asin varchar(10) NOT NULL,
          rating tinyint(4) DEFAULT 5 NOT NULL,
          updated timestamp,
          added timestamp,
          index `" . $table_name . "_name` (name(16)),
          index `" . $table_name . "_rating` (rating desc, added desc),
          index `" . $table_name . "_added` (added desc)
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('my-library-db-version', $my_library_db_version);
}

function my_library_uninstall() {
}

function my_libary_update_check() {
    global $my_library_db_version;

    if (get_option('my-library-db-version') != $my_library_db_version) {
        my_library_install();
    }
}

function my_library_add($name, $asin, $rating) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'my_library_items';
    $sql = "INSERT INTO `$table_name` (`name`, `asin`, `rating`, `added`) VALUES ('%s', '%s', '%s', NOW())";
    return $wpdb->query($wpdb->prepare($sql, array(
        'name' => $name, 
        'asin' => $asin,
        'rating' => $rating,
        'added' => ''
    )));
}

function my_library_update($id, $name, $asin, $rating) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'my_library_items';
    return $wpdb->update($table_name, array(
        'name' => $name, 
        'asin' => $asin,
        'rating' => $rating
    ), array(
        'id' => $id
    ));
}

function my_library_delete($id) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'my_library_items';
    return $wpdb->query($wpdb->prepare("DELETE from `$table_name` where `id` = %d", array('id' => $id)));
}

function my_library_get($id) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'my_library_items';
    return $wpdb->get_row($wpdb->prepare("select `id`, `name`, `asin`, `rating`, `added` from `$table_name` where `id` = %d", 
        array('id' => $id)));
}

function my_library_list($order, $limit, $offset) {
    global $wpdb;

    $order = sanitize_sql_orderby($order);

    $table_name = $wpdb->prefix . 'my_library_items';
    return $wpdb->get_results($wpdb->prepare("select `id`, `name`, `asin`, `rating`, `added` from `$table_name` order by $order limit %d, %d", 
        array('offset' => $offset, 'limit' => $limit)));
}

?>

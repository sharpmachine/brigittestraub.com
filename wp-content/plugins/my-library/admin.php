<?php
add_action('admin_menu', 'my_library_config_page');

function my_library_config_page() {
    add_menu_page('My Library', _('My Library'), 'manage_options', 
        'my-library', 'my_library_manage');
    add_submenu_page('my-library', __('Manage','my-library'), 
        __('Manage','my-library'), 'manage_options', 'my-library', 
        'my_library_manage');
    add_submenu_page('my-library', __('My Library - Settings'), 
        __('Settings'), 'manage_options', 'my-library-config', 
        'my_library_conf');
}

function my_library_manage() {
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
        if ($type == 'edit') {
            my_library_update($_POST['id'], stripslashes($_POST['name']), 
                $_POST['asin'], $_POST['rating']);
        } else if ($type == 'add') {
            my_library_add(stripslashes($_POST['name']), $_POST['asin'], 
                $_POST['rating']);
        } else if ($type == 'delete') {
            my_library_delete($_POST['id']);
        }
    }
?>
<div class="wrap">
    <h2><?php _e('My Library - Manage'); ?></h2>

<a href="?page=my-library">Home</a> | <a href="?page=my-library&add=1">Add</a>
<?php
    if (isset($_GET['add'])) {
?>
    <form action="?page=my-library" method="post" id="my-library-add">
        <input type="hidden" name="type" value="add">
        <h3><?php _e('Add New Item'); ?></h3>
        <p><label for="name"><?php _e('Name'); ?>:</label>
        <input id="name" name="name" type="text" size="60" maxlength="255" value=""></p>
        <p><label for="asin"><?php _e('ASIN'); ?>:</label>
        <input id="asin" name="asin" type="text" size="15" maxlength="16" value=""></p>
        <p><label for="rating"><?php _e('Rating'); ?>:</label>
        <input id="rating" name="rating" size=1 type="number" min="1" max="5" value="5"></p>
	<p class="submit"><input type="submit" name="submit" value="<?php _e('Add Item &raquo;'); ?>" /></p>
    </form>
<?php
} else if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $item = my_library_get($id);
?>
    <form action="?page=my-library" method="post" id="my-library-edit">
        <input type="hidden" name="type" value="edit">
        <input type="hidden" name="id" value="<?php echo $item->id ?>">
        <h3><?php _e('Edit Item'); ?></h3>
        <p><label for="name"><?php _e('Name'); ?>:</label>
        <input id="name" name="name" type="text" size="60" maxlength="255" value="<?php echo $item->name ?>"></p>
        <p><label for="asin"><?php _e('ASIN'); ?>:</label>
        <input id="asin" name="asin" type="text" size="15" maxlength="16" value="<?php echo $item->asin ?>"></p>
        <p><label for="rating"><?php _e('Rating'); ?>:</label>
        <input id="rating" name="rating" size=1 type="number" min="1" max="5" value="<?php echo $item->rating ?>"></p>
	<p class="submit"><input type="submit" name="submit" value="<?php _e('Edit Item'); ?>" /></p>
    </form>
<?php
} else if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $item = my_library_get($id);
?>
    <form action="?page=my-library" method="post" id="my-library-edit">
        <input type="hidden" name="type" value="delete">
        <input type="hidden" name="id" value="<?php echo $item->id ?>">
        <h3><?php _e('Delete Item'); ?></h3>
        <p><b><?php _e('Name'); ?>:</b> <?php echo $item->name ?></p>
        <p><b><?php _e('ASIN'); ?>:</b> <?php echo $item->asin ?></p>
        <p><b><?php _e('Rating'); ?>:</b> <?php echo $item->rating ?></p>
	<p class="submit"><input type="submit" name="submit" value="<?php _e('Delete Item'); ?>" /></p>
    </form>
<?php
} else {
?>
    <form action="" method="post" id="my-library-remove">
        <h3>Manage Existing Items</h3>
<?php
    $count = 20;
    if (isset($_GET['count'])) {
        $count = $_GET['count'];
    }
    $offset = 0;
    if (isset($_GET['offset'])) {
        $offset = $_GET['offset'];
    }
    $items = my_library_list('added desc', $count, $offset);
?>
    <table>
<?php
    foreach ($items as $item) :
?>
        <tr>
            <td><?php echo $item->name ?></td>
            <td><?php echo $item->added ?></td>
            <td><a href="?page=my-library&edit=<?php echo $item->id ?>">(edit)</a></td>
            <td><a href="?page=my-library&delete=<?php echo $item->id ?>">(X)</a></td>
        </tr>
<?php
    endforeach;
?>
    </table>
<?php
    if ($offset) {
?>
    <a href="?page=my-library&offset=<?php echo max(0, $offset - $count); ?>">prev</a>
<?php
    }
    if (count($items) == $count) {
?>
    <a href="?page=my-library&offset=<?php echo $offset + $count; ?>">next</a>
<?php
    }
?>
    </form>
<?php
}
?>
</div>
<?php
}

function my_library_conf() {
    if ( isset($_POST['submit']) ) {
        update_option('my-library-items-to-show', $_POST['items-to-show']);
        update_option('my-library-amazon-affiliate', $_POST['amazon-affiliate']);
        update_option('my-library-see-more-page', $_POST['see-more-page']);
    }
?>
<div class="wrap">
    <h2><?php _e('My Library - Settings'); ?></h2>
    <form action="" method="post" id="my-library-conf">
        <p><label for="items-to-show"><?php _e('Number Of Items To Show'); ?>:</label>
        <input id="items-to-show" name="items-to-show" size=2 type="number" min="1" value="<?php echo get_option('my-library-items-to-show', 2); ?>"></p>
        <p><label for="amazon-affilate"><?php _e('Amazon Affiliate Tag'); ?>:</label>
        <input id="amazon-affiliate" name="amazon-affiliate" type="text" size="15" maxlength="16" value="<?php echo get_option('my-library-amazon-affiliate'); ?>"> (optional)</p>
        <p><label for="see-more-page"><?php _e('See More Page Name'); ?>:</label>
        <input id="see-more-page" name="see-more-page" type="text" size="32" value="<?php echo get_option('my-library-see-more-page'); ?>"> (e.g. /my-library/)</p>
	<p class="submit"><input type="submit" name="submit" value="<?php _e('Update options &raquo;'); ?>" /></p>
    </form>
</div>
<?php
}
?>

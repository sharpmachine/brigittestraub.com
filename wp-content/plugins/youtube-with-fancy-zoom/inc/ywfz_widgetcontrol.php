<?php
$g_ywfz_title = get_option('g_ywfz_title');
$g_ywfz_width = get_option('g_ywfz_width');
$g_ywfz_rand = get_option('g_ywfz_rand');
if ($_POST['g_ywfz__submit']) 
{
		$g_ywfz_title = stripslashes($_POST['g_ywfz_title']);
		$g_ywfz_width = stripslashes($_POST['g_ywfz_width']);
		$g_ywfz_rand = stripslashes($_POST['g_ywfz_rand']);
		update_option('g_ywfz_title', $g_ywfz_title );
		update_option('g_ywfz_width', $g_ywfz_width );
		update_option('g_ywfz_rand', $g_ywfz_rand );
}
echo '<p>Sidebar Title :<br><input  style="" type="text" value="';
echo $g_ywfz_title . '" name="g_ywfz_title" id="g_ywfz_title" /></p>';
echo '<p>Thumbnail Width:<br><input  style="" type="text" value="';
echo $g_ywfz_width . '" name="g_ywfz_width" id="g_ywfz_width" /></p>';
echo '<p>Number of video:<br><input  style="" type="text" value="';
echo $g_ywfz_rand . '" name="g_ywfz_rand" id="g_ywfz_rand" /></p>';
echo '<input type="hidden" id="g_ywfz__submit" name="g_ywfz__submit" value="1" />';
?>
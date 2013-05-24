<div class="wrap">
<h2>Youtube with fancy zoom - Widget Setting</h2>
<?php
global $wpdb, $wp_version;

$g_ywfz_title = get_option('g_ywfz_title');
$g_ywfz_width = get_option('g_ywfz_width');
$g_ywfz_height = get_option('g_ywfz_height');
$g_ywfz_rand = get_option('g_ywfz_rand');
if (@$_POST['g_ywfz_submit']) 
{
		$g_ywfz_title = stripslashes($_POST['g_ywfz_title']);
		$g_ywfz_width = stripslashes($_POST['g_ywfz_width']);
		$g_ywfz_height = stripslashes($_POST['g_ywfz_height']);
		$g_ywfz_rand = stripslashes($_POST['g_ywfz_rand']);
		update_option('g_ywfz_title', $g_ywfz_title );
		update_option('g_ywfz_width', $g_ywfz_width );
		update_option('g_ywfz_height', $g_ywfz_height );
		update_option('g_ywfz_rand', $g_ywfz_rand );
		//echo $g_ywfz_title . '--' . $g_ywfz_width. '--' . $g_ywfz_height. '--' . $g_ywfz_width . '<br>';
}
//echo $g_ywfz_title . '--' . $g_ywfz_width. '--' . $g_ywfz_height. '--' . $g_ywfz_width . '<br>';
echo '<table width="100%" border="0" cellspacing="5" cellpadding="0">';
echo '<tr>';
echo '<td align="left">';
echo '<form name="form_ywfz" method="post" action="">';
echo '<p>Sidebar Title :<br><input  style="" type="text" value="';
echo $g_ywfz_title . '" name="g_ywfz_title" id="g_ywfz_title" /></p>';
echo '<p>Thumbnail Width:<br><input  style="" type="text" value="';
echo $g_ywfz_width . '" name="g_ywfz_width" id="g_ywfz_width" /></p>';
echo '<p>Thumbnail Height:<br><input  style="" type="text" value="';
echo $g_ywfz_height . '" name="g_ywfz_height" id="g_ywfz_height" /></p>';
echo '<p>Number of video:<br><input  style="" type="text" value="';
echo $g_ywfz_rand . '" name="g_ywfz_rand" id="g_ywfz_rand" /></p>';
echo '<input type="submit" id="g_ywfz_submit" name="g_ywfz_submit" lang="publish" class="button-primary"" value="Update Widget Setting" />';
echo '</form>';
echo '</form>';
echo '</td>';
echo '<td align="center">';

echo '</td>';
echo '</tr>';
echo '</table>';
include_once("ywfz_help.php");
?>

<?php
if(trim($_POST['ywfz_id']) == "" )
{
	$sql = "insert into ".WP_G_YWFZ_TABLE
			. " set `ywfz_title`='" . mysql_real_escape_string(trim($_POST['ywfz_title']))
			. "', `ywfz_watch`='" . mysql_real_escape_string(trim($_POST['ywfz_watch']))
			. "', `ywfz_code`='" . mysql_real_escape_string(trim($_POST['ywfz_code']))
			. "', `ywfz_img`='" . mysql_real_escape_string(trim($_POST['ywfz_img']))
			. "', `ywfz_size`='" . mysql_real_escape_string(trim($_POST['ywfz_size']))
			. "', `ywfz_imglink`='" . mysql_real_escape_string(trim($_POST['ywfz_imglink']))
			. "', `ywfz_status`='" . mysql_real_escape_string(trim($_POST['ywfz_status']))
			. "', `ywfz_sidebar`='" . mysql_real_escape_string(trim($_POST['ywfz_sidebar']))
			. "';";
}
else
{
	$sql = "update ".WP_G_YWFZ_TABLE
			. " set `ywfz_title`='" . mysql_real_escape_string(trim($_POST['ywfz_title']))
			. "', `ywfz_watch`='" . mysql_real_escape_string(trim($_POST['ywfz_watch']))
			. "', `ywfz_code`='" . mysql_real_escape_string(trim($_POST['ywfz_code']))
			. "', `ywfz_img`='" . mysql_real_escape_string(trim($_POST['ywfz_img']))
			. "', `ywfz_size`='" . mysql_real_escape_string(trim($_POST['ywfz_size']))
			. "', `ywfz_imglink`='" . mysql_real_escape_string(trim($_POST['ywfz_imglink']))
			. "', `ywfz_status`='" . mysql_real_escape_string(trim($_POST['ywfz_status']))
			. "', `ywfz_sidebar`='" . mysql_real_escape_string(trim($_POST['ywfz_sidebar']))
			. "' where ywfz_id=".$_POST['ywfz_id'].";";

}
//echo $sql;
$wpdb->get_results($sql);
?>
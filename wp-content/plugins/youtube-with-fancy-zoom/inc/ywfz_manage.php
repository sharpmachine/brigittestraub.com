<div class="tool-box">
<?php
$data = $wpdb->get_results("select * from ".WP_G_YWFZ_TABLE." order by ywfz_status desc,ywfz_id desc");

if ( empty($data) ) 
{ 
	echo "<div id='message' class='error'><p>No data Available in Database! Creat New.</p></div>";
	return;
}
?>
<script language="javascript" type="text/javascript">
function _dealdelete(id)
{
	if(confirm("Do you want to delete this record?"))
	{
		document.frm.action="options-general.php?page=youtube-with-fancy-zoom/youtube-with-fancy-zoom.php&AC=DEL&AID="+id;
		document.frm.submit();
	}
}	
</script>
<form name="frm" method="post">
<table width="100%" class="widefat" id="straymanage">
<thead>
    <tr>
        <th align="left">Title</th>
        <th align="left">Code</th>
        <th align="left">Img</th>
		<th align="left">Size</th>
        <th align="left">Display Image</th>
        <th align="left">Dis Status</th>
        <th align="left">Sidebar</th>
        <th align="left">Action</th>
    </tr>
<thead>
<tbody>
	<?php 
    $i = 0;
    foreach ( $data as $data ) { 
    ?>
    <tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
        <td align="left"><?php echo(stripslashes($data->ywfz_title)); ?></td>
        <td align="left"><?php echo(stripslashes($data->ywfz_code)); ?></td>
        <td align="left"><a target="_blank" href="http://img.youtube.com/vi/<?php echo(stripslashes($data->ywfz_code)); ?>/2.jpg" >Click</a></td>
        <td align="left"><?php if($data->ywfz_size == '0') { echo 'Big'; } else { echo 'Small'; } ?></td>
		<td align="left"><?php echo(stripslashes($data->ywfz_img)); ?></td>
        <td align="left"><?php echo(stripslashes($data->ywfz_status)); ?></td>
        <td align="left"><?php echo(stripslashes($data->ywfz_sidebar)); ?></td>
        <td align="left">
            <a href="options-general.php?page=youtube-with-fancy-zoom/youtube-with-fancy-zoom.php&AID=<?php echo $data->ywfz_id?>">edit</a> 
            <a onClick="javascript:_dealdelete('<?php echo($data->ywfz_id); ?>')" href="javascript:void(0);">delete</a> 
        </td>
    </tr>
    <?php $i = $i+1; } ?>
</tbody>
</table>
</form>
</div>


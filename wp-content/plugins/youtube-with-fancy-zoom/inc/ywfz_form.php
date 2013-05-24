<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/youtube-with-fancy-zoom/includes/create-form.js"></script>
<form name="ywfz_form" method="post" action="<?php echo @$mainurl; ?>"  onSubmit="return _ywfz_form()">
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td width="61%">Title:</td>
    <td width="39%" rowspan="11" align="center" valign="top"></td>
  </tr>
  <tr>
    <td><input name="ywfz_title" value="<?php echo @$ywfz_title_x; ?>" type="text" id="ywfz_title" size="50" maxlength="150"></td>
    </tr>
  <tr>
    <td>Youtube watch link:</td>
    </tr>
  <tr>
    <td><input name="ywfz_watch" value="<?php echo @$ywfz_watch_x; ?>" type="text" id="ywfz_watch" size="70" maxlength="1000"></td>
    </tr>
  <tr>
    <td>Youtube code:</td>
    </tr>
  <tr>
    <td><input name="ywfz_code" value="<?php echo @$ywfz_code_x; ?>" type="text" id="ywfz_code" size="30" maxlength="70">
	<a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/youtube-with-fancy-zoom/">Help</a>	</td>
    </tr>
  <tr>
    <td>If (http://www.youtube.com/watch?v=5TSPlykcdYk) this is your youtube video
      <br />then &ldquo;5TSPlykcdYk&rdquo; is your youtube code.</td>
  </tr>
  <tr>
    <td>Youtube thumbnail size:</td>
    </tr>
  <tr>
    <td><select name="ywfz_size" id="ywfz_size">
        <option value='0' <?php if(@$ywfz_size_x=='0') { echo 'selected' ; } ?>>Big</option>
		<option value='1' <?php if(@$ywfz_size_x=='1') { echo 'selected' ; } ?>>Small</option>
      </select> 
      <em>This is to choose youtube available thumbnail..</em> </td>
    </tr>
 <!-- <tr>
  	<td>What is Youtube code?<br />
	If this is your youtube link<br />
	http://www.youtube.com/watch?v=Vc6V4b4VgOk Then <br />
	Your youtube code is "Vc6V4b4VgOk"<br />
	</td>
    <td></td>
  </tr>-->
  <tr>
    <td>Thumbnail Image link (My Thumbnail):</td>
    </tr>
  <tr>
    <td><input name="ywfz_imglink" value="<?php echo @$ywfz_imglink_x; ?>" type="text" id="ywfz_imglink" size="70" maxlength="1000"></td>
    </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="35%">Display Image:</td>
    <td width="34%">Display Status:</td>
    <td width="31%">Sidebar Display:</td>
  </tr>
  <tr>
    <td><select name="ywfz_img" id="ywfz_img">
        <option value="">Select</option>
        <option value='My Thumbnail' <?php if(@$ywfz_img_x=='My Thumbnail') { echo 'selected' ; } ?>>My Thumbnail</option>
        <option value='Youtube Thumbnail' <?php if(@$ywfz_img_x=='Youtube Thumbnail') { echo 'selected' ; } ?>>Youtube Thumbnail</option>
      </select></td>
    <td><select name="ywfz_status" id="ywfz_status">
        <option value="">Select</option>
        <option value='Yes' <?php if(@$ywfz_status_x=='Yes') { echo 'selected' ; } ?>>Yes</option>
        <option value='No' <?php if(@$ywfz_status_x=='No') { echo 'selected' ; } ?>>No</option>
      </select></td>
    <td><select name="ywfz_sidebar" id="ywfz_sidebar">
        <option value="">Select</option>
        <option value='Yes' <?php if(@$ywfz_sidebar_x=='Yes') { echo 'selected' ; } ?>>Yes</option>
        <option value='No' <?php if(@$ywfz_sidebar_x=='No') { echo 'selected' ; } ?>>No</option>
      </select></td>
  </tr>
</table></td>
    </tr>
  <tr>
    <td height="35" align="left" valign="bottom">
	<input name="publish" lang="publish" class="button-primary" value="<?php echo @$submittext?>" type="submit" />
	<input name="Cancel" lang="publish" class="button-primary" onclick="_ywfz_redirect()" value="Cancel" type="button" />
	</td>
    </tr>
</table>
<input name="ywfz_id" id="ywfz_id" type="hidden" value="<?php echo @$ywfz_id_x; ?>">
</form>
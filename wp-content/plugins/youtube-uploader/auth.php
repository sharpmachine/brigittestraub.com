<?php
//require_once('../../../wp-load.php');
if ( defined('ABSPATH') ){
	require_once(ABSPATH . 'wp-load.php');
} else {
	require_once('../../../wp-load.php');
}
$youtubeAuth = new youtube_auth();
$url = plugins_url().'/youtube-uploader/auth.php';

if (empty($_GET['token'])){
	$authToken = $youtubeAuth->showAuthSubRequest($url);
} else {
	$youtubeAuth->setAccessToken($_GET['token']);//$youtube->authSubSessionToken();
	$youtubeAuth->authSubSessionToken();
	$sessionToken = trim($youtubeAuth->sessionToken);
	?>
	<script type="text/javascript">
	//<![CDATA[
		parent.document.getElementById('sessionToken').value = '<?=$sessionToken?>';
		parent.document.getElementById('sessionTokenDescription').innerHTML = "Your session token is <?=$sessionToken?>";
		self.parent.tb_remove();
    //]]>
	</script>
    Youtube session token update.  <a href="javascript:;" onClick="top.TB_remove();">Close</a>
	<?php
}
?>
<?php
if ( defined('ABSPATH') ){
	require_once(ABSPATH . 'wp-load.php');
} else {
  require_once('../../../wp-load.php');
}
$request_auth_cookie = !empty($_REQUEST['auth_cookie'])?base64_decode($_REQUEST['auth_cookie']):'';
$request_logged_in_cookie = !empty($_REQUEST['logged_in_cookie'])?base64_decode($_REQUEST['logged_in_cookie']):'';
if ( is_ssl() && empty($_COOKIE[SECURE_AUTH_COOKIE]) && !empty($request_auth_cookie) )
	$_COOKIE[SECURE_AUTH_COOKIE] = $_REQUEST['auth_cookie'];
elseif ( empty($_COOKIE[AUTH_COOKIE]) && !empty($request_auth_cookie) )
	$_COOKIE[AUTH_COOKIE] = $request_auth_cookie;
if ( empty($_COOKIE[LOGGED_IN_COOKIE]) && !empty($request_logged_in_cookie) )
	$_COOKIE[LOGGED_IN_COOKIE] = $request_logged_in_cookie;

unset($current_user);

//Must find a way to include admin.php without hradcoding the path
if ( defined('ABSPATH') ){
  require_once(ABSPATH.'/wp-admin/admin.php');
} else {
  require_once('../../../wp-admin/admin.php');
}
$settings = youtubeuploader_get_settings();
$youtube_api = youtubeuploader_login();
$uploaded_video = $youtube_api->getUploadedVideos(array('start-index'=>1,'max-results'=>1));
$media_info = $youtube_api->formatVideoResponse($uploaded_video['output']);
return get_youtube_item($media_info,'flash');
?>
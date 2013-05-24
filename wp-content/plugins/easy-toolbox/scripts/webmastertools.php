<?php

function webmastertools() {

$webmastertools = get_option('etb_webmastertools');
$bing_webmaster = get_option('etb_bing_webmaster');
$yahoo_site_explorer = get_option('etb_yahoo_site_explorer');
$alexa_verif = get_option('etb_alexa_verif');

if (isset($webmastertools) && !empty($webmastertools)) {
echo '<meta name="google-site-verification" content="'. get_option('etb_webmastertools') .'"/>'."\n";
}

if (isset($bing_webmaster) && !empty($bing_webmaster)) {
echo '<meta name="msvalidate.01" content="'. get_option('etb_bing_webmaster') .'"/>'."\n";
}

if (isset($yahoo_site_explorer) && !empty($yahoo_site_explorer)) {
echo '<META name="y_key" content="'. get_option('etb_yahoo_site_explorer') .'"/>'."\n";
}

if (isset($alexa_verif) && !empty($alexa_verif)) {
echo '<meta name="alexaVerifyID" content="'. get_option('etb_alexa_verif') .'"/>'."\n";
}

}

add_action('wp_head', 'webmastertools');

?>
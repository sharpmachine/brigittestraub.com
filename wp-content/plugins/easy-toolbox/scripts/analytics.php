<?php
function analytics() {	
	$adsense = get_option('etb_analytics');
	$name = get_bloginfo('name');
	$uri = str_replace("http://","",get_bloginfo('url'));
?>	
	
<!-- Google Analytics | <?php echo $name ?> use easytoolbox.net version <?php echo $_SESSION['version'] ?> -->
<script type="text/javascript">
var _gaq = _gaq || [];
<?php if (isset($adsense) && !empty($adsense)) { ?>
_gaq.push(['_setAccount', '<?php echo $adsense ?>' ],['_trackPageview']);
<?php } ?>
_gaq.push(['etb._setAccount', 'UA-116659-19'],['etb._setDomainName', '<?php echo $uri ?>'],['etb._trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<?php if (isset($adsense) && !empty($adsense)) { ?>
<script type="text/javascript">
window.google_analytics_uacct = "<?php echo $adsense ?>";
</script>
<?php } ?>
	
<?php
}
add_action('wp_head', 'analytics');

?>
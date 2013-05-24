<div class="wrap">
	<div id="poststuff">
		<div id="post-body">
		

	<h2><?php _e('Options', 'easytoolbox') ?></h2>
		
<!-- tableau Admin Social -->
<form method="post" action="options.php">
<?php settings_fields('easytoolbox_options'); ?>

<script type="text/javascript">
$(document).ready(function() {
	$("a.gallery").fancybox({
		'transitionIn'	:'elastic',
        'transitionOut'	:'elastic', 
        'easingIn'		:'easeOutBack',
		'easingOut'		:'easeInBack', 
        'width'			:750, 
        'speedIn'		:600,
        'speedOut'		:250,  
        });
	$("a#single_image").fancybox();

	
	$("a#inline").fancybox({
		'hideOnContentClick': true,
		'transitionIn'	:'elastic',
        'transitionOut'	:'elastic', 
        'easingIn'		:'easeOutBack',
		'easingOut'		:'easeInBack', 
        'speedIn'		:600,
        'speedOut'		:200, 
        'autoDimensions':true,
	});

	$("a#iframe").fancybox({
		'transitionIn'	:'elastic',
		'transitionOut'	:'elastic',
		'speedIn'		:600, 
		'speedOut'		:200, 
		'width' 		:'85%',
		'height' 		:'85%', 
		'overlayShow'	:false,
		'type'          :'iframe', 
	});

});

$(document).ready(function() {

});

</script>	
	
	<?php 
	include 'HTML/optimiz.php'; 
	include 'HTML/socialize.php'; 
	include 'HTML/monetize.php'; 
	?>
	
	<p class="submit" >
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
	
</form>
	
		</div><!--postbody-->
	</div><!--poststuff-->
</div> <!-- wrap -->
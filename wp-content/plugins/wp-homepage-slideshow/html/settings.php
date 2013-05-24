<?php
global $wpdb, $ghss;
$ops = get_option('hss_settings', array());
//$ops = array_merge($hss_settings, $ops);
?>
<div class="wrap">
	<h2><?php _e('Create XML File'); ?></h2>
	<form action="" method="post">
		<input type="hidden" name="task" value="save_hss_settings" />
		<table>
		<tr>
			<td><?php _e('Slideshow width (px)'); ?></td>
			<td><input type="text" name="settings[bannerWidth]" value="<?php print  @$ops['bannerWidth']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Slideshow height (px)'); ?></td>
			<td><input type="text" name="settings[bannerHeight]" value="<?php print @$ops['bannerHeight']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Auto slide time'); ?></td>
			<td><input type="text" name="settings[autoSlideTime]" value="<?php print @$ops['autoSlideTime']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Enable Play/Pause'); ?></td>
			<td>
				<input type="radio" name="settings[showPlay]" value="1" <?php print (@$ops['showPlay'] == '1') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[showPlay]" value="0" <?php print (@$ops['showPlay'] == '0') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>
		<tr>
			<td><?php _e('Slideshow Background Color'); ?></td>
			<td><input type="text" name="settings[backgroundColor]" value="<?php print @$ops['backgroundColor']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Images width'); ?></td>
			<td><input type="text" name="settings[imagewidth]" value="<?php print @$ops['imagewidth']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Gradient Color 1'); ?></td>
			<td><input type="text" name="settings[gradientColor1]" class="color {hash:false,caps:false}" value="<?php print @$ops['gradientColor1']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Gradient Color 2'); ?></td>
			<td><input type="text" name="settings[gradientColor2]" class="color {hash:false,caps:false}" value="<?php print @$ops['gradientColor2']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Menu color'); ?></td>
			<td><input type="text" name="settings[menuColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['menuColor']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Menu over color'); ?></td>
			<td><input type="text" name="settings[menuOverColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['menuOverColor']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Menu text color'); ?></td>
			<td><input type="text" name="settings[menuTextColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['menuTextColor']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Menu text over color'); ?></td>
			<td><input type="text" name="settings[menuOverTextColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['menuOverTextColor']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Image Transition Time'); ?></td>
			<td><input type="text" name="settings[transitionTime]" value="<?php print @$ops['transitionTime']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Menu scroll speed'); ?></td>
			<td><input type="text" name="settings[menuScrollSpeed]" value="<?php print @$ops['menuScrollSpeed']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Show Description Box'); ?></td>
			<td>
				<input type="radio" name="settings[descbox_visible]" value="yes" <?php print (@$ops['descbox_visible'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[descbox_visible]" value="no" <?php print (@$ops['descbox_visible'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>			
			</td>
		</tr>
		<tr>
			<td><?php _e('Box width'); ?></td>
			<td><input type="text" name="settings[boxwidth]" value="<?php print @$ops['boxwidth']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Box height'); ?></td>
			<td><input type="text" name="settings[boxheight]" value="<?php print @$ops['boxheight']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Description header text font size'); ?></td>
			<td><input type="text" name="settings[infoFontSizeBig]" value="<?php print @$ops['infoFontSizeBig']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Description text font size'); ?></td>
			<td><input type="text" name="settings[infoFontSizeSmall]" value="<?php print @$ops['infoFontSizeSmall']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Menu font size'); ?></td>
			<td><input type="text" name="settings[menuFontSize]" value="<?php print @$ops['menuFontSize']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Image Effect'); ?></td>
			<td>
				<select name="settings[transition_type]"> 
					<option value="easeIn" <?php print (@$ops['transition_type'] == "easeIn") ? 'selected' : ''; ?>>Ease In</option>
					<option value="easeInBounce" <?php print (@$ops['transition_type'] == "easeInBounce") ? 'selected' : ''; ?>>Ease in Bounce</option>
					<option value="easeInSine" <?php print (@$ops['transition_type'] == "easeInSine") ? 'selected' : ''; ?>>Ease in Sine</option>
				</select>			
			</td>
		</tr>
		<tr>
			<td><?php _e('Effect Direction'); ?></td>
			<td>
				<select name="settings[transition]"> 
					<option value="left" <?php print (@$ops['transition'] == "left") ? 'selected' : ''; ?>>Left</option>
					<option value="right" <?php print (@$ops['transition'] == "right") ? 'selected' : ''; ?>>Right</option>
					<option value="bottom" <?php print (@$ops['transition'] == "bottom") ? 'selected' : ''; ?>>Bottom</option>
					<option value="top" <?php print (@$ops['transition'] == "top") ? 'selected' : ''; ?>>Top</option>
				</select>			
			</td>
		</tr>
		<tr>
			<td><?php _e('Corner Radius'); ?></td>
			<td><input type="text" name="settings[cornerRadius]" value="<?php print @$ops['cornerRadius']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('DescriptionBox X-Position'); ?></td>
			<td><input type="text" name="settings[box_x]" value="<?php print @$ops['box_x']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('DescriptionBox Y-Position'); ?></td>
			<td><input type="text" name="settings[box_y]" value="<?php print @$ops['box_y']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Viewmore Button Width'); ?></td>
			<td><input type="text" name="settings[button_width]" value="<?php print @$ops['button_width']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Description background color'); ?></td>
			<td><input type="text" name="settings[FindMoreColorBack]" class="color {hash:false,caps:false}" value="<?php print @$ops['FindMoreColorBack']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Description text color'); ?></td>
			<td><input type="text" name="settings[FindMoreColorText]" class="color {hash:false,caps:false}" value="<?php print @$ops['FindMoreColorText']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Description alpha'); ?></td>
			<td>
				<select name="settings[FindMoreAlpha]"> 
					<option value="0" <?php print (@$ops['FindMoreAlpha'] == 0) ? 'selected' : ''; ?>>0</option>
					<option value="0.1" <?php print (@$ops['FindMoreAlpha'] == 0.1) ? 'selected' : ''; ?>>0.1</option>
					<option value="0.2" <?php print (@$ops['FindMoreAlpha'] == 0.2) ? 'selected' : ''; ?>>0.2</option>
					<option value="0.3" <?php print (@$ops['FindMoreAlpha'] == 0.3) ? 'selected' : ''; ?>>0.3</option>
					<option value="0.4" <?php print (@$ops['FindMoreAlpha'] == 0.4) ? 'selected' : ''; ?>>0.4</option>
					<option value="0.5" <?php print (@$ops['FindMoreAlpha'] == 0.5) ? 'selected' : ''; ?>>0.5</option>
					<option value="0.6" <?php print (@$ops['FindMoreAlpha'] == 0.6) ? 'selected' : ''; ?>>0.6</option>
					<option value="0.7" <?php print (@$ops['FindMoreAlpha'] == 0.7) ? 'selected' : ''; ?>>0.7</option>
					<option value="0.8" <?php print (@$ops['FindMoreAlpha'] == 0.8) ? 'selected' : ''; ?>>0.8</option>
					<option value="0.9" <?php print (@$ops['FindMoreAlpha'] == 0.9) ? 'selected' : ''; ?>>0.9</option>
					<option value="1" <?php print (@$ops['FindMoreAlpha'] == 1) ? 'selected' : ''; ?>>1</option>
				</select>				
		</tr>
		<tr>
			<td><?php _e('View More button text'); ?></td>
			<td><input type="text" name="settings[FindMoreName]" value="<?php print @$ops['FindMoreName']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('View More button color'); ?></td>
			<td><input type="text" name="settings[FindMoreButtonColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['FindMoreButtonColor']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('View More button text color'); ?></td>
			<td><input type="text" name="settings[FindMoreButtonTextColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['FindMoreButtonTextColor']; ?>" /></td>
		</tr>
		<tr>
			<td><?php _e('Description header text'); ?></td>
			<td>
				<input type="radio" name="settings[showDesBigTxt]" value="1" <?php print (@$ops['showDesBigTxt'] == 1) ? 'checked' : ''; ?>><span><?php _e('Show'); ?></span>
				<input type="radio" name="settings[showDesBigTxt]" value="0" <?php print (@$ops['showDesBigTxt'] == 0) ? 'checked' : ''; ?>><span><?php _e('Hide'); ?></span>					
			</td>
		</tr>
		<tr>
			<td><?php _e('Description text'); ?></td>
			<td>
				<input type="radio" name="settings[showDesSmlTxt]" value="1" <?php print (@$ops['showDesSmlTxt'] == 1) ? 'checked' : ''; ?>><span><?php _e('Show'); ?></span>
				<input type="radio" name="settings[showDesSmlTxt]" value="0" <?php print (@$ops['showDesSmlTxt'] == 0) ? 'checked' : ''; ?>><span><?php _e('Hide'); ?></span>					
			</td>
		</tr>

		<tr>
			<td><?php _e('Traget Link'); ?></td>
			<td>
				<input type="radio" name="settings[target]" value="_blank" <?php print (@$ops['target'] == "_blank") ? 'checked' : ''; ?>><span><?php _e('New Window'); ?></span>
				<input type="radio" name="settings[target]" value="_self" <?php print (@$ops['target'] == "_self") ? 'checked' : ''; ?>><span><?php _e('Same Window'); ?></span>
			</td>
		</tr>
		<tr>
			<td><?php _e('Select the wmode of flash'); ?></td>
			<td>
				<select name="settings[wmode]"> 
					<option value="opaque" <?php print (@$ops['wmode'] == "opaque") ? 'selected' : ''; ?>>opaque</option>
					<option value="transparent" <?php print (@$ops['wmode'] == "transparent") ? 'selected' : ''; ?>>transparent</option>
					<option value="window" <?php print (@$ops['wmode'] == "window") ? 'selected' : ''; ?>>window</option>
				</select>			
			</td>
		</tr>
		</table>
	<p><button type="submit" class="button-primary"><?php _e('Save Config'); ?></button></p>
	</form>
</div>
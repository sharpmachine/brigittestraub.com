</div> 
 
<div class="postbox" >
	<h3><?php _e('Monetize', 'easytoolbox'); ?></h3>
	
		<div class="inside">
		<P><?php _e('You can put advertising on your site to monetize your hard work ...','easytoolbox'); ?></p>
		
		<table class="form-table">
		        <tr valign="top">
		        <th scope="row"><img src="../wp-content/plugins/easy-toolbox/images/money.png" width="20px" height="20px"/><?php _e('Monetize your Blog','easytoolbox'); ?></th>
		        <td><input type="checkbox" class="checkbox" name="etb_choix_adsense" id="etb_choix_adsense" value="1" <?php checked('1', get_option('etb_choix_adsense')); ?> /><?php _e('I want to show advertising on my website.','easytoolbox'); ?></td>
		        </tr>
		        
		        <tr valign="top">
		        <th><?php _e('Put advertising in your content','easytoolbox'); ?></th>
		        <td>
		        <select name="etb_ad_content" id="etb_ad_content">
		        	<option value="0" <?php if(get_option('etb_ad_content') == '0'){?>selected="selected"<?php }?>><?php _e('I don&apos;t want advertisement in my content','easytoolbox'); ?></option>
		        	<option value="1" <?php if(get_option('etb_ad_content') == '1'){?>selected="selected"<?php }?>><?php _e('At the top of my content (efficient)','easytoolbox'); ?></option>
		        	<option value="2" <?php if(get_option('etb_ad_content') == '2'){?>selected="selected"<?php }?> ><?php _e('At the Bottom of my content (moderatly good)','easytoolbox'); ?></option>
		        	<option value="3" <?php if(get_option('etb_ad_content') == '3'){?>selected="selected"<?php }?>><?php _e('At the top and at the bottom of my content (very efficient)','easytoolbox'); ?></option>
		        </select><br>
		        </td>
			</tr>  
		</table>

<!-- AJOUTER ou MODIFIER un Script -->
		<?php $google_ad_content = get_option('etb_google_ad_content'); ?>
		
		<div class="more_options"><small><b><a id="open_options_google"><?php _e('Configure','easytoolbox'); ?></a></b></small></div>
			
			
<!-- **************** GOOGLE **************** -->
			<script>
			$('#open_options_google').toggle(function(){ $('#google_options').slideDown('slow'); },function(){ $('#google_options').slideUp('slow'); });
			</script>
		   
	<div id="google_options" style="display:none" >
	
	<div><img src="../wp-content/plugins/easy-toolbox/images/pointe_haute.png" style="margin:0px 0 0 255px" width="20px" height="9px"/></div>
		
		<div class="options">
		    
		<table class="form-table">
	
			<tr valign="top" >

		        <th scope="row"><img src="../wp-content/plugins/easy-toolbox/images/google_adsense.png" />
			        <br/><br/>
			        <?php _e('Find an Advertising Agency for monetise your blog','easytoolbox'); ?>			        
			        <br/><br/>
			        <img src="../wp-content/plugins/easy-toolbox/images/folder_open.png" /><a id="inline" class="gallery" href="#cleanagency">Clean agency</a><br/><br/>
			        <img src="../wp-content/plugins/easy-toolbox/images/folder_pink.png" /><a id="inline" class="gallery" href="#adultagency">Adult agency</a>
			        
			        
			        
<!-- CLEAN POPUP -->
		        <div style="display:none"><div id="cleanagency">
		        	<table class="widefat">
					<thead>
					    <tr>
					    	<th>logo</th>
					        <th>Name</th>
					        <th>Language</th>
					        <th>link</th>
					    </tr>
					</thead>
					
					<tbody>
					
					<!-- Google -->
					<tr>
					<td><img src="http://www.google.com/favicon.ico" width="20px" height="20px"/></td>
					<td><b>Google Adsense</b></td>
					<td>multi</td>
					<td><a target="blank" href="http://www.google.com/adsense/"><?php _e('Sign in','easytoolbox'); ?></a></td>
					</tr>
					
					</tbody>
					</table>
		        
		        	<p>Work in progress ... more soon</p>
		        	
		        </div></div>




<!-- ADULT POPUP -->
		        <div style="display:none"><div id="adultagency">
		        	<table class="widefat">
					<thead>
					    <tr>
					    	<th>logo</th>
					        <th>Name</th>
					        <th>Language</th>
					        <th>link</th>
					    </tr>
					</thead>
					
					<tbody>
					
					<!-- Carpediem -->
					<tr>
					<td><img src="http://www.carpediem.fr/favicon.ico" width="20px" height="20px"/></td>
					<td><b>Carpediem</b></td>
					<td>multi</td>
					<td><a target="blank" href="http://www.carpediem.fr/corpo/home.html?p=r&r=52146&u=partenariat"><?php _e('Sign in','easytoolbox'); ?></a></td>
					</tr>
					
					<!-- Easyflirt -->
					<tr>
					<td><img src="http://www.easyflirt-partners.biz/favicon.ico" width="20px" height="20px"/></td>
					<td><b>EasyFlirt</b></td>
					<td>multi</td>
					<td><a target="blank" href="http://www.easyflirt-partners.biz/index.php?pr=38150"><?php _e('Sign in','easytoolbox'); ?></a></td>
					</tr>

					</tbody>
					</table>
					
					<p>Work in progress ... more soon</p>
		        
		        </div></div>

			        
			        
			        
			        
			        
			        <br/><br/>
			        <hr>
			        <br/>
			        <i><?php _e('For add ads on your sidebar, just use the ','easytoolbox'); ?><a href="<?php echo admin_url('widgets.php'); ?>"><?php _e('Widgets','easytoolbox'); ?></a>.</i>
			    </th>
			    
		        <td><?php _e('Enter your top advertising script here','easytoolbox'); ?>
		        <textarea name="etb_google_ad_content_top" id="etb_google_ad_content_top" cols="70" rows="8"  />
		        <?php echo get_option('etb_google_ad_content_top'); ?>
				</textarea>
		        </td>
			</tr>
			
			<tr valign="top" >

		        <th scope="row"></th>
		        <td><?php _e('And enter your bottom advertising script here)','easytoolbox'); ?>
		        <textarea name="etb_google_ad_content_bottom" id="etb_google_ad_content_bottom" cols="70" rows="8"  />
		        <?php echo get_option('etb_google_ad_content_bottom'); ?>
				</textarea></td>
			</tr>

		</table>
		</div>
					
	</div>  <!-- Google Options --> 
	

	</div>  <!-- inside --> 
</div>  <!-- postbox pub --> 
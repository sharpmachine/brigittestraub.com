<div class="postbox" >	    
		<h3><?php _e('Optimize','easytoolbox'); ?></h3>
			<div class="inside"> 
			<P><?php _e('To optimize your ranking, please enter the information below','easytoolbox'); ?></p>
		
			<table class="form-table">
			    
			    	<tr valign="top">
			        <th scope="row"><?php _e('Search engine optimization','easytoolbox'); ?></th>
			        <td><input type="checkbox" class="checkbox" id="etb_choix_SEO" name="etb_choix_SEO" value="1" <?php checked('1', get_option('etb_choix_SEO')); ?> /><?php _e('I wish EasyToolbox optimize my site for search engines. If you check this box, you must disable all other SEO plugins on your blog ... We take care of everything.','easytoolbox'); ?></td>
			        </tr>

			        <tr valign="top">
			        <th scope="row"><?php _e('Keywords','easytoolbox'); ?></th>
			        <td><input type="text" name="etb_keyword_home" size="60" value="<?php echo get_option('etb_keyword_home'); ?>" /><br><small><?php _e('Some search engines still use META keywords. To enhance your Search Engine Optimization (SEO), please enter the important keywords related to your editorial line. Maximum 10 and separated by a comma <i>(eg house, deocration, ecology)','easytoolbox'); ?></i></small></td>
			        </tr>    
			</table>
			    
			    
			<table class="form-table">
		        <tr valign="top">
		       
		        
		        <th scope="row"><a href="http://www.google.com/analytics/" target="blank"><img src="http://www.google.com/analytics/favicon.ico" width="20px" height="20px"/></a>ID Google Analytics <a id="inline" class="gallery" href="#id_analytics" style="cursor:help;">?</a></th>
		        <div style="display:none"><div id="id_analytics"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-analytics.png"/><br><?php _e('Enter your Google Analytics here, if you do not already have you can get one here : ','easytoolbox'); ?><a target="blank" href="http://analytics.google.com">Souscrire</a>
</div></div>
				<td><input type="text" name="etb_analytics" value="<?php echo get_option('etb_analytics'); ?>" /></td>
				
				 <th scope="row"><a href="http://getclicky.com/66398326" target="blank"><img src="http://getclicky.com/favicon.ico" width="20px" height="20px"/></a><?php _e('Real time analytics ','easytoolbox'); ?><a href="http://getclicky.com/66398326">GetClicky</a></th>
		        
				<td><input type="text" name="etb_getclicky" value="<?php echo get_option('etb_getclicky'); ?>" /></br><small>find ID : Getclicky/your site/pref/Site ID</small></td>
				
				
				</tr>    
			</table>
			
			<div class="more_options"><small><b><a id="open_option_webmasters"><?php _e('More options','easytoolbox'); ?></a></b></small></div>
			
			<script>
			$('#open_option_webmasters').toggle(function(){ $('#options_webmaster').slideDown('slow'); },function(){ $('#options_webmaster').slideUp('slow'); });
			</script>
			
			<div id="options_webmaster"  style="display:none;">
			<div><img src="../wp-content/plugins/easy-toolbox/images/pointe_haute.png" style="margin:0px 0 0 260px" width="20px" height="9px"/></div>
			<div class="options">
			<p><b><?php _e('Webmaster Tools : ','easytoolbox'); ?></b><?php _e('Optimize your website with search engine tools','easytoolbox'); ?></p>
			<table class="form-table">
		        <tr valign="top">

		       	<th scope="row"><a href="http://www.google.com/webmasters/tools/" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/google.png" width="20px" height="20px"/></a>ID Google WebmasterTools <a id="inline" class="gallery" href="#webmastertools" style="cursor:help;"> ?</a></th>
		        <div style="display:none"><div id="webmastertools"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-webmastertools.png"/><br><?php _e('Enter your Google WebmasterTools Code here, if you do not already have you can get one here : ','easytoolbox'); ?><a target="blank" href="http://www.google.com/webmasters/tools/"><?php _e('Subscribe','easytoolbox'); ?></a>
</div></div>
				<td><input type="text" name="etb_webmastertools" value="<?php echo get_option('etb_webmastertools'); ?>" /></td>
				
				<th scope="row"><a href="http://www.bing.com/webmaster/" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/bing.png" width="20px" height="20px"/></a>ID Bing Webmaster<a id="inline" class="gallery" href="#bing_webmaster" style="cursor:help;"> ?</a></th>
		        <div style="display:none"><div id="bing_webmaster"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-bing.jpg"/><br><?php _e('Enter your Bing Webmaster Code here, if you do not already have you can get one here : ','easytoolbox'); ?><a target="blank" href="http://www.bing.com/webmaster/"><?php _e('Subscribe','easytoolbox'); ?></a>
</div></div>
				<td><input type="text" name="etb_bing_webmaster" value="<?php echo get_option('etb_bing_webmaster'); ?>" /></td>


		        </tr>
		        
		        <tr valign="top">

		       	<th scope="row"><a href="https://siteexplorer.search.yahoo.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/yahoo.png" width="20px" height="20px"/></a>ID Yahoo Site Explorer <a id="inline" class="gallery" href="#yahoo_siteexplorer" style="cursor:help;"> ?</a></th>
		        <div style="display:none"><div id="yahoo_siteexplorer"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-yahoo.png"/><br><?php _e('Enter your Yahoo Site Explorer Code here, if you do not already have you can get one here : ','easytoolbox'); ?><a target="blank" href="https://siteexplorer.search.yahoo.com"><?php _e('Subscribe','easytoolbox'); ?></a>
</div></div>
				<td><input type="text" name="etb_yahoo_site_explorer" value="<?php echo get_option('etb_yahoo_site_explorer'); ?>" /></td>
				
				<th scope="row"><a href="http://www.alexa.com/edit/claim/" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/alexa.png" width="20px" height="20px"/></a>ID Alexa <a id="inline" class="gallery" href="#alexa" style="cursor:help;"> ?</a> | <a target="blank" href="http://www.alexa.com/siteinfo/<?php bloginfo('url'); ?>"><?php _e('Site info','easytoolbox'); ?></a></th>
		        <div style="display:none"><div id="alexa"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-alexa.png"/><br><?php _e('Enter your alexa meta Code here, if you do not already have you can get one here : ','easytoolbox'); ?><a target="blank" href="http://www.alexa.com/edit/claim/"><?php _e('Subscribe','easytoolbox'); ?></a>
</div></div>
				<td><input type="text" name="etb_alexa_verif" value="<?php echo get_option('etb_alexa_verif'); ?>" /></td>
				
				
				</tr>
		   </table>
		</div>  
		</div>    
			    
			    
			</div>  <!-- inside --> 
</div>  <!-- postbox ref --> 
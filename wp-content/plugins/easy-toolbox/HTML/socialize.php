<div class="postbox" >
	
	<h3><?php _e('Social networks and analysis tools','easytoolbox'); ?></h3>
		<div class="inside" >
		<P><?php _e('NB: We strongly recommend to complete all these fields. Your site will have much more chance to increase its frequentation','easytoolbox'); ?></p>
		   
<!-- TWITTER -->		    
		    <table class="form-table" style="margin-bottom:10px">
		        <tr valign="top">
		        <th scope="row" ><a href="http://twitter.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/twitter.png" width="20px" height="20px"/></a><?php _e('Login Twitter', 'easytoolbox'); ?><a id="inline" class="gallery" href="#help_twitter" style="cursor:help;">?</a></th>		        
				<div style="display:none"><div id="help_twitter"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-twitter.png" /><br/><?php _e('Enter your Twitter username here, if you do not already have it, you can get one here : ','easytoolbox'); ?><a target="blank" href="http://www.twitter.com"><?php _e('Subscribe', 'easytoolbox'); ?></a>
</div></div>
				<td><input type="text" name="etb_twitter" value="<?php echo get_option('etb_twitter'); ?>"/></td>
		        
		        </tr>

 			<?php $choix_tweet_format = get_option('etb_tweet_format'); ?> 
		        <tr valign="top">
		        <th scope="row"><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://easytoolbox.net" data-text="I love this plugin wordpress http://easytoolbox.net" data-count="<?php echo $choix_tweet_format ?>" data-via="easytoolbox">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></th>
		        <td><input type="checkbox" class="checkbox" id="etb_choix_tweet" name="etb_choix_tweet" value="1" <?php checked('1', get_option('etb_choix_tweet')); ?> /><?php _e('Add twiter button as a result of my content','easytoolbox'); ?><i> <?php _e('(advisable)','easytoolbox'); ?></i>. <?php _e('Format','easytoolbox'); ?> <select name="etb_tweet_format" id="etb_tweet_format">
		        	<option value="vertical" <?php if(get_option('etb_tweet_format') == 'vertical'){?>selected="selected"<?php }?>><?php _e('vertical count','easytoolbox'); ?></option>
		        	<option value="horizontal" <?php if(get_option('etb_tweet_format') == 'horizontal'){?>selected="selected"<?php }?>><?php _e('horizontal count','easytoolbox'); ?></option>
		        	<option value="none" <?php if(get_option('etb_tweet_format') == 'none'){?>selected="selected"<?php }?> ><?php _e('logo only','easytoolbox'); ?></option>
		        </select>
		        </td>
		        </tr>
		    </table>
		    <hr style="color:#333333; border:0; background-color:#eeeeee; width:90%; height: 1px;">
		    
<!-- +1 boutton -->		    
		    <table class="form-table" style="margin-bottom:10px">
		        
 			<?php $choix_plusone_format = get_option('etb_plusone_format'); ?> 
		        <tr valign="top">
		        <th scope="row">
		        <g:plusone size="<?php echo $choix_plusone_format ?>"></g:plusone>
		        </th>
		        
		        
		        <td>
		        <input type="checkbox" class="checkbox" id="etb_choix_plusone" name="etb_choix_plusone" value="1" <?php checked('1', get_option('etb_choix_plusone')); ?> /><?php _e('Add Google +1 button as a result of my content','easytoolbox'); ?><i> <?php _e('(advisable)','easytoolbox'); ?></i>. <?php _e('Format','easytoolbox'); ?> 
		        <select name="etb_plusone_format" id="etb_plusone_format">
		        	<option value="small" <?php if(get_option('etb_plusone_format') == 'small'){?>selected="selected"<?php }?>><?php _e('Small (15 px)','easytoolbox'); ?></option>
		        	<option value="medium" <?php if(get_option('etb_plusone_format') == 'medium'){?>selected="selected"<?php }?>><?php _e('Medium (20px)','easytoolbox'); ?></option>
		        	<option value="standard" <?php if(get_option('etb_plusone_format') == 'standard'){?>selected="selected"<?php }?> ><?php _e('Standard (24 px)','easytoolbox'); ?></option>
		        	<option value="tall" <?php if(get_option('etb_plusone_format') == 'tall'){?>selected="selected"<?php }?> ><?php _e('Tall (60px)','easytoolbox'); ?></option>
		        </select>
		        </td>
		        </tr>
		    </table>
		    <hr style="color:#333333; border:0; background-color:#eeeeee; width:90%; height: 1px;">
		    
		    
		    		    
<!-- FACEBOOK -->		
			<table class="form-table">         
		        <tr valign="top">
		        <th scope="row"><a href="http://facebook.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/facebook.png" width="20px" height="20px"/></a><?php _e('Login Facebook ', 'easytoolbox'); ?> <a id="inline" class="gallery" href="#help_facebook" style="cursor:help;">?</a></th>
		        		        
				<div style="display:none"><div id="help_facebook"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-facebook.png"/><br/><?php _e('Enter your Facebook Username here, if you do not already have it, you can get one here : ','easytoolbox'); ?><a target="blank" href="http://www.facebook.com/username/"><?php _e('Subscribe', 'easytoolbox'); ?></a>
</div></div>
				<td><input type="text" name="etb_facebook" value="<?php echo get_option('etb_facebook'); ?>" /><br/></td>
		        
		        <td><div class="more_options"><small><b><a id="fb_options" class="gallery" href="#option_facebook" style="text-decoration:none;"><?php _e('More facebook options','easytoolbox'); ?></a></b></small></div></td>
		        
		         </tr>
		    </table>
		        
		<!-- BOITE OPTIONS FACEBOOK -->      
		<div style="display:none;" valign="top"><div id="option_facebook" style="padding:10px;background-color:#eeeeee;"> 
		<img src="../wp-content/plugins/easy-toolbox/images/facebook-grunge-icon.png" width="256px" height="120px"/><br/>
			<input type="text" name="etb_facebookid" value="<?php echo get_option('etb_facebookid'); ?>" /> <?php _e('ID Facebook ', 'easytoolbox'); ?> <a id="iframe" class="gallery" href="https://graph.facebook.com/<?php echo get_option('etb_facebook'); ?>" title="test" style="cursor:help;">?</a><br/>
			<input type="text" name="etb_idapps_facebook" value="<?php echo get_option('etb_idapps_facebook'); ?>" /> <?php _e('ID Application ', 'easytoolbox'); ?> <?php _e('(advisable)','easytoolbox'); ?> <a href="http://developers.facebook.com/setup/" target="blank">?</a><br/>

			<h4><?php _e('Like button options', 'easytoolbox'); ?></h4>
			<input type="checkbox" class="checkbox" id="etb_show_faces_facebook" name="etb_show_faces_facebook" value="true" <?php checked('true', get_option('etb_show_faces_facebook')); ?> /><?php _e('Show Faces','easytoolbox'); ?> <i><small><?php _e('(standard layout only)','easytoolbox'); ?></small></i><br/><small><?php _e('specifies whether to display profile photos below the button','easytoolbox'); ?></small><br/> 
			
	<TABLE border="1" height="50px" width="100%" >
		<TR height="30px">
			<TD><?php _e('Color Scheme','easytoolbox'); ?></TD>
			<TD><select name="etb_colorscheme_facebook" id="etb_colorscheme_facebook">
		        	<option value="light" <?php if(get_option('etb_colorscheme_facebook') == 'light'){?>selected="selected"<?php }?>><?php _e('light','easytoolbox'); ?></option>
		        	<option value="dark" <?php if(get_option('etb_colorscheme_facebook') == 'dark'){?>selected="selected"<?php }?>><?php _e('dark','easytoolbox'); ?></option>
		        	<option value="evil" <?php if(get_option('etb_colorscheme_facebook') == 'evil'){?>selected="selected"<?php }?> ><?php _e('evil','easytoolbox'); ?></option>
			</select></TD>
		</TR>
			
		<TR height="30px">
			<TD><?php _e('Layout Style','easytoolbox'); ?></TD>
			<TD><select name="etb_layout_facebook" id="etb_layout_facebook">
		        	<option value="standard" <?php if(get_option('etb_layout_facebook') == 'standard'){?>selected="selected"<?php }?>><?php _e('standard','easytoolbox'); ?></option>
		        	<option value="button_count" <?php if(get_option('etb_layout_facebook') == 'button_count'){?>selected="selected"<?php }?>><?php _e('button count','easytoolbox'); ?></option>
			</select></TD>
		</TR>
			
		<TR height="30px">
			<TD><?php _e('Font','easytoolbox'); ?></TD>
			<TD><select name="etb_font_facebook" id="etb_font_facebook">
		        	<option value="arial" <?php if(get_option('etb_font_facebook') == 'arial'){?>selected="selected"<?php }?>><?php _e('arial','easytoolbox'); ?></option>
		        	<option value="lucida+grande" <?php if(get_option('etb_font_facebook') == 'lucida+grande'){?>selected="selected"<?php }?>><?php _e('lucida grande','easytoolbox'); ?></option>
		        	<option value="segoe+ui" <?php if(get_option('etb_font_facebook') == 'segoe+ui'){?>selected="selected"<?php }?> ><?php _e('segoe ui','easytoolbox'); ?></option>
		        	<option value="tahoma" <?php if(get_option('etb_font_facebook') == 'tahoma'){?>selected="selected"<?php }?> ><?php _e('tahoma','easytoolbox'); ?></option>
		        	<option value="trebuchet+ms" <?php if(get_option('etb_font_facebook') == 'trebuchet+ms'){?>selected="selected"<?php }?> ><?php _e('trebuchet ms','easytoolbox'); ?></option>
		        	<option value="verdana" <?php if(get_option('etb_font_facebook') == 'verdana'){?>selected="selected"<?php }?> ><?php _e('verdana','easytoolbox'); ?></option>
			</select></TD>
		</TR>


	</TABLE>
		<hr style="border:0; background-color:#fff; width:90%; height: 1px;">
		<div style="text-align:center;"><small><?php _e('You can see your stats facebook here :','easytoolbox'); ?> <a href="http://www.facebook.com/insights/" target="blank"><b>insights</b></a></small></div>
			
		</div></div>
		<!-- FIN BOITE OPTIONS FACEBOOK -->   
		        
		   
		    
		     

		    <table class="form-table">
		        <tr valign="top">
		        <th scope="row"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Feasytoolbox.net&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe></th>
		        <td><input type="checkbox" class="checkbox" id="etb_choix_like" name="etb_choix_like" value="true" <?php checked('true', get_option('etb_choix_like')); ?> /><?php _e('Add button "Like" facebook as a result of my content','easytoolbox'); ?><i> <?php _e('(advisable)','easytoolbox'); ?></i></td>
		        </tr>
		    </table>
		 <hr style="color:#333333; border:0; background-color:#eeeeee; width:90%; height: 1px;">
		 
		 
<!-- SHARE -->
		    <table class="form-table"> 
		        <tr valign="top">
		        <th scope="row"><img src="../wp-content/plugins/easy-toolbox/images/share.png" /></th>
		        <td><input type="checkbox" class="checkbox" name="etb_choix_share" id="etb_choix_share" value="1" <?php checked('1', get_option('etb_choix_share')); ?> /><?php _e('Add the \"share on social networks\" after my posts. ','easytoolbox'); ?></td>
		        
   
		        </tr>
		    </table>
		    
		    
<hr style="color:#333333; border:0; background-color:#eeeeee; width:90%; height: 1px;">
		        
		<table class="form-table" style="margin-bottom:10px">
		        
 			<?php $choix_post_page = get_option('etb_post_page'); ?> 
		        <tr valign="top">
		        <th scope="row">
		        
		        </th>
		        
		        
		        <td>
		        <?php _e('Add boutons on','easytoolbox'); ?>		        
		        
		        <select name="etb_post_page" id="etb_post_page">
		        	<option value="post" <?php if(get_option('etb_post_page') == 'post'){?>selected="selected"<?php }?>><?php _e('posts','easytoolbox'); ?></option>
		        	<option value="page" <?php if(get_option('etb_post_page') == 'page'){?>selected="selected"<?php }?>><?php _e('pages','easytoolbox'); ?></option>
		        	<option value="both" <?php if(get_option('etb_post_page') == 'both'){?>selected="selected"<?php }?> ><?php _e('posts and pages','easytoolbox'); ?></option>
		        	
		        </select>
		        </td>
		        </tr>
		    </table>
		    
		    
		    
		    
		    
			
			<div class="more_options"><small><b><a id="open_options"><?php _e('More options','easytoolbox'); ?></a></b></small></div>
			
			<script>
			$('#open_options').toggle(function(){ $('#ls_balises').slideDown('slow'); },function(){ $('#ls_balises').slideUp('slow'); });
			</script>
			
			
						
			<div id="ls_balises"  style="display:none;">
			<div><img src="../wp-content/plugins/easy-toolbox/images/pointe_haute.png" style="margin:0px 0 0 260px" width="20px" height="9px"/></div>
			<div class="options">
			<p><b><?php _e('Here is the Geek\'s place!','easytoolbox'); ?></b> <i><?php _e('Optional fields:','easytoolbox'); ?></i><?php _e('  If you don\'t know these services, or if you haven\'t subscribed, please leave blank and go your way ...','easytoolbox'); ?></p>
				<table class="form-table">
		        <tr valign="top">
		        <th scope="row"><a href="http://flickr.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/flickr.png" width="20px" height="20px"/></a>Login Flickr</th>
		        <td><input type="text" name="etb_flickr" value="<?php echo get_option('etb_flickr'); ?>" /></td>
		        
		        <th scope="row" ><a href="http://netvibes.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/netvibes.png" width="20px" height="20px"/></a>Login Netvibes</th>
		        <td><input type="text" name="etb_netvibes" value="<?php echo get_option('etb_netvibes'); ?>" /></td>
		        </tr>
		         
		        <tr valign="top">
		        <th scope="row"><a href="https://buy.itunes.apple.com/WebObjects/MZFinance.woa/wa/publishPodcast" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/itunes.png" width="20px" height="20px"/></a><?php _e('Link for your Itunes Podcast', 'easytoolbox'); ?></th>
		        <td><input type="text" name="etb_itunes" value="<?php echo get_option('etb_itunes'); ?>" /><br/></td>
		        
		 
		         <th scope="row"><a href="http://feedburner.google.com/" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/feedburner.png" width="20px" height="20px"/></a><?php _e('Login feedburner ', 'easytoolbox'); ?><a id="inline" class="gallery" href="#help_feedburner" style="cursor:help;">?</a></th>
		       	<div style="display:none"><div id="help_feedburner"><img src="<?PHP echo WP_PLUGIN_URL ?>/easy-toolbox/HTML/help/help-feedburner.png"/><br/><?php _e('Enter your Feedburner code here, if you do not already it, have you can get one here : ','easytoolbox'); ?><a target="blank" href="http://www.feedburner.com"><?php _e('Subscribe', 'easytoolbox'); ?></a>
</div></div>

		        <td><input type="text" name="etb_feedburner" value="<?php echo get_option('etb_feedburner'); ?>" /></td>
		        </tr>
		        
		        <tr valign="top">
		        <th scope="row"><a href="http://youtube.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/youtube.png" width="20px" height="20px"/></a>YouTube</th>
		       	<td><input type="text" name="etb_youtube" value="<?php echo get_option('etb_youtube'); ?>" /></td>
		       	
		        <th scope="row"><a href="http://dailymotion.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/dailymotion.png" width="20px" height="20px"/></a>Dailymotion</th>
		        <td><input type="text" name="etb_dailymotion" value="<?php echo get_option('etb_dailymotion'); ?>" /></td>
		        </tr>
		        
		        <tr valign="top">
		        <th scope="row"><a href="http://wikio.com" target="blank"><img src="../wp-content/plugins/easy-toolbox/images/icon/wikio.png" width="20px" height="20px"/></a>wikio</th>
		       	<td><input type="text" name="etb_wikio" value="<?php echo get_option('etb_wikio'); ?>" /></td>
		        </tr>
		        

		    </table>
		    </div>
		   </div>  <!-- plus d'options -->   
		</div>  <!-- inside --> 
</div>  <!-- postbox social --> 

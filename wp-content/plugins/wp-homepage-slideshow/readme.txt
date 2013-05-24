=== Homepage SlideShow ===

Contributors: wpslideshow.com
Donate link: http://wpslideshow.com/homepage-slideshow/
Tags: homepage, slideshow, flash
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: Trunk

Homepage Slide Show is a plugin that allows you to display a flash slideshow on your homepage.
It is also allows us to use it as a widget.

== Description ==
screenshot-1.png
Homepage Slide Show is a plugin that allows you to display a flash slideshow on your homepage.
It is also allow us to use it as a widget. You can also enable this homepage slideshow on your wordpress site by placing code snippet in your template php file.

**Features**

* Customizable height and width
* Customizable background gradient color(start and end colors)
* Customizable menu color, menu mouse over color and active color
* Customizable menu text for every slide
* Customizable menu scroll speed
* Customizable info box color
* Customizable info box title
* Customizable info box button color
* Customizable info box button text
* Customizable info box alpha
* Customizable info box short description
* Auto Play option 
* Customizable auto slide time
* Show/Hide Description box

For a working demo, visit http://wpslideshow.com/homepage-slideshow/.

Installation Video: http://www.youtube.com/watch?feature=player_embedded&v=JdpMLgZVYNM



== Installation ==

1. Install automatically through the "Plugins", "Add New" menu in WordPress, or upload the <code>wp-homepage-slideshow</code> folder to the <code>/wp-content/plugins/</code> directory. 

2. Click on "Activate Plugin" to Activate the plugin or Activate the plugin by click on `Plugins` menu and click on activate link below plugin name.

3. You can find "HSS" link  on left side menu. Go to album management under HSS and create categories and upload images into those catetegories. 

= short codes for content =

* <code>[hss]</code> - Use this short code in the content / post to display all images under all categories which are not disabled.

* <code>[hss cats=2,3]</code> - Use this short code in the content / post to display all images under the categories with ID's 2,3.

* <code>[hss imgs=1,2,3]</code> - Use this short code in the content / post to display images which has ID's 1,2,3.

= short codes for template =

* <code><?php echo do_shortcode('[hss]');?></code> - Use this short code in the template (php file) to display all images under all categories which are not disabled.

* <code><?php echo do_shortcode('[hss cats=2,3]');?></code> - Use this short code in the template (php file) to display all images under the categories with ID's 2,3.

* <code><?php echo do_shortcode('[hss imgs=1,2,3]');?></code> - Use this short code in the template (php file) to display images which has ID's 1,2,3.

= Installation Video =

* Installation Video: http://www.youtube.com/watch?feature=player_embedded&v=JdpMLgZVYNM

* For a working demo, visit http://wpslideshow.com/homepage-slideshow/.


* Still if you have problems in using this plugin please open a support ticket at http://support.xmlswf.com

== Screenshots ==

1. screenshot-1.gif - Slideshow front end. 

2. screenshot-2.gif - Slideshow front end. 

3. screenshot-3.gif - Edit image.

4. screenshot-4.png - bulk upload.

5. screenshot-5.gif - edit album / category.

6. screenshot-6.gif - short code to be placed in the content.

7. screenshot-7.gif - Edit Category.

8. screenshot-8.gif - Compatible with iPad.

9. screenshot-7.gif - Compatible with iPhone.


== Changelog ==

= 1.0 =
First version of the plugin.

= 1.1 =

Added wmode and menu link customisation

= 1.3 =

Added slideshow transition type effect and menu transition speed etc..

= 1.4 =

Customizable Show / Hide Description Box.

= 1.5 =

Modified Default sample text and its coresponding slideshow settings in admin

= 2.0=

We rebuilt it in a way to support categoris and bulk images. It is not possible to upgrade to new version, you just need to uninstall old one an install new one.

= 2.2=

Fixed security bugs
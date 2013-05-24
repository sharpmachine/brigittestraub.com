=== YouTube Uploader ===
Contributors: Dan Harabor
Tags: youtube, upload, browser based
Tested up to: 3.0
Requires at least: 2.8
Stable tag: 0.3

This plugin allows you to upload your videos on youtube without leaving wordpress. Useful especially for video blogging sites.

== Description ==

This plugin allows you to upload your videos on youtube without leaving wordpress. It doesn't require any 3rd party library, being easy to install and administer.
It uses broswer-based uploading in a wordpress uploader like interface, your videos will be uploaded directly to youtube (so no traffic will be wasted uploading videos first to your website, and after that to youtube).
Youtube authentification data is different for each wordpress user, making it secure to use in multi-user wordpress enviroment. 
Authentification can be either done by storing youtube username/password (less secure) or by requesting a session token (if you don't want your username/password to be stored in the database)   

== Requirements ==

1. Curl library
2. Youtube API developer key (you can get it from : http://code.google.com/apis/youtube/dashboard/)


== Installation ==

1. Upload `youtube-uploader` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enter your developer key and choose the method of authentification to youtube.
4. When adding/editing a post, choose youtube uploader tab when you want to upload your video on youtube

== Screenshots ==
1. Youtube uploader settings -> screenshot-1.jpg
2. Authorizing your blog to upload on youtube -> screenshot-2.jpg
3. Enter information about the uploaded video -> screenshot-3.jpg
4. Update video information and insert video into post after upload -> screenshot-4.jpg

== Changelog ==

= 0.1 =

* Initial version

= 0.2 =

* Removed allow_url_fopen from requirements

= 0.3 =

* Fixed bug: only administrators could add their youtube authentification data (Thanks to Mac)

== Frequently Asked Questions ==

= I get an error "Call to undefined function curl_init()" when accessing the uploader =

Youtube uploader needs curl library to be installed on the servers.

= Why is "You must choose a developer key from the settings page" displayed when i try to access youtube uploader tab? =

You did not save your user base youtube uploader settings. Go to Settings->Youtube uploader and enter your developer key and authentification info.

= Are there any limitations in using youtube uploader? =

The only limitations comes from youtube api limitation - which is 2000 video uploaded per account.

= My videos will be visible imediatlly after upload? =

Availability of the videos depends on how fast youtube will convert your videos. The "status" field in the uploader form will give you informations about the current status of your uploaded video.

= Can i upload more than 1 file? =

Currently, due to a flash/swfupload bug, multiple file uploading to youtube was disabled. This could be enabled in the future versions.

= I'd like to see a feature/I have a bug to report =

Go to http://www.php-code.net/2010/07/youtube-uploader-wordpress-plugin and leave a comment.
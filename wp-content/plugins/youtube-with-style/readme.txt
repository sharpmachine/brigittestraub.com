=== Youtube with Style ===
Contributors: Chris McCoy
Donate link: http://github.com/chrismccoy
Tags: video,youtube,search,media,post,shortcode
Requires at least: 3.0
Tested up to: 3.4.2
Stable tag: trunk

You Tube with Style lets you post Youtube videos in a stylish way while taking advantage of Youtube hosting your content.

== Description ==

<blockquote>
You Tube with Style is a plugin I created at first for myself, because I wanted to show You Tube videos on my site(s) without using the ugly default player You Tube has.

You Tube with Style lets you insert shortcodes via your post/page screen, and even search for You Tube videos via the You Tube API, so you never have to leave your site to find videos to post.
</blockquote>

<b>IMPORTANT!</b>

This plugin requires PHP5, and Wordpress 3.0 and Above.

You Tube API Important Links:

* <a href="http://code.google.com/apis/youtube/terms.html" title="Youtube API TOS">Youtube API Terms of Service</a>
* <a href="http://code.google.com/apis/youtube/2.0/developers_guide_protocol.html" title="Youtube API Developers Guide">Youtube API Developers Guide</a>
* <a href="http://code.google.com/apis/youtube/getting_started.html">Getting Started with the Youtube API</a>

= Features =

* Shortcode : You can add Youtube videos via shortcodes in your posts/pages
* AJAX Youtube Search: Search via the Post/Page Screen to quickly add videos without leaving your site.

== Installation ==

1. Install & Activate the plugin

2. Go to your post/page an enter the tag `[youtube]videoid[/youtube]` 

See more in the FAQ section.

== Frequently Asked Questions ==

<b>Remember this plugin requires PHP5 and Wordpress 3.0 and above.</b>

When writing a page/post, you can use the follow tags:

* `[youtube]videoid[/youtube]`

example:

* `[youtube]eBGIQ7ZuuiU[/youtube]`

You can force the width and height, thumbnail, and autoplay of the player with the following shortcode: (this overrides the values in the settings panel)

* `[youtube width="400" height="300"]eBGIQ7ZuuiU[/youtube]`

You can also create your own playlist by including multiple ids

* `[youtube width="400" height="300"]eBGIQ7ZuuiU,fFJuXCjflXo,foFOcK6suzg[/youtube]`

== Changelog == 
= V9.0 =
* Added: New Player with play list support

== Upgrade Notice ==

= 9.0 =
Whole Plugin rewritten, all old features removed due to changes in the API

== Support ==
For support contact chris@lod.com

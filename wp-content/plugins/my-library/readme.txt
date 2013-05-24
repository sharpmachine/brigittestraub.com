=== My Library ===
Contributors: rwmcfa1
Donate link: http://www.xormedia.com/
Tags: books, library, reading
Requires at least: 3.0
Tested up to: 3.1
License: GPLv2 or later
Stable Tag: 0.9.2

Allows you to feature and rate books you've read and are currently reading and 
links them to Amazon with an affiliate tag.

== Description ==

My Library allows you to feature books you've read and are currently reading via
a side-bar widget and shortcodes that can be embedded in pages or posts. You can
also rate them and the books will link to Amazon.com using your affiliate tag.

Questions/Comments/Suggestions welcome.

== Installation ==

Upload the My Library plugin to your blog, Activate it.

Add books (in theory you can add any Amazon item, but YMMV) by going to the My
Library admin section. You can find the ASIN for the item by searching on
Amazon.com and grabbing the ID portion of the url, e.g. in:
    http://www.amazon.com/gp/product/055305340X/ref=s9_bbs_g...
the ASIN would be:
    055305340X
or the ISBN-10 value out of the "Product Details" section.

Once you have items in your library you can add and customize the My Library/I'm
Currently Reading the widget.

Create a custom page for your library using the following sortcodes:

default order is rating desc and default limit is 4:

    [my_library title="My Favorites"]

sort by date added desc and include 8 items

    [my_library title="Most Recent" order="added desc" limit=8]

title is optional.

available orders:

    name asc/desc
    rating asc/desc
    added asc/desc

You can then go in to My Library settings and provide a link to your page so
that the widget will link to it.

You're done!

== Frequently Asked Questions ==

They'll live here as soon as there are FAQ's.

== Screenshots ==

1. Example of the sidebar "I'm Currently Reading" widget.
2. Simple My Library page created using shortcodes.

== Upgrade Notice ==

= 0.9.2 = 
Fixes an issue around version numbers and upgrades. You may, unfortunately have
to deactivate, delete, and then re-install the plugin to make Wordpress happy
about the version stuff. Sorry about that. Good news is that any items you've
created will still be there waiting for you once you're done.

= 0.9.0 = 
b/c it's the only version that exists :)

== Changelog ==

= 0.9.2 = 
fix css include path
fix version number issues

= 0.9.0 =
* initial release

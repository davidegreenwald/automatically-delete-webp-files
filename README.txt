(Don't forget the readme validator: https://wordpress.org/plugins/developers/readme-validator/)

=== Automatically Delete Webp Images ===
Contributors: davidegreenwald
Tags: 
Tested up to: 3.4

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

When images are deleted from the Media Library, check for .webp copies to delete to prevent orphan files.

== Description ==

The WordPress Media Library does not have support for .webp files, which can be used to optimize images for Chrome and certain other browsers. This plugin adds a check to delete .webp copies when their parent images (.jpg, .png, or .gif files) are deleted from within WordPress, adding compatibility and preventing .webp files from being orphaned in the uploads folder. 

It will search for images in the formats image_name.webp and image_name.[original_extension].webp, and prevent namespace collisions to delete the correct files if both image.png.webp and image.jpg.webp exist.  

This allows you to use tools such as the WebPonize app to make .webp files with no need to track them in a database as plugins such as EWWW do.

== Installation ==

This plugin has no settings and works automatically once installed.

1. Upload the `delete-webp` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= What about regenerating thumbnails? =

This plugin works strictly with standard image deletion and is not intended for use with thumbnail regeneration. When changing thumbnail sizes, the best practice would be to wipe all .webp files, regenerate thumbnails, then regenerate .webp files. A plugin such as EWWW is a better fit for this use case.

= Does it work with bulk image deletion? =

Sure does.

= How can I display .webp images on my website? =

I recommend Cache Enabler.

== Screenshots ==

== Changelog ==

= 1.0 = First release.
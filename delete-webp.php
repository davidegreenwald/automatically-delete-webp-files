<?php
/*
Plugin Name: Automatically Delete Webp Files
Author Name: David Greenwald
Author URI: https://www.davidgreenwald.com
*/

/**
 * This plugin prevents .webp files from being orphaned in the Media Library.
 *
 * It makes sure to remove .webp files generated by EWWW (or from anywhere) when
 * their parent .jpg, .png or .gif image and thumbnails are deleted.
 *
 * This allows you to use tools such as the WebPonize app to make .webp files.
 *
 * It also allows you to safely empty the EWWW database table, which bloats
 * quickly and is only really necessary to track .webp files for deletion.
 *
 */

 function adwf_delete_webp_with_original_image( $attachmentid ) {
 	// check if we have an image being deleted
 	if( isset( $attachmentid ) ) {
 		// get the file path for the image being deleted
 		$img = get_attached_file( $attachmentid );
 		//get the file path without the .jpg, .png, or .gif extension
 		$img_root = preg_replace( '/\.jp(e)?g|\.png|\.gif/', '', $img );
 		// look for .webp files matching the path, including all thumbnails!
 		$webp_files = glob( $img_root . '*.webp' );

		/**
		 * We have to avoid file type namespace collisions so deleting img.png
		 * only deletes img.png.webp and not img.jpg.webp, too. We'll set this up
		 * with preg_match to check if a file has no extension (img.webp) or to make
		 * sure it matches the parent image before deleting.
		 *
		 * EWWW natively generates images in the img.[original ext].webp format.
		 */

		// Run preg_match on the original image before entering the loop
		preg_match( '/\.jp(e)?g|\.png|\.gif/', $img, $img_matches);

 		// do a foreach loop to delete each .webp image for original and thumbnails
 		foreach( $webp_files as $webp_file ) {
 			// just in case
			if( file_exists( $webp_file ) ) {
				// match for the .webp file's original extension
				// Preg Match returns 1, 0 or false on error
				// @link http://php.net/manual/en/function.preg-match.php
				$webp_match_test = preg_match( '/\.jp(e)?g|\.png|\.gif/', $webp_file, $webp_matches);
				// if no match, we have img.webp files - safe to delete
				// or if extensions match, only delete .webp from the correct parent
				if(
					$webp_match_test === 0
					||
					($webp_match_test === 1 && $webp_matches === $img_matches)
				) {
					wp_delete_file( $webp_file );
				}
 			 } // end if(file_exists)
 		 } // end foreach
 	} // end if(isset)
 } // end function
 add_action( 'delete_attachment', 'adwf_delete_webp_with_original_image' );
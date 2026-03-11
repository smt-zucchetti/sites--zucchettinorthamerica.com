<?php
/**
 * Force a transparent header on a defined list of post types or archives
 *
 * Useful WP functions:
 * is_post_type_archive()
 * is_singular()
 * is_category()
 */

function force_salient_transparent_header() {

    global $post;

	if ( is_singular('post') ) {
		update_post_meta($post->ID, '_force_transparent_header', 'on' );
	}

}

add_action( 'wp', 'force_salient_transparent_header' );
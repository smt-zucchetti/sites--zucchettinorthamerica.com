<?php
/**
 * Adds a few useful classes to the body, global site-
 * body tag and a class for the default page template.
 */

function addBodyClasses( $classes ) {

	global $post;

	// Add a class if we're using the default page template
	if (basename(get_page_template()) === 'page.php'){
		$classes[] = 'template-default-page';
	}

	// Add a global class handy for overrides 
	$classes[] = 'roketto';

	return $classes;
	
}

add_filter('body_class','addBodyClasses');
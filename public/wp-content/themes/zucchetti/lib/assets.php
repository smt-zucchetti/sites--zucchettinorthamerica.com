<?php

/**
 * enqueue_theme_scripts()
 * 
 * Remove the default salient child theme script and enqueue
 * compiled theme assets.
 */

function enqueue_theme_scripts() {

	$ih_theme = ih_theme();

	// Dequeue the salient child style
	wp_dequeue_style( 'salient-child-style' );

	// Cache busters
	$styles_cache_buster  = filemtime( get_stylesheet_directory() . '/dist/styles/main.css');
	$scripts_cache_buster = filemtime( get_stylesheet_directory() . '/dist/scripts/main.js');

	// Enqueue theme specific stylesheet
	wp_enqueue_style( $ih_theme['name'], get_stylesheet_directory_uri() . '/dist/styles/main.css', array('main-styles'), $styles_cache_buster );

	// Enqueue theme specific scripts
	wp_enqueue_script( $ih_theme['name'], get_stylesheet_directory_uri() . '/dist/scripts/main.js', array ( 'jquery' ), $scripts_cache_buster, true);

    wp_localize_script( $ih_theme['name'], 'ajax_vars', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ));
    
}

add_action( 'wp_enqueue_scripts', 'enqueue_theme_scripts' );



/**
 * Block Assets
 */

function enqueue_stylesheet_for_specific_shortcodes() {
    global $post;

    if (is_singular() && $post instanceof WP_Post) {
        // Define the shortcodes that should trigger a stylesheet
        $allowed_shortcodes = array('custom_icon_list', 'custom_testimonials', 'custom_logos', 'carousel_card');

        // Get the content of the post
        $content = $post->post_content;

        // Loop through allowed shortcodes and check if they exist in the content
        foreach ($allowed_shortcodes as $shortcode) {
            if (has_shortcode($content, $shortcode)) {
                $stylesheet = get_stylesheet_directory_uri() . '/dist/styles/' . $shortcode . '.css?ver=' . time();

                // Enqueue the stylesheet
                wp_enqueue_style($shortcode . '-style', $stylesheet, array(), null);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_stylesheet_for_specific_shortcodes');

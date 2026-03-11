<?php

/**
 * Custom Image sizes
 */
add_image_size( 'widescreen', 1920, 1080, true );
add_image_size( 'callout', 800, 600, true );

/**
 * Force the admin bar for administrators
 */
add_filter('show_admin_bar', function($show) {
    return current_user_can('administrator');
});

/**
 * Remove the salient "Global Sections" since we're using Templatera
 */
// add_action('wp_loaded', function () {
//     unregister_post_type('salient_g_sections');
// });

/**
 * Custom Menus
 */
// register_nav_menus([
//     'utility_navigation' => __('Utility Navigation', 'sage'),
// ]);

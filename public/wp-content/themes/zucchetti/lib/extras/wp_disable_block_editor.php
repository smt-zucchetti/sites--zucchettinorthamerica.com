<?php

/**
 * A list of post types on which to disable the Block Editor
 * @return $post_types array User defined post types
 */
function rk_disable_block_editor_post_types() {
    $post_types = array(
        '',
    );

    return $post_types;
}

/**
 * A list of page templates on which to disable the Block Editor
 * * @return $page_templates array User defined page Templates
 */
function rk_disable_block_editor_page_templates() {
    $page_templates = array(
        '',
    );

    return $page_templates;
}

/**
 * Dequeue the block library css asset on post types/templates slated
 * to have Gutenberg disabled.
 * @return false
 */
function rk_dequeue_block_library_css() {

    $post_type = get_post_type();
    $page_template_slug = get_page_template_slug();

    if ( in_array( $page_template_slug, rk_disable_block_editor_page_templates() ) || in_array( $post_type, rk_disable_block_editor_post_types() ) || get_option( 'page_for_posts' ) == get_the_ID() ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_style( 'wp-block-library' );
    }
}
add_action( 'wp_print_styles', 'rk_dequeue_block_library_css' );

/**
 * Disables Gutenberg on certain page templates
 * @param  var $is_enabled Gutenberg enabled flag
 * @param  var $post_type  current post_type
 */
function rk_disable_block_editor_on_posts($is_enabled, $post_type) {
    
    /**
     * Disable fpr the following post types
     * @var array $post_types list of post types on which to disable Gutenberg
     */
    if ( in_array($post_type, rk_disable_block_editor_post_types() ) ) {
        return false;
    }
    
    /**
     * Disable on certain page templates
     * @var page_template_slug gets the current page template slug
     * @var array
     */
    $page_template_slug = get_page_template_slug();
    if ( in_array($page_template_slug, rk_disable_block_editor_page_templates() ) ) {
        return false;
    }

    /**
     * Disable on post for pages
     */
    if ( get_option( 'page_for_posts' ) == get_the_ID()  ) {
        return false;
    }

    return $is_enabled;
    
}
add_filter('use_block_editor_for_post_type', 'rk_disable_block_editor_on_posts', 10, 2);
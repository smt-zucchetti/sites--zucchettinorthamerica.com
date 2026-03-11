<?php
/**
 * Plugin Name:       Register Custom Post Types
 * Description:       Registers a custom theme's Post Types and Taxonomies
 * Version:           1.0.0
 * Author:            Roketto
 * Author URI:        https://roket.to
 */

// Cool pluralize class https://gist.github.com/tbrianjones/ba0460cc1d55f357e00b

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

require plugin_dir_path( __FILE__ ) . 'includes/class-register-custom-theme-post-types.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function register_custom_post_types() {
	$register_post_types = new RegisterCustomThemePostTypes();
}

register_custom_post_types();
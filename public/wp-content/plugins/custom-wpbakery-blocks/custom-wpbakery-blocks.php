<?php
/*
Plugin Name: Custom WPBakery Blocks
Description: Registers custom blocks (shortcodes) for WPBakery Page Builder.
Version: 1.0
Author: ian Hoyte
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'CWB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//require_once __DIR__ . '/core/class-cwb-setup.php';
require_once __DIR__ . '/core/class-cwb-helpers.php';
require_once __DIR__ . '/core/class-cwb-loader.php';

new CWB_Loader( plugin_dir_path( __FILE__ ), plugin_dir_url( __FILE__ ) );

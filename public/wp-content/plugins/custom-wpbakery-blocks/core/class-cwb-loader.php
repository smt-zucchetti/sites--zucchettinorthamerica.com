<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class CWB_Loader {
    protected $base_path;
    protected $base_url;

    public function __construct( $path, $url ) {
        $this->base_path = rtrim( $path, '/' );
        $this->base_url  = rtrim( $url, '/' );

        add_action( 'plugins_loaded', [ $this, 'load_blocks' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_third_party_assets' ] );
    }

    public function register_third_party_assets() {

        $vendor_url = $this->base_url . '/vendor';

        // Tiny Slider
        wp_register_style(
            'tiny-slider',
            $vendor_url . '/tiny-slider/tiny-slider.css',
            [],
            '2.9.4'
        );
        wp_register_script(
            'tiny-slider',
            $vendor_url . '/tiny-slider/tiny-slider.js',
            '2.9.4',
            true
        );

    }

    public function load_blocks() {
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            add_action( 'admin_notices', function () {
                echo '<div class="notice notice-error"><p><strong>Custom WPBakery Blocks</strong> requires WPBakery Page Builder to be installed and activated.</p></div>';
            });
            return;
        }

        // Load base block class first
        $base_class_path = $this->base_path . '/core/class-cwb-block-base.php';
        if ( file_exists( $base_class_path ) ) {
            require_once $base_class_path;
        } else {
            add_action( 'admin_notices', function () {
                echo '<div class="notice notice-error"><p><strong>Custom WPBakery Blocks</strong> base class file is missing.</p></div>';
            });
            return;
        }

        $blocks_dir = get_stylesheet_directory() . '/blocks';

        // Load all blocks' controller.php files and instantiate classes
        foreach ( glob( $blocks_dir . '/*/controller.php' ) as $controller_file ) {

            require_once $controller_file;

            $block_slug = basename( dirname( $controller_file ) );
            $class_name = 'CWB_Block_' . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $block_slug ) ) );

            if ( class_exists( $class_name ) ) {
                new $class_name(
                    get_stylesheet_directory() . '/blocks/' . $block_slug,
                    get_stylesheet_directory()  . '/blocks/' . $block_slug
                );
            }
        }
    }
}

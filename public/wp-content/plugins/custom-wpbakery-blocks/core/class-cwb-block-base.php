<?php
if ( ! defined( 'ABSPATH' ) ) exit;

abstract class CWB_Block_Base {
    protected $path;
    protected $url;

    // Store registered external handles (CSS and JS)
    protected $external_css = [];
    protected $external_js  = [];

    public function __construct( $path, $url ) {
        $this->path = $path;
        $this->url  = $url;

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    /**
     * Register an external CSS handle or URL to enqueue.
     *
     * @param string $handle_or_url
     */
    public function add_external_css( string $handle_or_url ) {
        $this->external_css[] = $handle_or_url;
    }

    /**
     * Register an external JS handle or URL to enqueue.
     *
     * @param string $handle_or_url
     */
    public function add_external_js( string $handle_or_url ) {
        $this->external_js[] = $handle_or_url;
    }

    /**
     * Enqueue block assets and registered external assets.
     */
    public function enqueue_assets() {
        $handle = $this->get_handle();

        $block_url = get_stylesheet_directory_uri() . '/blocks/' . $handle;

        // Enqueue block's CSS if exists
        $css_path = $this->path . '/style.css';
        $css_url  = $block_url  . '/style.css';
        if ( file_exists( $css_path ) ) {
            wp_enqueue_style(
                'cwb-' . $handle . '-style',
                $css_url,
                [],
                filemtime( $css_path )
            );
        }

        // Enqueue block's JS if exists
        $js_path = $this->path . '/script.js';
        $js_url  = $block_url  . '/script.js';
        if ( file_exists( $js_path ) ) {
            wp_enqueue_script(
                'cwb-' . $handle . '-script',
                $js_url,
                [ 'jquery' ],
                filemtime( $js_path ),
                true
            );
        }

        // Enqueue external CSS handles/URLs
        foreach ( $this->external_css as $css ) {
            if ( filter_var( $css, FILTER_VALIDATE_URL ) ) {
                // It's a URL - enqueue as style
                wp_enqueue_style( 'cwb-' . $handle . '-external-' . md5( $css ), $css );
            } else {
                // Otherwise treat as registered handle
                wp_enqueue_style( $css );
            }
        }

        // Enqueue external JS handles/URLs
        foreach ( $this->external_js as $js ) {
            if ( filter_var( $js, FILTER_VALIDATE_URL ) ) {
                wp_enqueue_script( 'cwb-' . $handle . '-external-' . md5( $js ), $js, [], false, true );
            } else {
                wp_enqueue_script( $js );
            }
        }
    }

    /**
     * Generate a unique handle based on the class name.
     *
     * @return string
     */
    protected function get_handle() {
        return strtolower( str_replace( 'CWB_Block_', '', get_class( $this ) ) ); // e.g. alert_box
    }
}

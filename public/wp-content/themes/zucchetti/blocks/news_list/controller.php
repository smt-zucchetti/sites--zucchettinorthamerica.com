<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/model.php';

class CWB_Block_News_List extends CWB_Block_Base {

    public function __construct( $path, $url ) {
        $this->block_name = 'News List';
        $this->shortcode  = 'news_list';

        parent::__construct( $path, $url );

        add_action( 'vc_before_init', [ $this, 'register_block' ] );
        add_shortcode( $this->shortcode, [ $this, 'render_shortcode' ] );
    }

    public function register_block() {
        vc_map([
            'name'     => $this->block_name,
            'base'     => $this->shortcode,
            'category' => 'Content',
            'params'   => [
                [
                    'type'        => 'dropdown',
                    'heading'     => __( 'Order By', 'cwb' ),
                    'param_name'  => 'orderby',
                    'value'       => [
                        'Date'       => 'date',
                        'Title'      => 'title',
                        'Menu Order' => 'menu_order',
                        'Random'     => 'rand',
                    ],
                    'std' => 'date',
                ],
                [
                    'type'        => 'dropdown',
                    'heading'     => __( 'Order', 'cwb' ),
                    'param_name'  => 'order',
                    'value'       => [
                        'Descending' => 'DESC',
                        'Ascending'  => 'ASC',
                    ],
                    'std' => 'DESC',
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => __( 'Posts Per Page', 'cwb' ),
                    'param_name'  => 'posts_per_page',
                    'std'         => '5',
                ],
            ],
        ]);
    }

    public function render_shortcode( $atts ) {
        $atts = shortcode_atts([
            'title'          => '',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'posts_per_page' => 5,
        ], $atts, $this->shortcode );

        // Process via model
        $items = NewsListModel::get_posts( $atts );

        // Pass to view
        ob_start();
        $title = $atts['title'];
        include $this->path . '/view.php';
        return ob_get_clean();
    }
}

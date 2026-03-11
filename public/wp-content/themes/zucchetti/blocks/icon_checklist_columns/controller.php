<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/model.php';

class CWB_Block_Icon_Checklist_Columns extends CWB_Block_Base {

    public function __construct( $path, $url ) {
        $this->block_name = 'Icon Checklist Columns';
        $this->shortcode  = 'icon_checklist_columns';

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
                    'type'        => 'textfield',
                    'heading'     => 'Title',
                    'param_name'  => 'title',
                    'value'       => '',
                    'description' => '',
                ],
                [
                    'type'        => 'param_group',
                    'heading'     => __('Items', 'your-textdomain'),
                    'param_name'  => 'items',
                    'value'       => json_encode([
                        [ 'description' => '' ],
                    ]),
                    'params'      => [
                        [
                            'type'        => 'textarea',
                            'heading'     => __('Description', 'your-textdomain'),
                            'param_name'  => 'description',
                            'admin_label' => true,
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function render_shortcode( $atts ) {
        $atts = shortcode_atts([
            'items' => '',
            'title' => '',
        ], $atts, $this->shortcode );

        $title = $atts['title'];
        
        // Process repeater data via model
        $items = IconChecklistModel::parse_items( $atts['items'] );

        // Pass to view
        ob_start();
        include $this->path . '/view.php';
        return ob_get_clean();
    }
}

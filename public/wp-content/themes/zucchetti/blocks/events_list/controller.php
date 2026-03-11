<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/model.php';

class CWB_Block_Events_list extends CWB_Block_Base {

    public function __construct( $path, $url ) {
        $this->block_name = 'Events List';
        $this->shortcode  = 'events_list';

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
                    'type'       => 'dropdown',
                    'heading'    => __( 'Event Type', 'cwb' ),
                    'param_name' => 'type',
                    'value'      => [
                        'Upcoming' => 'upcoming',
                        'Past'     => 'past',
                    ],
                    'std' => 'upcoming',
                ],
                [
                    'type'       => 'dropdown',
                    'heading'    => __( 'Display Layout', 'cwb' ),
                    'param_name' => 'display',
                    'value'      => [
                        'Grid (3 cols)'   => 'grid',
                        'Stacked Accordion' => 'accordion',
                    ],
                    'std' => 'grid',
                ],
            ],
        ]);
    }

    public function render_shortcode( $atts ) {
        $atts = shortcode_atts([
            'type'    => 'upcoming',
            'display' => 'grid',
        ], $atts, $this->shortcode );

        $items = EventsListModel::get_events( $atts );

        ob_start();
        include $this->path . '/view.php';
        return ob_get_clean();
    }
}

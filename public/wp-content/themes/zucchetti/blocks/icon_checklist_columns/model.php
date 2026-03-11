<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * ImageAndTextPathModel
 * 
 * Handles data parsing and normalization for the Image and Text Path block.
 */
class IconChecklistModel {

    /**
     * Parse and normalize repeater items from VC param_group.
     *
     * @param string $raw_items JSON string from vc_param_group_parse_atts.
     * @return array
     */
    public static function parse_items( $raw_items ) {
        $items = vc_param_group_parse_atts( $raw_items );

        if ( empty( $items ) || ! is_array( $items ) ) {
            return [];
        }

        foreach ( $items as &$item ) {
            $item['description'] = isset( $item['description'] ) ? wp_kses_post( $item['description'] ) : '';
        }
        unset( $item );

        return $items;
    }
}

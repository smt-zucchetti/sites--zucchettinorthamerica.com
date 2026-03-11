<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * NewsListModel
 * 
 * Handles data parsing and normalization for the News List block.
 */
class NewsListModel {

    public static function get_posts( $atts ) {
        $query = new WP_Query([
            'post_type'      => 'zucchetti-news',
            'posts_per_page' => intval( $atts['posts_per_page'] ),
            'orderby'        => sanitize_text_field( $atts['orderby'] ),
            'order'          => sanitize_text_field( $atts['order'] ),
        ]);

        $items = [];

        while ( $query->have_posts() ) {
            $query->the_post();

            $items[] = [
                'id'      => get_the_ID(),
                'title'   => get_the_title(),
                'content' => apply_filters( 'the_content', get_the_content() ),
                'excerpt' => get_the_excerpt(),
                'date'    => get_field( 'date' ) ?: get_the_date(),
                'link'    => get_field( 'link' ) ?: get_permalink(),
                'video'   => get_field( 'video' ),
                'image'   => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
            ];
        }
        wp_reset_postdata();

        return $items;
    }

}

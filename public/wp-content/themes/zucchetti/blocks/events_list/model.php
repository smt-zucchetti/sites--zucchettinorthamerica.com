<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class EventsListModel {

    public static function get_events( $atts ) {
        $today = current_time( 'Ymd' );
        $type  = $atts['type'] ?? 'upcoming';

        $meta_query = [];       

        if ( $type === 'past' ) {
            $order = 'DESC';
            $orderby  = 'meta_value_num';
            $meta_key = 'end_date';
            $meta_query[] = [
                'key' => 'end_date', 
                'value' => $today, 
                'compare' => '<', 
                'type' => 'DATE',
            ];
        } else {
            $order = 'ASC';
            $orderby  = 'meta_value_num';
            $meta_key = 'end_date';
            $meta_query[] = [
                'key' => 'end_date', 
                'value' => $today, 
                'compare' => '>=', 
                'type' => 'DATE',
            ];
        }

        $args = [
            'post_type'      => 'zucchetti-events',
            'posts_per_page' => -1,
            'meta_query'     => $meta_query,
            'meta_key'       => isset($meta_key) ? $meta_key : false,
            'orderby'        => isset($orderby) ? $orderby : false,
            'order'          => isset($order) ? $order : false,
        ];

        $query = new WP_Query($args);

        $events = [];
        while ( $query->have_posts() ) {
            $query->the_post();

            $start_raw = get_field( 'start_date' );
            $end_raw   = get_field( 'end_date' );

            $events[] = [
                'id'          => get_the_ID(),
                'title'       => get_the_title(),
                'content'     => apply_filters( 'the_content', get_the_content() ),
                'start'       => $start_raw,
                'end'         => $end_raw,
                'link'        => get_field( 'link' ),
                'location'    => get_field( 'location' ),
                'image'       => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
            ];
        }
        wp_reset_postdata();

        return $events;
    }

    public static function format_date_range( $start, $end ) {
        
        if ( ! $start ) return '';
        
        $start_dt = DateTime::createFromFormat( 'd/m/Y', $start );
        
        $end_dt   = $end ? DateTime::createFromFormat( 'd/m/Y', $end ) : null;


        if ( ! $start_dt ) return '';

        if ( $end_dt ) {
            // Same month + year → omit month on end
            if ( $start_dt->format('F Y') === $end_dt->format('F Y') ) {
                return sprintf(
                    '%s %s – %s, %s',
                    $start_dt->format('M'),
                    $start_dt->format('j'),
                    $end_dt->format('j'),
                    $start_dt->format('Y')
                );
            } else {
                return sprintf(
                    '%s – %s',
                    $start_dt->format('M j, Y'),
                    $end_dt->format('M j, Y')
                );
            }
        }

        return $start_dt->format('M j, Y');
    }
}


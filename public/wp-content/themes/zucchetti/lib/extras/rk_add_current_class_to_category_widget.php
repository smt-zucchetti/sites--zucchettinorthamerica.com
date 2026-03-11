<?php

add_filter( 'woocommerce_product_categories_widget_args', 'custom_wc_widget_category_args' );
function custom_wc_widget_category_args( $args ) {
    $args['walker'] = new Custom_WC_Product_Cat_Walker();
    return $args;
}

class Custom_WC_Product_Cat_Walker extends Walker_Category {
    function start_el( &$output, $category, $depth = 0, $args = [], $id = 0 ) {
        $current_cat_id = 0;

        if ( is_tax( 'product_cat' ) ) {
            $current_term = get_queried_object();
            if ( isset( $current_term->term_id ) ) {
                $current_cat_id = (int) $current_term->term_id;
            }
        }

        $classes = [ 'cat-item', 'cat-item-' . $category->term_id ];
        if ( $category->term_id === $current_cat_id ) {
            $classes[] = 'current-cat';
        }
        if ( $category->term_id === get_ancestors( $current_cat_id, 'product_cat' )[0] ?? 0 ) {
            $classes[] = 'current-cat-parent';
        }

        $output .= '<li class="' . implode( ' ', $classes ) . '">';
        $output .= '<a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';

        if ( $args['show_count'] ) {
            $output .= ' <span class="count">(' . $category->count . ')</span>';
        }
    }

    function end_el( &$output, $category, $depth = 0, $args = [] ) {
        $output .= "</li>\n";
    }
}

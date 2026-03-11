<?php
/**
 * Render custom numeric pagination from wp_query
 * @param  array $custom_query A wordpress wp_query result.
 *
 * @example echo numericPagination($wp_query);
 */
function numericPagination( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));
        
        $html = '<div class="numeric-pagination">';
        $html .= paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => '<i class="rk-icon-left-chevron"></i><span class="text">Previous</span>',
            'next_text' => '<span class="text">Next</span><i class="rk-icon-right-chevron"></i>'
        ));
        $html .= '</div>';
    }

    return $html;
}
?>
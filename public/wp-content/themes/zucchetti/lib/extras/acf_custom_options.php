<?php
/**
 * Create the ACF option and sub option pages
 */ 
function acf_init_option_pages() {

    $main_menu_item = __('Site Options');

    $sub_pages = array(
        'Global',
        'Header',
        'Footer',
        'Other',
    );

    if ( function_exists('acf_add_options_sub_page') ) {

        $parent_slug = 'acf-options-' . sanitize_title($main_menu_item);

        $parent = acf_add_options_page(array(
            'page_title'  => $main_menu_item,
            'menu_title'  => $main_menu_item,
            'redirect'    => true,
            'menu_slug'   => $parent_slug
        ));

        foreach ($sub_pages as $sub_page) {
            acf_add_options_sub_page(array(
                'page_title'  => $sub_page,
                'menu_title'  => $sub_page,
                'parent_slug' => $parent_slug,
            ));
        }
        
    }
}
add_action('acf/init', 'acf_init_option_pages');
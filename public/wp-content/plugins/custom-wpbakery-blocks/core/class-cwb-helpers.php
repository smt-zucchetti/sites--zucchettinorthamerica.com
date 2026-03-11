<?php

class CWB_Helpers {
    
    public static function get_wc_categories_for_vc() {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ]);

        $options = [];
        foreach ( $categories as $cat ) {
            $options[ $cat->name ] = $cat->term_id;
        }

        return $options;
    }

}

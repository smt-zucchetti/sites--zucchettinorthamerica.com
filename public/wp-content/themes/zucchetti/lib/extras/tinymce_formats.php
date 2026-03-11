<?php
/**
 * Add formats to TINYMCE Editor
 */
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
    $style_formats = array(  

        [ 'title' => 'Headings', 'type' => 'group',
            'items' => [
                [ 'title' => 'No Bottom Margin', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'g--mb-0', 'exact' => '1' ],
                [ 'title' => 'Bigger Line Height', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'lh-big', 'exact' => '1' ],
                [ 'title' => 'Font Weight 400', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'fw-400', 'exact' => '1' ],
                [ 'title' => 'Font Weight 500', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'fw-500', 'exact' => '1' ],
                [ 'title' => 'Font Weight 600', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'fw-600', 'exact' => '1' ],
                [ 'title' => 'Font Weight 700', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'fw-700', 'exact' => '1' ],
                [ 'title' => 'Font Weight 800', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'fw-800', 'exact' => '1' ],
            ]
        ],
        [ 'title' => 'Heading Size', 'type' => 'group',
            'items' => [
                [ 'title' => 'H1', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'h1', 'exact' => '1' ],
                [ 'title' => 'H2', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'h2', 'exact' => '1' ],
                [ 'title' => 'H3', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'h3', 'exact' => '1' ],
                [ 'title' => 'H4', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'h4', 'exact' => '1' ],
                [ 'title' => 'H5', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'h5', 'exact' => '1' ],
                [ 'title' => 'H6', 'selector' => 'span,h1,h2,h3,h4,h5,h6', 'classes' => 'h6', 'exact' => '1' ],
            ]
        ],
        [ 'title' => 'Paragraphs', 'type' => 'group',
            'items' => [
                [ 'title' => 'Bigger Line Height', 'selector' => 'span,p', 'classes' => 'lh-big', 'exact' => '1' ],
                [ 'title' => 'Font Weight 300', 'selector' => 'span, p', 'classes' => 'fw-300', 'exact' => '1' ],
                [ 'title' => 'Font Weight 400', 'selector' => 'span, p', 'classes' => 'fw-400', 'exact' => '1' ],
                [ 'title' => 'Font Weight 600', 'selector' => 'span, p', 'classes' => 'fw-600', 'exact' => '1' ],
                [ 'title' => 'Font Weight 700', 'selector' => 'span, p', 'classes' => 'fw-700', 'exact' => '1' ],
                [ 'title' => 'Font Weight 800', 'selector' => 'span, p', 'classes' => 'fw-800', 'exact' => '1' ],
            ]
        ], 
        [ 'title' => 'Paragraph Size', 'type' => 'group',
            'items' => [
                [ 'title' => 'H1', 'selector' => 'span,p', 'classes' => 'h1', 'exact' => '1' ],
                [ 'title' => 'H2', 'selector' => 'span,p', 'classes' => 'h2', 'exact' => '1' ],
                [ 'title' => 'H3', 'selector' => 'span,p', 'classes' => 'h3', 'exact' => '1' ],
                [ 'title' => 'H4', 'selector' => 'span,p', 'classes' => 'h4', 'exact' => '1' ],
                [ 'title' => 'H5', 'selector' => 'span,p', 'classes' => 'h5', 'exact' => '1' ],
                [ 'title' => 'H6', 'selector' => 'span,p', 'classes' => 'h6', 'exact' => '1' ],
                [ 'title' => 'Small', 'selector' => 'span,p', 'classes' => 'small', 'exact' => '1' ],
                [ 'title' => 'Smaller', 'selector' => 'span,p', 'classes' => 'smaller', 'exact' => '1' ],
                [ 'title' => 'Large', 'selector' => 'span,p', 'classes' => 'large', 'exact' => '1' ],
                [ 'title' => 'Larger', 'selector' => 'span,p', 'classes' => 'larger', 'exact' => '1' ],
            ]
        ],
        [ 'title' => 'Lists', 'type' => 'group',
            'items' => [
                [ 'title' => 'Stylized Un-Ordered List', 'selector' => 'ul', 'classes' => 'stylized-unordered-list', 'exact' => '1' ],
                [ 'title' => 'Stylized Un-Ordered List Alt', 'selector' => 'ul', 'classes' => 'stylized-unordered-list-alt', 'exact' => '1' ],
            ]
        ],
        [ 'title' => 'Columns', 'type' => 'group',
            'items' => [
                [ 'title' => 'Desktop 2 Columns', 'selector' => 'ul,div,span,ol', 'classes' => 'columns-2-md', 'exact' => '1' ],
            ]
        ],
        [ 'title' => 'Buttons', 'type' => 'group',
            'items' => [
                [ 'title' => 'Green Arrow Link', 'selector' => 'a,button,span', 'classes' => 'green-arrow-link', 'exact' => '1' ],
                [ 'title' => 'White Arrow Link', 'selector' => 'a,button,span', 'classes' => 'white-arrow-link', 'exact' => '1' ],
            ]
        ],
        [ 'title' => 'Text Styles', 'type' => 'group',
            'items' => [
                [ 'title' => 'Gradient Text', 'selector' => 'p,span,h1,h2,h3,h4,h5,h6', 'classes' => 'gradient-text', 'exact' => '1' ],
                [ 'title' => 'Pre Title', 'selector' => 'p,span', 'classes' => 'zucchetti-banner-pre-title', 'exact' => '1' ],
            ]
        ],

        // [ 'title' => 'Font Weight', 'type' => 'group',
        //     'items' => [
        //         [ 'title' => 'Link', 'selector' => 'a, button', 'classes' => 'uk-button-link', 'exact' => '1' ],
        //         [ 'title' => 'Button', 'selector' => 'a, button', 'classes' => 'uk-button uk-button-primary', 'exact' => '1' ],
        //         [ 'title' => 'Large Button', 'selector' => 'a, button', 'classes' => 'uk-button-large', 'exact' => '1' ],
        //     ]
        // ], // Buttons

        // [ 'title' => 'Quote', 'type' => 'group',
        //     'items' => [
        //         [ 'title' => 'Quote Justify', 'selector' => 'blockquote', 'classes' => 'align-justify', 'exact' => '1' ],
        //         [ 'title' => 'Quote Right', 'selector' => 'blockquote', 'classes' => 'align-right', 'exact' => '1' ],
        //         [ 'title' => 'Quote Center', 'selector' => 'blockquote', 'classes' => 'align-center', 'exact' => '1' ],
        //     ]
        // ], // Buttons
        
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
     
    return $init_array;  
   
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
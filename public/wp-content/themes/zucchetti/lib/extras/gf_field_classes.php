<?php
/**
 * Add descriptive field type classes to individual field elements
 */
add_filter( 'gform_field_css_class', 'custom_class', 10, 3 );

function custom_class( $classes, $field, $form ) {
    if ( $field->type == 'select' ) {
        $classes .= ' gf_select_field';
    } else if ( $field->type == 'text' ) {
        $classes .= ' gf_text_field';
    } else if ( $field->type == 'email' ) {
        $classes .= ' gf_email_field';
    } else if ( $field->type == 'textarea' ) {
        $classes .= ' gf_textarea_field';
    } else if ( $field->type == 'radio' ) {
    	$classes .= ' gf_radio_field';
    } else if ( $field->type == 'checkbox' ) {
    	$classes .= ' gf_checkbox_field';
    } else if ( $field->type == 'consent' ) {
        $classes .= ' gf_consent_field';
    }

    return $classes;
}

/**
 * Reformat radio, checkbox and consent fields to support a custom
 * structure--useful for stylizing these fields.
 */

add_filter( 'gform_field_content', function( $field_content, $field ) {

    if ( $field->type == 'radio' || $field->type == 'checkbox' || $field->type == 'consent') {

        $newContent = str_replace( '<label', '<div class="checkmark"></div><div ', $field_content );
        $newContent = str_replace( '<input', '<label><input', $newContent );
        $newContent = str_replace( '/label>', '/div></label>', $newContent );

        return $newContent;
    }
    return $field_content;
}, 10, 2 );
<?php

function rk_get_initials_from_string( $string ) {
    // Trim and remove excess whitespace
    $string = trim( preg_replace( '/\s+/', ' ', $string ) );

    // Split into words
    $words = explode( ' ', $string );

    if ( count( $words ) === 0 ) {
        return '';
    }

    $first = substr( $words[0], 0, 1 );
    $last  = substr( end( $words ), 0, 1 );

    return $first . $last;
}
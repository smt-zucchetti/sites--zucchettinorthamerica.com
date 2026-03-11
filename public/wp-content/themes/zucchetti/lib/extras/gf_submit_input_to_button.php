<?php
// filter the Gravity Forms button type
// add_filter( 'gform_submit_button', 'form_submit_button', 10, 5 );

// function form_submit_button ( $button, $form ){
//     $button = str_replace( "input", 'button role="button" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff" title="' . $form['button']['text'] . '"', $button );
//     $button = str_replace( "/", "", $button );
//     $button = str_replace('gform_button button', 'nectar-button jumbo regular accent-color has-icon regular-button', $button);
//     $button .= '<span>' . $form['button']['text']. ' </span><i class="fa fa-envelope-open-o"></i></button>';
//     return $button;
// }

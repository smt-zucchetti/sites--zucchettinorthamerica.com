<?php
/**
 * Custom colors for the tinymce text color picker
 */
function ih_tinymce_colors($init) {
  $default_colours = '"000000", "Black"';	

  $custom_colours =  '"76B82A", "Green ",
                      "026AB4", "Blue",
                      "138CE3", "Light Blue"';

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 6;

  return $init;
}
add_filter('tiny_mce_before_init', 'ih_tinymce_colors');
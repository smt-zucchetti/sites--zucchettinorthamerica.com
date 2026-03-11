<?php
/**
 * A shortcode that returns the server time's Year value
 * @return str $year the server's reported year value
 */
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');
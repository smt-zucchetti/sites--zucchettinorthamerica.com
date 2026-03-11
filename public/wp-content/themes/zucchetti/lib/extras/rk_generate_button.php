<?php
/**
 * Generates a Salient specific button
 * 
 * @package IHTheme
 * @since  1.0.0
 * @author  Ian Hoyte for IH
 *
 * @param  array $button       button element data
 * @param  str   $color  	   the button color
 * @param  str 	 $fade_classes optional WPBakeryy specific fade classes
 * @param  str   $fade_delay   optional fade delay
 * @param  str   $size         a button size, accepts small, medium, large, jumbo, extra_jumbo
 * 
 * @return str   $renderedButton a formatted button element
 */
function generateButton($button, $color = false, $fade_classes = null, $fade_delay = null, $size = false) {

	if ( !$color ) {
		$color = 'extra-color-2';
	}
	if ($fade_delay) {
		$fade_delay = 'data-delay="' . $fade_in_delay . '"';
	}

	if (!$size) {
		$size = 'jumbo';
	}

	$title  = $button['title'];
	$target = $button['target'];
	$url 	= $button['url'];

	$renderedButton = '<a target="' . $target . '" class="nectar-button ' . $size  .' ' . $color . ' ' . $fade_classes . '" ' . $fade_delay . ' href="' . $url . '" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff"><span>' . $title . '</span></a>';

	return $renderedButton;
}
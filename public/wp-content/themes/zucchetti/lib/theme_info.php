<?php

/**
 * Returns theme specific info
 * @return  array $ih_theme theme spefici data
 */
function ih_theme() {

	// theme name
	$name 		= 'zucchetti';
	$liveDomain = 'domain';
	$liveTLD 	= 'tld';

	// Set theme data based on environment
	if (preg_match('|' . $liveDomain . '\.' . $liveTLD . '$|', $_SERVER['SERVER_NAME']) > 0) {
	    $production = true;
	    $version = '1.0.0';
	} else {
		$production = false;
		$version = time();
	}

	// ih specific theme options
	$ih_theme = array(
		'name' 		 => $name,
		'version' 	 => $version,
		'production' => $production
	);

	return $ih_theme;

}
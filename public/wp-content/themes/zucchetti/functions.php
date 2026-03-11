<?php
/**
 * Theme functions
 */
die('asdf');
$ih_includes = [
	'lib/RokettoProductCallouts.php',
	'lib/theme_info.php',
	'lib/setup.php',
	'lib/assets.php',
	'lib/extras.php',
];

foreach ($ih_includes as $file) {

	if ( !$filepath = locate_template($file) ) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}

	require_once $filepath;

}

unset($file, $filepath);
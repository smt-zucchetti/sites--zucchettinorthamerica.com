<?php
/**
 * Inject the fonts into the head
 * 
 * override salient's default font loading:
 * Default Theme Font Functionality:
 * /wp-admin/admin.php?page=THEME&tab=1
 * 
 */
function inject_fonts() {

	$type_kit_id = false;
	
	$google_fonts = false;

	if ($type_kit_id) {
		echo '<link rel="stylesheet" href="//use.typekit.net/' . $type_kit_id . '.css">' . "\n";
	}

	if ($google_fonts) {
		echo '<link href="//fonts.googleapis.com/css?family=' . $google_fonts . '&display=swap" rel="stylesheet" type="text/css" />'."\n";
	}

}

//add_action( 'wp_head', 'inject_fonts' , 1);
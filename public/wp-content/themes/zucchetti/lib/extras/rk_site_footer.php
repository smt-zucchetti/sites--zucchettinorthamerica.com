<?php
/**
 * Display a Footer template built in templatera.
 * Make sure you remove the footer from the Salient 
 * settings, as well as the copyright section.
 *
 * This hook requires salient version 13+
 * 
 */
function site_templatera_footer() {

	// make sure we have templatera installed/active
	if (in_array( 'templatera/templatera.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

		// Get a user defined site option (requires ACF)
		if ( class_exists('ACF') ) {
			$templatera_site_footer_id = get_field('templatera_site_footer_id','option');

			// check if the value is set
			if ($templatera_site_footer_id) {
				echo '<div class="container" id="rk-site-footer">';
		    	echo do_shortcode('[templatera id="' . $templatera_site_footer_id . '"]');
		    	echo '</div>';
		    }
		}
	}
}
add_action( 'nectar_hook_before_container_wrap_close', 'site_templatera_footer' );
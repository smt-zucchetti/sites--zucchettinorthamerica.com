<?php
/**
 * init_acf_googlemap
 *
 * Uses the salient google map field to update the ACF google map setting
 */
function init_acf_googlemap() {
	$nectar_options = get_nectar_theme_options();
	$apiKey = $nectar_options['google-maps-api-key'];
  	acf_update_setting('google_api_key', $apiKey);
}

add_action('acf/init', 'init_acf_googlemap');
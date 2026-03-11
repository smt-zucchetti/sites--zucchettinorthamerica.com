<?php
/**
 * Registers custom theme post type Taxonomies
 * @since  1.0.0
 */

class defineCustomPostTypeTaxonomies {

	/**
	 * Defined Taxonomies
	 * @since 1.0.0
	 */
	public static function registerCustomPostTypeTaxonomies() {

		$taxonomies = array(

			/**
			 * Press Releases
			 */
			array(
			 	'handle'    => 'zucchetti-press_category',
			 	'post_type' => 'zucchetti-press',
			 	'singular'	=> 'Category',
			 	'plural'	=> 'Categories',
			 	'options'	=> array(
					'public' => false,
				)
			),
		
		);

		return $taxonomies;
	}

}
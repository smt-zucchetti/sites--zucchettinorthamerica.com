<?php
/**
 * Registers custom theme Post Types
 * @since  1.0.0
 */

class definePostTypes {

	/**
	 * Defined Post Types
	 * @since 1.0.0
	 * @link https://developer.wordpress.org/resource/dashicons/
	 * @link https://salferrarello.com/cpt-best-practices/ // some usefuel CPT tips here
	 */
	public static function postTypes() {

		$post_types = array(


			array(
			 	'handle'    => 'zucchetti-news',
			 	'singular'  => 'News',
			 	'plural'	=> 'News',
			 	'options'	=> array(
					'menu_icon' => 'dashicons-calendar-alt',
					'public'    => true,
					'hierarchical' => false,
					'has_archive' => false,
					'rewrite' => array(
						'slug' => 'news',
						'with_front' => false,
					),
				),
			 	'position' => 20,
			),

			array(
			 	'handle'    => 'zucchetti-events',
			 	'singular'  => 'Event',
			 	'plural'	=> 'Events',
			 	'options'	=> array(
					'menu_icon' => 'dashicons-tickets-alt',
					'public'    => true,
					'hierarchical' => false,
					'has_archive' => false,
					'rewrite' => array(
						'slug' => 'news',
						'with_front' => false,
					),
				),
			 	'position' => 20,
			),

			array(
			 	'handle'    => 'zucchetti-press',
			 	'singular'  => 'Press Release',
			 	'plural'	=> 'Press Releases',
			 	'options'	=> array(
					'menu_icon' => 'dashicons-megaphone',
					'public'    => true,
					'hierarchical' => false,
					'has_archive' => false,
					'rewrite' => array(
						'slug' => 'press-releases',
						'with_front' => false,
					),
				),
			 	'position' => 20,
			),


		);

		return $post_types;
	}

}
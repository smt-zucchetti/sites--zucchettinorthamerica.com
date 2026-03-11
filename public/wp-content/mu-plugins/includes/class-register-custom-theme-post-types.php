<?php
/**
 * Registers custom theme post types
 * @since 	1.0.0
 */

class RegisterCustomThemePostTypes {
	
	/**
	 * Init post type registration
	 * @since    1.0.0
	 */
	function __construct() {
		$this->loadDefinedRegistration();
		add_action( 'init', array('RegisterCustomThemePostTypes','RegisterPostTypesAndTaxonomies' ) );
	}

	/**
	 * Load Defined Post Types and Taxonomies
	 * @since    1.0.0
	 */
	private static function loadDefinedRegistration() {	
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-defined-post-types.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-define-taxonomies.php';
	}

	/**
	 * Register a Custom Post Type
	 * @since    1.0.0
	 */

	public static function registerCustomPostType( $handle, $singular, $plural, $args = array(), $position ) {

		$defaults = array(
			'label'         => $singular,
			'description'   => '',
			'public'        => true,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'show_in_rest' => true,
			'map_meta_cap'  => true,
			'menu_icon'     => 'dashicons-admin-page',
			'menu_position' => $position,
			'hierarchical'  => true,
			'rewrite'       => array( 'slug' => $handle, 'with_front' => false ),
			'query_var'     => true,
			'has_archive'   => false,
			'supports'      => array( 'title', 'editor', 'revisions','thumbnail', 'page-attributes' ),
			'labels'        => array(
				'name'               => $plural,
				'singular_name'      => $singular,
				'menu_name'          => $plural,
				'add_new'            => 'Add ' . $singular,
				'add_new_item'       => 'Add New ' . $singular,
				'edit'               => 'Edit',
				'edit_item'          => 'Edit ' . $singular,
				'new_item'           => 'New ' . $singular,
				'view'               => 'View ' . $plural,
				'view_item'          => 'View ' . $singular,
				'search_items'       => 'Search ' . $plural,
				'not_found'          => 'No ' . $plural . ' Found',
				'not_found_in_trash' => 'No ' . $plural . ' found in Trash',
				'parent'             => 'Parent',
			)
		);

		$r = wp_parse_args($args, $defaults);
		register_post_type( $handle, $r );
	}

	/**
	 * Register a Taxonomy
	 * @since   1.0.0
	 */
	public static function registerTaxonomy( $handle, $post_type, $singular, $plural, $args = array() ) {

		$defaults = array(
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => $handle ),
			'labels'            => array(
				'name'               => $plural,
				'singular_name'      => $singular,
				'menu_name'          => $plural,
				'add_new'            => 'Add ' . $singular,
				'add_new_item'       => 'Add New ' . $singular,
				'edit'               => 'Edit',
				'edit_item'          => 'Edit ' . $singular,
				'new_item'           => 'New ' . $singular,
				'view'               => 'View ' . $plural,
				'view_item'          => 'View ' . $singular,
				'search_items'       => 'Search ' . $plural,
				'not_found'          => 'No ' . $plural . ' Found',
				'not_found_in_trash' => 'No ' . $plural . ' found in Trash',
				'parent'             => 'Parent',
			)
		);

		$r = wp_parse_args( $args, $defaults );
		register_taxonomy( $handle, $post_type, $r );
	
	}

	/**
	 * Register the post types and taxonomies
	 * @since    1.0.0
	 */
	public static function RegisterPostTypesAndTaxonomies() {

		$post_types = definePostTypes::postTypes();
		$taxonomies = defineCustomPostTypeTaxonomies::registerCustomPostTypeTaxonomies();

		foreach ($post_types as $type) {
			self::registerCustomPostType( $type['handle'], $type['singular'], $type['plural'], $type['options'], $type['position'] );
		}

		foreach ($taxonomies as $taxonomy) {
			self::registerTaxonomy($taxonomy['handle'], $taxonomy['post_type'], $taxonomy['singular'], $taxonomy['plural'], $taxonomy['options'] );
		}
	}

}
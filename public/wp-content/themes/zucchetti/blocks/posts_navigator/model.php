<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class PostsNavigatorModel {
    protected array $atts;
    protected WP_Query $query;
    protected string $taxonomy;

    public function __construct(array $atts) {
        $this->atts = $atts;
        $this->determine_taxonomy();
        $this->build_query();
    }

    /**
     * Determines the primary taxonomy for the selected post type.
     */
    protected function determine_taxonomy() {
        $post_type = !empty($this->atts['post_type']) ? sanitize_text_field($this->atts['post_type']) : 'post';

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        // If post type = "post", prefer category
        if ($post_type === 'post' && isset($taxonomies['category'])) {
            $this->taxonomy = 'category';
            return;
        }

        // Otherwise, pick the first available taxonomy that isn't post_tag
        foreach ($taxonomies as $tax) {
            if ($tax->name === 'post_tag') continue;
            $this->taxonomy = $tax->name;
            return;
        }

        // Fallback: if no taxonomy found, set empty
        $this->taxonomy = '';
    }

    /**
     * Builds the WP_Query based on attributes and current archive state.
     */
    protected function build_query() {
        $paged = !empty($this->atts['paged']) ? intval($this->atts['paged']) : 1;
        $post_type = !empty($this->atts['post_type']) ? sanitize_text_field($this->atts['post_type']) : 'post';

        $args = [
            'post_type'      => $post_type,
            'posts_per_page' => !empty($this->atts['posts_per_page']) ? intval($this->atts['posts_per_page']) : 12,
            'orderby'        => !empty($this->atts['orderby']) ? $this->atts['orderby'] : 'date',
            'order'          => !empty($this->atts['order']) ? $this->atts['order'] : 'DESC',
            'paged'          => $paged,
            'post_status'    => 'publish',
        ];

        $terms = [];

        // Use terms from shortcode/atts if provided
        if (!empty($this->atts['categories'])) {
            $terms = explode(',', $this->atts['categories']);
        }

        // Override with current term if on taxonomy archive
        $queried = get_queried_object();
        if ($queried && $queried instanceof WP_Term && $queried->taxonomy === $this->taxonomy) {
            $terms = [$queried->slug];
        }

        if (!empty($terms)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => $this->taxonomy,
                    'field'    => 'slug',
                    'terms'    => $terms,
                ],
            ];
        }

        $this->query = new WP_Query($args);
    }

    /**
     * Returns the WP_Query object.
     */
    public function get_posts(): WP_Query {
        return $this->query;
    }

    /**
     * Returns the determined taxonomy.
     */
    public function get_taxonomy(): string {
        return $this->taxonomy;
    }
}

<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/model.php';

class CWB_Block_Posts_Navigator extends CWB_Block_Base {
    protected PostsNavigatorModel $model;

    public function __construct($path, $url) {
        $this->block_name = 'Posts Navigator'; // renamed
        $this->shortcode  = 'posts_navigator';

        parent::__construct($path, $url);

        add_action('wp_ajax_cwb_blog_loadmore', [$this, 'ajax_load_more']);
        add_action('wp_ajax_nopriv_cwb_blog_loadmore', [$this, 'ajax_load_more']);

        add_action('vc_before_init', [$this, 'register_block']);
        add_shortcode($this->shortcode, [$this, 'render_shortcode']);
    }

    public function ajax_load_more() {
        $atts = isset($_POST['atts']) ? (array) json_decode(stripslashes($_POST['atts']), true) : [];
        $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $term = isset($_POST['term']) ? sanitize_text_field($_POST['term']) : '';

        $atts['paged'] = $paged;

        // Initialize model with atts
        $this->model = new PostsNavigatorModel($atts);

        // Override term filter if provided
        if (!empty($term)) {
            $taxonomy = $this->model->get_taxonomy();
            $atts['categories'] = $term; // use same key for compatibility with model
        }

        ob_start();
        $query = $this->model->get_posts();
        if ($query->have_posts()) {
            while ($query->have_posts()): $query->the_post();
                include $this->path . '/view-loop-item.php';
            endwhile;
        } else {
            echo '<div class="warning">' . esc_html__('No posts found.', 'text-domain') . '</div>';
        }
        wp_reset_postdata();
        $html = ob_get_clean();

        wp_send_json_success([
            'html'      => $html,
            'max_pages' => $query->max_num_pages,
        ]);
    }


    public function register_block() {
        // Get all public post types
        $post_types = get_post_types(['public' => true], 'objects');
        $post_type_options = [];
        foreach ( $post_types as $pt ) {
            $post_type_options[$pt->labels->singular_name] = $pt->name;
        }

        vc_map([
            'name'     => $this->block_name,
            'base'     => $this->shortcode,
            'category' => 'Content',
            'params'   => [
                [
                    'type'        => 'dropdown',
                    'heading'     => 'Post Type',
                    'param_name'  => 'post_type',
                    'value'       => $post_type_options,
                    'std'         => 'post',
                    'description' => 'Select the post type to display',
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => 'Posts Per Page',
                    'param_name'  => 'posts_per_page',
                    'value'       => '',
                    'std'         => '12',
                ],
                [
                    'type'        => 'dropdown',
                    'heading'     => 'Order By',
                    'param_name'  => 'orderby',
                    'value'       => [
                        'Date'       => 'date',
                        'Title'      => 'title',
                        'Menu Order' => 'menu_order',
                        'Random'     => 'rand',
                    ],
                    'std'         => 'date',
                ],
                [
                    'type'        => 'dropdown',
                    'heading'     => 'Order',
                    'param_name'  => 'order',
                    'value'       => [
                        'Descending' => 'DESC',
                        'Ascending'  => 'ASC',
                    ],
                    'std'         => 'DESC',
                ],
            ],
        ]);
    }

    public function render_shortcode($atts) {
        $atts = shortcode_atts([
            'post_type'       => '',
            'orderby'         => '',
            'order'           => '',
            'posts_per_page'  => '',
        ], $atts, $this->shortcode);

        $this->model = new PostsNavigatorModel($atts);

        ob_start();
        include $this->path . '/view.php';
        return ob_get_clean();
    }
}

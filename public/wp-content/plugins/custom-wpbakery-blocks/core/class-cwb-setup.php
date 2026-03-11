<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class CWB_Block_Setup {

    function __construct() {
        add_action( 'init', array($this, 'register_post_types'), 5 );
        add_action( 'init', array($this, 'register_taxonomies'), 10 );
        add_action( 'admin_menu', array($this, 'register_sub_menu'), 10 );

        add_action( 'add_meta_boxes', array($this, 'register_meta_boxes') );
        add_action( 'save_post', array($this, 'save_meta_box_data') );

        add_action( 'admin_enqueue_scripts', array($this, 'admin_scripts') );
        add_action( 'save_post_cwb-blocks', array($this, 'handle_admin_save') );
    }

    public function handle_admin_save( $post_id ) {
        if ( ! isset($_POST['cwb_blocks_nonce']) || ! wp_verify_nonce($_POST['cwb_blocks_nonce'], 'cwb_save_blocks') ) {
            return;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

        if ( isset($_POST['cwb_blocks']) && is_array($_POST['cwb_blocks']) ) {
            $cleaned = $this->sanitize_fields_recursive($_POST['cwb_blocks']);
            update_post_meta($post_id, '_cwb_blocks', $cleaned);
        } else {
            delete_post_meta($post_id, '_cwb_blocks');
        }
    }

    public function admin_scripts( $hook ) {
        if ( $hook !== 'post-new.php' && $hook !== 'post.php' ) return;
        global $post;
        if ( $post->post_type !== 'cwb-blocks' ) return;

        wp_enqueue_script( 'cwb-blocks-js', CWB_PLUGIN_URL . '/assets/cwb-blocks.js', ['jquery', 'jquery-ui-sortable'], '1.0', true );
    }

    public function register_post_types() {
        register_post_type('cwb-blocks', array(
            'menu_position' => 100,
            'menu_icon' => 'dashicons-welcome-widgets-menus',
            'labels' => array(
                'name' => __( 'WPB Blocks', 'cwb' ),
                'singular_name' => __( 'WPB Block', 'cwb' ),
                'add_new' => __( 'Add New' , 'cwb' ),
                'add_new_item' => __( 'Add New WPB Block' , 'cwb' ),
                'edit_item' => __( 'Edit WPB Block' , 'cwb' ),
                'new_item' => __( 'New WPB Block' , 'cwb' ),
                'view_item' => __( 'View WPB Block', 'cwb' ),
                'search_items' => __( 'Search WPB Blocks', 'cwb' ),
                'not_found' => __( 'No WPB Blocks found', 'cwb' ),
                'not_found_in_trash' => __( 'No WPB Blocks found in Trash', 'cwb' ),
            ),
            'public' => false,
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            '_builtin' => false,
            'capability_type' => 'post',
            'supports' => array('title'),
            'rewrite' => false,
            'query_var' => true,
        ));
    }

    public function register_taxonomies() {
        register_taxonomy(
            'cwb-block-category',
            'cwb-blocks',
            array(
                'label' => __( 'Block Categories' ),
                'rewrite' => false,
                'hierarchical' => true,
                'show_in_quick_edit' => false,
                'meta_box_cb' => false,
                'public' => true,
                'publicly_queryable' => true
            )
        );
    }

    public function register_sub_menu() {
        $this->vc_page_main_slug = vc_user_access()->wpAny('manage_options')->part('settings')->can('vc-general-tab')->get() ? 'vc-general' : 'vc-welcome';

        add_submenu_page( $this->vc_page_main_slug, 'Blocks', 'Blocks', 'edit_posts', 'edit.php?post_type=cwb-blocks' );
        add_submenu_page( $this->vc_page_main_slug, 'Block Categories', 'Block Categories', 'edit_posts', 'edit-tags.php?post_type=cwb-blocks&taxonomy=cwb-block-category' );
    }

    public function register_meta_boxes() {
        add_meta_box(
            'cwb_block_fields',
            __('Block Fields', 'cwb'),
            array($this, 'render_block_fields_meta_box'),
            'cwb-blocks',
            'normal',
            'high'
        );
    }

    public function render_block_fields_meta_box($post) {
        $fields = get_post_meta($post->ID, '_cwb_blocks', true);
        wp_nonce_field('cwb_save_blocks', 'cwb_blocks_nonce');

        echo '<div id="cwb-blocks-container">';
        echo '<ul class="cwb-blocks-sortable">';

        if (!empty($fields) && is_array($fields)) {
            foreach ($fields as $i => $field) {
                $this->render_field_row($field, $i);
            }
        }

        echo '</ul>';
        echo '</div>';
        echo '<button type="button" class="button cwb-add-row">+ Add Row</button>';

        echo '<template id="cwb-block-template">';
        $this->render_field_row_template();
        echo '</template>';
    }

    private function render_field_row_template() {
        ?>
        <li class="cwb-block-row" data-index="__DATA_INDEX__">
            <div>
                <input name="cwb_blocks[__NAME_PREFIX__][label]" placeholder="Label" value="">
                <input name="cwb_blocks[__NAME_PREFIX__][handle]" placeholder="Handle" value="">
                <select name="cwb_blocks[__NAME_PREFIX__][type]" onchange="CWB.toggleFieldOptions($(this).closest('li'), this.value)">
                    <option value="text">Text</option>
                    <option value="textarea">Textarea</option>
                    <option value="link">Link</option>
                    <option value="image">Image</option>
                    <option value="select">Select</option>
                    <option value="repeater">Repeater</option>
                </select>
                <textarea name="cwb_blocks[__NAME_PREFIX__][options]" placeholder="Options (key : value)" style="display:none;"></textarea>
                <button type="button" class="button cwb-remove-row">Remove</button>
            </div>
            <div class="cwb-repeater-wrapper" style="display:none;">
                <ul class="cwb-repeater-fields"></ul>
                <button type="button" class="button cwb-add-subrow" data-parent-name="__DATA_INDEX__">+ Add Sub Field</button>
            </div>
        </li>
        <?php
    }

    public function render_field_row($field = [], $index = 0, $is_subfield = false) {
        if ($is_subfield) {
            $parts = explode('_', (string)$index);
            $name_prefix = array_shift($parts);
            foreach ($parts as $part) {
                $name_prefix .= "][subfields][{$part}";
            }
        } else {
            $name_prefix = (string)$index;
        }

        $label = esc_attr($field['label'] ?? '');
        $handle = esc_attr($field['handle'] ?? '');
        $type = esc_attr($field['type'] ?? '');
        $options = esc_textarea($field['options'] ?? '');
        $repeater_display = $type === 'repeater' ? 'block' : 'none';

        ?>
        <li class="cwb-block-row" data-index="<?php echo esc_attr($index); ?>">
            <div>
                <input name="cwb_blocks[<?php echo $name_prefix; ?>][label]" placeholder="Label" value="<?php echo $label; ?>">
                <input name="cwb_blocks[<?php echo $name_prefix; ?>][handle]" placeholder="Handle" value="<?php echo $handle; ?>">
                <select name="cwb_blocks[<?php echo $name_prefix; ?>][type]" onchange="CWB.toggleFieldOptions($(this).closest('li'), this.value)">
                    <?php
                    foreach (['text', 'textarea', 'link', 'image', 'select', 'repeater'] as $opt) {
                        echo '<option value="' . $opt . '"' . selected($type, $opt, false) . '>' . ucfirst($opt) . '</option>';
                    }
                    ?>
                </select>
                <textarea name="cwb_blocks[<?php echo $name_prefix; ?>][options]" placeholder="Options (key : value)" style="<?php echo $type === 'select' ? '' : 'display:none;'; ?>"><?php echo $options; ?></textarea>
                <button type="button" class="button cwb-remove-row">Remove</button>
            </div>
            <div class="cwb-repeater-wrapper" style="display:<?php echo $repeater_display; ?>;">
                <ul class="cwb-repeater-fields">
                    <?php
                    if (!empty($field['subfields']) && is_array($field['subfields'])) {
                        foreach ($field['subfields'] as $sub_i => $subfield) {
                            $this->render_field_row($subfield, "$index" . "_" . "$sub_i", true);
                        }
                    }
                    ?>
                </ul>
                <button type="button" class="button cwb-add-subrow" data-parent-name="<?php echo esc_attr($index); ?>">+ Add Sub Field</button>
            </div>
        </li>
        <?php
    }

    private function sanitize_fields_recursive($fields) {
        $sanitized = [];
        foreach ($fields as $field) {
            if (!is_array($field)) continue;
            $item = [
                'label' => sanitize_text_field($field['label'] ?? ''),
                'handle' => sanitize_title($field['handle'] ?? ''),
                'type' => sanitize_text_field($field['type'] ?? ''),
                'value' => sanitize_text_field($field['value'] ?? ''),
            ];
            if (!empty($field['options'])) {
                $item['options'] = sanitize_textarea_field($field['options']);
            }
            if (!empty($field['subfields']) && is_array($field['subfields'])) {
                $item['subfields'] = $this->sanitize_fields_recursive($field['subfields']);
            }
            $sanitized[] = $item;
        }
        return $sanitized;
    }

}

new CWB_Block_Setup;
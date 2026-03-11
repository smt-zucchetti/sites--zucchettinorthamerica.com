<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php
$query = $this->model->get_posts();
$taxonomy = $this->model->get_taxonomy();

// Fetch all non-empty terms for the determined taxonomy
$terms = get_terms([
    'taxonomy'   => $taxonomy,
    'hide_empty' => false,
]);

// Determine current term slug if on taxonomy archive
$current_term_slug = '';
$queried = get_queried_object();
if ($queried && $queried instanceof WP_Term && $queried->taxonomy === $taxonomy) {
    $current_term_slug = $queried->slug;
}
?>

<div class="posts-navigator" 
     data-atts='<?php echo json_encode($atts, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'
     data-max-pages="<?php echo esc_attr($query->max_num_pages); ?>"
     data-page="1">

    <!-- Term Filter -->
    <?php if ( !empty($terms) && !is_wp_error($terms) ): ?>
        <div class="posts-navigator--filter_wrap">
            <div class="posts-navigator--filter">
                <button class="posts-navigator--filter_item <?php echo $current_term_slug === '' ? 'active' : ''; ?>" data-term="">
                    <?php esc_html_e('All', 'text-domain'); ?>
                </button>

                <?php foreach ($terms as $term): ?>
                    <button class="posts-navigator--filter_item <?php echo $current_term_slug === $term->slug ? 'active' : ''; ?>" data-term="<?php echo esc_attr($term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                    </button>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>

    <!-- Posts Grid -->
    <div class="posts-navigator--grid">
        <?php if ( $query->have_posts() ): ?>
            <?php while ( $query->have_posts() ): $query->the_post(); ?>
                <?php include __DIR__ . '/view-loop-item.php'; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="warning"><?php esc_html_e('No posts found.', 'text-domain'); ?></div>
        <?php endif; ?>
    </div>

    <!-- Load More Button -->
    <?php if ( $query->max_num_pages > 1 ): ?>
        <div class="posts-navigator--loadmore-wrap">
            <button class="posts-navigator--loadmore nectar-button jumbo regular accent-color has-icon  regular-button" role="button" style="visibility: visible;" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff"><span><?php esc_html_e('Load More', 'text-domain'); ?></span><i class="icon-button-arrow"></i></button>
        </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</div>

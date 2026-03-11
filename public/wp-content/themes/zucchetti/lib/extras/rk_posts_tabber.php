<?php
/**
 * Blog Sidebar Tabber Shortcode
 * Usage: [blog_sidebar_tabber]
 */
function rokettopillar_blog_sidebar_tabber_shortcode() {
    ob_start(); ?><div class="hc-blog-sidebar-tabber hc-blog-sidebar-item">
        <div class="hc-blog-sidebar-tabber--titles">
            <div class="hc-blog-sidebar-tabber--tab_title active" data-target="popular">
                <?php echo __('Popular', 'rokettopillar'); ?>
            </div>
            <div class="hc-blog-sidebar-tabber--tab_title" data-target="recent">
                <?php echo __('Recent', 'rokettopillar'); ?>
            </div>
        </div>
        <!-- Popular tab -->
        <div class="hc-blog-sidebar-tabber--tab" data-tab="popular">
            <div class="hc-blog-sidebar-tabber--tab_posts">
                <?php
                $popular_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                    'meta_key'       => 'nectar_blog_post_view_count',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'DESC',
                    'meta_query'     => [
                        [
                            'key'     => 'nectar_blog_post_view_count',
                            'compare' => 'EXISTS'
                        ]
                    ]
                ]);
                if ($popular_query->have_posts()) :
                    while ($popular_query->have_posts()) : $popular_query->the_post();
                        $post_id = get_the_ID(); ?>
                        <a href="<?php echo get_the_permalink($post_id); ?>" class="hc-blog-sidebar-tabber-item">
                            <div class="hc-blog-sidebar-tabber-item--image">
                                <div class="hc-blog-sidebar-tabber-item--image_wrap">
                                    <?php 
                                    if (has_post_thumbnail($post_id)) {
                                        echo get_the_post_thumbnail($post_id, 'large');
                                    } ?>
                                </div>
                            </div>
                            <div class="hc-blog-sidebar-tabber-item--content">
                                <time class="hc-blog-sidebar-tabber-item--date">
                                    <i class="rk-icon-calendar"></i>
                                    <span><?php echo get_the_date('F j, Y', $post_id); ?></span>
                                </time>
                                <h4 class="hc-blog-sidebar-tabber-item--title"><?php echo get_the_title($post_id); ?></h4>
                            </div>
                        </a>
                    <?php endwhile;
                else :
                    echo __('No posts found', 'rokettopillar');
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <!-- Recent tab -->
        <div class="hc-blog-sidebar-tabber--tab" style="display:none;" data-tab="recent">
            <div class="hc-blog-sidebar-tabber--tab_posts">
                <?php
                $recent_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);

                if ($recent_query->have_posts()) :
                    while ($recent_query->have_posts()) : $recent_query->the_post();
                        $post_id = get_the_ID(); ?>

                        <a href="<?php echo get_the_permalink($post_id); ?>" class="hc-blog-sidebar-tabber-item">
                            <div class="hc-blog-sidebar-tabber-item--image">
                                <div class="hc-blog-sidebar-tabber-item--image_wrap">
                                    <?php 
                                    if (has_post_thumbnail($post_id)) {
                                        echo get_the_post_thumbnail($post_id, 'large');
                                    } ?>
                                </div>
                            </div>
                            <div class="hc-blog-sidebar-tabber-item--content">
                                <time class="hc-blog-sidebar-tabber-item--date">
                                    <i class="rk-icon-calendar"></i>
                                    <span><?php echo get_the_date('F j, Y', $post_id); ?></span>
                                </time>
                                <h4 class="hc-blog-sidebar-tabber-item--title"><?php echo get_the_title($post_id); ?></h4>
                            </div>
                        </a>

                    <?php endwhile;
                else :
                    echo __('No posts found', 'rokettopillar');
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('blog_sidebar_tabber', 'rokettopillar_blog_sidebar_tabber_shortcode');

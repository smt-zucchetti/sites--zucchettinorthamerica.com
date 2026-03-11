<?php

// Add this to functions.php or a custom plugin
function hc_newsletter_shortcode() {
    // Get ACF option field
    $newsletter = get_field('newsletter', 'option');

    ob_start();
    ?><div class="hc-blog-sidebar-newsletter hc-blog-sidebar-item">
        <img class="hc-blog-sidebar-newsletter--accent_l" src="<?php echo get_stylesheet_directory_uri();?>/dist/images/lightgreen_burst.svg" />
		<img class="hc-blog-sidebar-newsletter--accent_r" src="<?php echo get_stylesheet_directory_uri();?>/dist/images/br_corner_accent.svg" />
        <div class="hc-blog-sidebar-newsletter--inner">
            <?php if (!empty($newsletter['title'])) : ?>
                <h3 class="hc-blog-sidebar-newsletter--title">
                    <?php echo esc_html($newsletter['title']); ?>
                </h3>
            <?php endif; ?>

            <?php if (!empty($newsletter['description'])) : ?>
                <p class="hc-blog-sidebar-newsletter--description">
                    <?php echo esc_html($newsletter['description']); ?>
                </p>
            <?php endif; ?>

            <div class="hc-blog-sidebar-newsletter--form">
                <?php echo do_shortcode('[' . $newsletter['form_shortcode'] . ']'); ?>
            </div>
        </div>
    </div><?php
    return ob_get_clean();
}
add_shortcode('hc_newsletter', 'hc_newsletter_shortcode');
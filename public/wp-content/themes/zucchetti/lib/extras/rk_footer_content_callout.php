<?php
// Add this to functions.php or a custom plugin
function rk_footer_callout_content() {
    // Get the current post/page ID
    $post_id = get_the_ID();

    // Get local field (page-specific)
    $local_content    = get_field('footer_callout_content', $post_id);
    $local_link       = get_field('footer_callout_link', $post_id);
    $local_link_style = get_field('footer_callout_link_style', $post_id);

    // Get global option field
    $global_content    = get_field('footer_callout_content', 'option');
    $global_link       = get_field('footer_callout_link', 'option');
    $global_link_style = get_field('footer_callout_link_style', 'option');

    $content = '';

    ob_start();

    if ( !empty($local_link_style ) ) {
        $link_style = $local_link_style;
    } else {
        $link_style = $global_link_style;
    }

    $link_url = false;

    // Prefer local content if it exists, otherwise fallback
    if ( !empty($local_content) ) {
        $content .= $local_content;
    } elseif ( !empty($global_content) ) {
        $content .=  $global_content;
    }

    if ( !empty($local_link) ) {
        $link_url    = $global_link['url'];
        $link_target = $global_link['target'];
        $link_text   = $global_link['title'];
    } elseif ( !empty($global_link) ) {
        $link_url    = $global_link['url'];
        $link_target = $global_link['target'];
        $link_text   = $global_link['title'];
    }
    if ($link_url) {
        if ($link_style == 'white') {
            $content .= '<a class="nectar-button jumbo see-through accent-color has-icon" role="button" target="' . $link_target . '" style="border-color: rgba(255, 255, 255, 0.75); color: rgb(255, 255, 255); visibility: visible;" href="' . $link_url . '" data-color-override="#FFFFFF" data-hover-color-override="false" data-hover-text-color-override="#fff"><span>' . $link_text . '</span><i class="icon-button-arrow" style="color: rgb(255, 255, 255); background-color: rgb(255, 255, 255); box-shadow: rgba(255, 255, 255, 0.24) 0px 8px 15px;"></i></a>';
        } else {
            $content .= '<a class="nectar-button jumbo regular accent-color has-icon  regular-button" role="button" target="' . $link_target . '" style="visibility: visible;" href="' . $link_url . '" data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff"><span>' . $link_text . '</span><i class="icon-button-arrow"></i></a>';
        }
    }
    
    echo $content;

    return ob_get_clean();

}
add_shortcode('footer_callout_content', 'rk_footer_callout_content');

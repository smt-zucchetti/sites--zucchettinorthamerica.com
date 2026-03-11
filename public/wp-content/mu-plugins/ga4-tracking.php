<?php
/**
 * Plugin Name: GA4 Tracking (MU)
 * Description: Adds GA4 tracking code to all site pages.
 * Version: 1.0
 */

add_action('wp_head', function () {
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WTWKX0YPT7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-WTWKX0YPT7');
    </script>
    <?php
});


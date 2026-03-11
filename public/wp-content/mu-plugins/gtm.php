<?php
/**
 * MU Plugin: Google Tag Manager
 */
defined('ABSPATH') || exit;

define('SITE_GTM_ID', 'GTM-PT6MGWNG');

/**
 * Output main GTM script inside <head>
 */
add_action('wp_head', function () {
    if (is_admin() || wp_doing_ajax()) return;
    ?>
    <!-- Google Tag Manager -->
    <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo esc_js(SITE_GTM_ID); ?>');
    </script>
    <!-- End Google Tag Manager -->
    <?php
}, 0);

/**
 * Output noscript fallback immediately after <body>
 */
add_action('wp_body_open', function () {
    if (is_admin() || wp_doing_ajax()) return;
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr(SITE_GTM_ID); ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}, 0);

/**
 * Fallback if theme does not support wp_body_open()
 */
add_action('wp_footer', function () {
    if (is_admin() || wp_doing_ajax()) return;
    ?>
    <!-- GTM noscript fallback -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr(SITE_GTM_ID); ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <?php
}, 0);


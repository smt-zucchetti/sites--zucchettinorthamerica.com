<?php
/**
 * Add Phone Number to Header
 */
function rk_add_login_to_header() {
    // Get the phone number from the ACF options page
    $login_url = get_field('login_url', 'options');

    if ($login_url) {

        $login_url_url = isset($login_url['url'])  ? $login_url['url'] : false;
        $login_title   = isset($login_url['title'])  ? $login_url['title'] : false;
        $login_target  = isset($login_url['target'])  ? $login_url['target'] : false;

        if ($login_url_url) {
            echo '<li class="header-login_url">';
                echo '<div class="login_url--wrap">';
                    echo '<a target="' . $login_target .'" class="login_url--link" href="' . $login_url_url . '">';
                        if ($login_title) {
                            echo '<i class="rk-icon-login"></i>';                
                            echo '<span class="login_url--text">' . $login_title . '</span>';
                        }
                    echo '</a>';
                echo '</div>';
            echo '</li>';
        }
    }
}

add_action('nectar_before_header_button_list_items', 'rk_add_login_to_header');
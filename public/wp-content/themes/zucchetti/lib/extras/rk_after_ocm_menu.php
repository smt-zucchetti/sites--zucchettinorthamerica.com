<?php
add_action( 'nectar_hook_ocm_after_menu', 'rk_after_ocm_menu' );

function rk_after_ocm_menu() {
    $login_url = get_field('login_url', 'options');
    $phone_number = get_field('phone_number', 'options');

    if ( $login_url || $phone_number ) {

        echo '<ul class="after-ocm-content">';

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

            if ($phone_number) {
                echo '<li class="header-phone-number">';
                    echo '<div class="header-phone-number--wrap">';
                        echo '<i class="rk-icon-phone"></i>';                
                        echo '<a class="header-phone-number--link" href="tel:' . rk_phone_number_to_href($phone_number) . '">';
                            echo '<span class="header-phone-number--phone">';
                                echo esc_html($phone_number);
                            echo '</span>';
                        echo '</a>';
                    echo '</div>';
                echo '</li>';
            }
        }
        echo '</ul>';
    }
}
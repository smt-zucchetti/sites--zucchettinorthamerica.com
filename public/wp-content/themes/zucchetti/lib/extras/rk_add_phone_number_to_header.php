<?php
/**
 * Add Phone Number to Header
 */
function rk_add_phone_number_to_header() {
    // Get the phone number from the ACF options page
    $phone_number_text = get_field('phone_number_text', 'options');
    $phone_number = get_field('phone_number', 'options');

    if ($phone_number) {
        echo '<li class="header-phone-number">';
            echo '<div class="header-phone-number--wrap">';
                echo '<i class="rk-icon-phone"></i>';                
                echo '<a class="header-phone-number--link" href="' . rk_phone_number_to_href($phone_number) . '">';
                    if ($phone_number_text) {
                        echo '<span class="header-phone-number--text">' . $phone_number_text . '</span>';
                    }
                    echo '<span class="header-phone-number--phone">';
                        echo esc_html($phone_number);
                    echo '</span>';
                echo '</a>';
            echo '</div>';
        echo '</li>';
    }
}

add_action('nectar_before_header_button_list_items', 'rk_add_phone_number_to_header');
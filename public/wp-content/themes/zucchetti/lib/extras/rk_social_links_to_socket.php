<?php

function rk_social_links_to_social($items, $args) {
    if ($args->menu->name === 'Socket') {
        // Capture the output of nectar_ocm_add_social
        ob_start();
        echo nectar_ocm_add_social();
        $output = ob_get_clean();

        // Load into DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $output);

        $lis = '';
        foreach ($dom->getElementsByTagName('li') as $li) {
            // Add the custom class
            $existing_class = $li->getAttribute('class');
            $li->setAttribute('class', trim($existing_class . ' socket-social-link'));

            // Append HTML to string
            $lis .= $dom->saveHTML($li);
        }

        // Prepend to the menu
        $items = $lis . $items;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'rk_social_links_to_social', 10, 2);

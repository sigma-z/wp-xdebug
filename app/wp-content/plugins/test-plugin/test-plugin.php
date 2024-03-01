<?php
/*
* Plugin Name: Test Plugin
*/

function my_acf_json_load_point($paths) {
    // Remove the original path (optional).
    unset($paths[0]);

    $paths[] = __DIR__ . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

add_action('acf/init', function() {
    add_action('acf/init', function() {
        acf_add_options_page([
            'page_title' => 'Option Page',
            'menu_slug' => 'option-page',
            'position' => '',
            'redirect' => false,
        ]);
    });
}, 20);


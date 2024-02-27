<?php
/*
* Plugin Name: Test Plugin
*/


add_action('acf/init', function() {
    $fieldsJson = @file_get_contents(__DIR__ . '/fields.json');
    add_filter('acf/settings/save_json', function () {
        return __DIR__;
    });
    if (!$fieldsJson || !function_exists('acf_add_local_field_group')) {
        return;
    }

    $fieldGroups = json_decode($fieldsJson, true) ?: [];
    foreach ($fieldGroups as $group) {
        acf_add_local_field_group($group);
    }

    $optionsJson = @file_get_contents(__DIR__ . '/options.json');
    $optionsPages = json_decode($optionsJson, true) ?: [];
    foreach ($optionsPages as $group) {
        acf_add_local_field_group($group);
    }

    add_action('acf/init', function() {
        acf_add_options_page([
            'page_title' => 'Option Page',
            'menu_slug' => 'option-page',
            'position' => '',
            'redirect' => false,
        ]);
    });
}, 20);

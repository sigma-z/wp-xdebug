<?php
/*
* Plugin Name: Test Plugin
*/

$fieldsJson = @file_get_contents(__DIR__ . '/fields.json');
if (!$fieldsJson || !function_exists('acf_add_local_field_group')) {
    return;
}

$fieldGroups = json_decode($fieldsJson, true) ?: [];
foreach ($fieldGroups as $group) {
    acf_add_local_field_group($group);
}

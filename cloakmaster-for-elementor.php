<?php
/**
 * @package CloakMaster for Elementor
 * @version 1.0
 */
/*
Plugin Name: CloakMaster for Elementor
Description: CloakMaster for Elementor is a plugin designed to dynamically control the visibility of Elementor elements based on visitor type detection. This plugin lets you decide which elements should be hidden from bots or from human users before they are rendered on the page.
Author: Oleksandr Homenko
Version: 1.0
Author URI: https://linktr.ee/leksdev
*/

try {
    // Include bot checker script
    require_once plugin_dir_path(__FILE__) . 'cmfe-bot-checker.php';

// Include elementor options script
    add_action('elementor/init', function () {
        require_once plugin_dir_path(__FILE__) . 'cmfe-elements-options.php';
    });

// Include the admin settings page
    if (is_admin()) {
        require_once plugin_dir_path(__FILE__) . 'cmfe-admin-settings.php';
    }

} catch (\Exception $e) {
    error_log('CloakMaster: ' . $e->getMessage());
}

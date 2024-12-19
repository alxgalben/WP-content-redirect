<?php
/*
Plugin Name: Redirect Plugin
Plugin URI: https://example.com
Description: A plugin to handle 301 redirects for old URLs to new ones.
Version: 1.0
Author: Alex Galben
Author URI: https://example.com
License: GPL2
Text Domain: redirect-plugin
*/

// prevenire acces direct
if (!defined('ABSPATH')) {
    exit;
}

include_once plugin_dir_path(__FILE__) . 'includes/redirect-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/admin-functions.php';

// aactivare
register_activation_hook(__FILE__, 'redirect_plugin_activate');

function redirect_plugin_activate() {
    include_once plugin_dir_path(__FILE__) . 'includes/db-functions.php';
    create_redirect_table();
}
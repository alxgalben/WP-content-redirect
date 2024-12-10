<?php
add_action('admin_menu', 'redirect_plugin_menu');

function redirect_plugin_menu() {
    add_menu_page(
        'Redirect Manager',
        'Redirect Manager',
        'manage_options',
        'redirect-manager',
        'render_redirect_manager_page',
        'dashicons-randomize'
    );
}

function render_redirect_manager_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    include plugin_dir_path(__FILE__) . 'views/admin-page.php';
}
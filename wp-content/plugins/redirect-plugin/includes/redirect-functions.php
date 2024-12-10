<?php
add_action('template_redirect', 'handle_redirect');

function handle_redirect() {
    if (is_admin()) return;

    global $wpdb;
    $requested_url = trim($_SERVER['REQUEST_URI'], '/');
    $table_name = $wpdb->prefix . 'redirects';

    $redirect = $wpdb->get_row($wpdb->prepare(
        "SELECT new_url FROM $table_name WHERE old_url = %s",
        $requested_url
    ));

    if ($redirect && !empty($redirect->new_url)) {
        wp_redirect(home_url($redirect->new_url), 301);
        exit;
    }
}
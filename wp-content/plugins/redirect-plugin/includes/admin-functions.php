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
        wp_die(__('Nu ai permisiunea de a accesa această pagină.'));
    }

    echo '<h1>Funcția este apelată corect!</h1>'; // Linie de test

    global $wpdb;
    $table_name = $wpdb->prefix . 'redirects';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect_manager_nonce'])) {
        if (!wp_verify_nonce($_POST['redirect_manager_nonce'], 'redirect_manager_action')) {
            wp_die(__('Nonce invalid.'));
        }

        $old_url = sanitize_text_field($_POST['old_url']);
        $new_url = sanitize_text_field($_POST['new_url']);

        if (!empty($old_url) && !empty($new_url)) {
            $wpdb->insert($table_name, [
                'old_url' => trim($old_url, '/'),
                'new_url' => trim($new_url, '/'),
                'created_at' => current_time('mysql'),
                'updated_at' => current_time('mysql'),
            ]);
            echo '<div class="updated"><p>Redirecția a fost adăugată.</p></div>';
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = absint($_GET['id']);
        $wpdb->delete($table_name, ['id' => $id]);
        echo '<div class="updated"><p>Redirecția a fost ștearsă.</p></div>';
    }

    echo plugin_dir_path(__FILE__) . '../views/admin-page.php';
    include plugin_dir_path(__FILE__) . '../views/admin-page.php';
}
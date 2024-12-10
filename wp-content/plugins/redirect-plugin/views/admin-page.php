<div class="wrap">
    <h1>Redirect Manager</h1>
    <form method="post" action="">
    <?php wp_nonce_field('redirect_manager_action', 'redirect_manager_nonce'); ?>
    <input type="hidden" name="action" value="add_redirect">
    <table class="form-table">
        <tr>
            <th scope="row"><label for="old_url">URL vechi</label></th>
            <td><input name="old_url" type="text" id="old_url" class="regular-text"></td>
        </tr>
        <tr>
            <th scope="row"><label for="new_url">URL nou</label></th>
            <td><input name="new_url" type="text" id="new_url" class="regular-text"></td>
        </tr>
    </table>
    <?php submit_button('Adaugă Redirecție'); ?>
</form>

    <h2>Lista Redirecțiilor</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>URL Vechi</th>
                <th>URL Nou</th>
                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $wpdb;
            $table_name = $wpdb->prefix . 'redirects';
            $redirects = $wpdb->get_results("SELECT * FROM $table_name");

            foreach ($redirects as $redirect) {
                echo "<tr>
                    <td>{$redirect->id}</td>
                    <td>{$redirect->old_url}</td>
                    <td>{$redirect->new_url}</td>
                    <td>
                        <a href='?page=redirect-manager&action=delete&id={$redirect->id}' class='button button-danger'>Șterge</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
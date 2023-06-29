<?php
    /**
     * Plugin Name: WP Admin Notes Plugin
     * Version 0.0.1
     * Author: David Derrick Anyuru
     * Author URI: https://anyuru.gihub.io
     * Description: A simple worpress plugin
     */

    //  Add a new menu item to Wordpress Admin Dashboard

    function admin_notes_menu() {
        add_menu_page('Admin Notes', 'Admin Notes', "manage_options", "admin-notes-wpanp", 'admin_notes_page', 'dashicons-book', 10);

    }

    function admin_notes_page() {
        if( !current_user_can('manage_options')):
    ?>
    <p>
        Access denied. You need admin priviledges.
    </p>
    <?php 
            return;
        endif;    
    }

    $notes = get_option('admin_notes');
    if(!is_array($notes)) {
        $notes = array();
    }

    if( isset($_POST['submit_admin_notes_wpamp'])):
        $note = sanitize_textarea_field( $_POST('admin_note_wpanp'));
        $notes[] = $note;

        $result = update_option('admin_notes', $notes);
    endif;
    ?>
    
    <?php
    // This function will attach the admin function to the 
    add_action('admin_name', 'admin_notes_menu');
    ?>
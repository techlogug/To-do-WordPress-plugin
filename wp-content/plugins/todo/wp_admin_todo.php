<?php

/**
 * Admin todo plugin
 *
 * @package           Todo Plugin
 * @author            PHP Ninjas
 * @copyright         2023 PHP Ninjas
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Todo Plugin
 * Plugin URI:        https://github.com/techlogug/To-do-WordPress-plugin
 * Description:       A plugin to manage admin todos
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            PHP ninjas
 * Author URI:        https://github.com/techlogug/To-do-WordPress-plugin
 * Text Domain:       todo-plugin
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * Update URI:        https://github.com/techlogug/To-do-WordPress-plugin
 * Github Plugin URI: https://github.com/techlogug/To-do-WordPress-plugin
 * Github Branch:     main
 */

// $plugin_data = get_plugin_data(__FILE__);
// define('TODO_PLUGIN_VERSION', $plugin_data['Version']);

add_action('admin_menu', 'todos_menu');

register_activation_hook(__FILE__, 'todos_activate');

// Activate plugin
function todos_activate() {
    update_todos_table();
}

// Create the database table
function update_todos_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'todos_table';

    $charset_collate = $wpdb->get_charset_collate();

    // Create the table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        todo_title VARCHAR(255) NOT NULL,
        todo_description TEXT,
        todo_priority INT(11) NOT NULL,
        todo_category VARCHAR(255) NOT NULL,
        todo_status VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    
}

function todos_menu()
{
    add_menu_page('Todos', 'Todos', "manage_options", "todos-wpanp", 'todos_page', 'dashicons-book', 10);
    add_submenu_page('todos-wpanp', 'Add New Todo', 'Add New', "manage_options", "todos-wpanp-add", 'todos_add_page');
    add_submenu_page('todos-wpanp', 'Sessings', 'Settings', "manage_options", "todos-wpanp-settings", 'todos_settings_page');
}

function todos_page()
{
    echo "<h1>Todo List</h1>";
}

function todos_add_page()
{
    echo "<h1>Add New Todo</h1>";
}

function todos_settings_page() {
    echo "<h1>Settings</h1>";
}



?>
<?php

/**
 * Admin todo plugin
 *
 * @package           Todo Plugin
 * @version           1.0.0
 * @requires          5.2
 * @requires PHP      7.2
 * @Author            PHP Ninjas
 * @License           GPL-2.0-or-later
 * @License URI       http://www.gnu.org/licenses/gpl-2.0.txt
 * @wordpress-plugin
 * Plugin Name:       Todo Plugin
 * Plugin URI:        https://github.com/techlogug/To-do-WordPress-plugin
 * Description:       A plugin to manage admin todos
 * Version:           1.0.0
 * Author:            PHP ninjas
 * Author URI:        https://github.com/techlogug/To-do-WordPress-plugin
 * Text Domain:       todo-plugin
 * Domain Path:       /languages
 * Update URI:        https://github.com/techlogug/To-do-WordPress-plugin
 * Github Plugin URI: https://github.com/techlogug/To-do-WordPress-plugin
 * Github Branch:     main
 */

// Enqueue plugin stylesheet
function enqueue_plugin_styles()
{
    wp_enqueue_style('plugin-style', plugins_url('assets/css/style.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'enqueue_plugin_styles');

// Dummy todos
$todos = [
    [
        'id' => 1,
        'title' => 'Complete project proposal',
        'description' => 'Write and submit the project proposal by Friday.',
        'priority' => 'high',
        'category' => 'pending',
        'duedate' => '2023-07-05',
    ],
    [
        'id' => 2,
        'title' => 'Review client feedback',
        'description' => 'Review and incorporate client feedback into the design.',
        'priority' => 'medium',
        'category' => 'in progress',
        'duedate' => '2023-07-07',
    ],
    [
        'id' => 3,
        'title' => 'Test application for bugs',
        'description' => 'Perform thorough testing of the application and log any bugs.',
        'priority' => 'low',
        'category' => 'completed',
        'duedate' => '2023-07-10',
    ],
    // Add more todos as needed
];

// Activate plugin
register_activation_hook(__FILE__, 'todos_activate');
function todos_activate()
{
    update_todos_table();
}

// Create the database table
function update_todos_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'todos_table';

    $charset_collate = $wpdb->get_charset_collate();

    // Create the table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        todo_title VARCHAR(255) NOT NULL,
        todo_description TEXT,
        todo_priority VARCHAR(255) NOT NULL,
        todo_category VARCHAR(255) NOT NULL,
        todo_duedate DATE,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Add menu and submenu pages
add_action('admin_menu', 'todos_menu');
function todos_menu()
{
    add_menu_page('Todos', 'Todos', 'manage_options', 'todos-wpanp', 'todos_page', 'dashicons-book', 10);
    add_submenu_page('todos-wpanp', 'Add New Todo', 'Add New', 'manage_options', 'todos-wpanp-add', 'todos_add_page');
    add_submenu_page('todos-wpanp', 'Settings', 'Settings', 'manage_options', 'todos-wpanp-settings', 'todos_settings_page');
}

// Menu page callback
function todos_page()
{
    global $todos;

    echo '<div class="p-4">';
    echo '<h1 class="text-xl font-bold mb-4">Tasks</h1>';

    echo '<div class="overflow-x-auto">';
    echo '<div class="mb-4 flex justify-end"><a href="' . admin_url('admin.php?page=todos-wpanp-add') . '" class="text-md font-bold text-white justify-end rounded bg-[#2271B1] px-2 py-2">Add Task</a></div>';
    echo '<table class="w-full divide-y divide-gray-200">';
    echo '<thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <input type="checkbox" id="check-all">
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Priority
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Category
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Due Date
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
            </tr>
        </thead>';
    echo '<tbody>';

    foreach ($todos as $todo) {
        $categoryClass = '';

        // Assign class based on category for styling
        switch ($todo['category']) {
            case 'completed':
                $categoryClass = 'bg-green-500';
                break;
            case 'pending':
                $categoryClass = 'bg-yellow-300';
                break;
            case 'in progress':
                $categoryClass = 'bg-black/80';
                break;
            default:
                $categoryClass = 'bg-red-500';
                break;
        }

        echo '<tr class="bg-white cursor-pointer hover:bg-gray-50">';
        echo '<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="checkbox" class="todo-checkbox"></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . $todo['title'] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . $todo['description'] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . $todo['priority'] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . $todo['category'] . '</td>';
        echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . $todo['duedate'] . '</td>';
        echo '<td class="px-6  whitespace-nowrap text-sm font-medium ">' . '<span class="py-1.5 px-2 rounded-md capitalize text-white ' . $categoryClass . '">' . $todo['category'] . '</span>' . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';

    // JavaScript code for handling checkbox behavior
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkAll = document.getElementById("check-all");
            const checkboxes = document.querySelectorAll(".todo-checkbox");

            checkAll.addEventListener("change", function() {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = checkAll.checked;
                });
            });
        });
    </script>';
}





// Submenu page callback
function todos_add_page()
{
    echo '<h1 class="border bg-red-300">Add New Todo</h1>';
}

// Submenu page callback
function todos_settings_page()
{
    echo "<h1>Settings</h1>";
}
<?php
/**
 * Plugin Name: Task Manager Lite
 * Plugin URI: https://github.com/btharun03/task-manager-lite
 * Description: A simple task manager plugin to add, view, and complete tasks inside WordPress.
 * Version: 1.0
 * Author: Tharun B
 * Author URI: https://github.com/btharun03
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Create custom table on plugin activation
 */
function tml_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tml_tasks'; // e.g., wp_tml_tasks

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        title text NOT NULL,
        description text NOT NULL,
        deadline date,
        status varchar(20) DEFAULT 'pending',
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// IMPORTANT: Hook must be registered from THIS FILE (main plugin file)
register_activation_hook(__FILE__, 'tml_create_table');

/**
 * Load other plugin functionality
 */
require_once plugin_dir_path(__FILE__) . 'includes/task-manager-functions.php';

<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add menu page in WP Admin
 */
function tml_admin_menu() {
    add_menu_page(
        'Task Manager',              // Page title
        'Task Manager',              // Menu title
        'manage_options',            // Capability
        'task-manager-lite',         // Menu slug
        'tml_display_tasks',         // Callback function
        'dashicons-list-view',       // Icon
        20                           // Position
    );
}
add_action('admin_menu', 'tml_admin_menu');

/**
 * Display tasks page content
 */
function tml_display_tasks() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tml_tasks';

    // Handle form submission: Add new task
    if (isset($_POST['tml_add_task'])) {
        $title = sanitize_text_field($_POST['title']);
        $description = sanitize_textarea_field($_POST['description']);
        $deadline = sanitize_text_field($_POST['deadline']);

        $wpdb->insert(
            $table_name,
            [
                'title'       => $title,
                'description' => $description,
                'deadline'    => $deadline,
                'status'      => 'pending'
            ],
            ['%s', '%s', '%s', '%s'] // Data format
        );

        echo "<div class='updated'><p>Task added successfully!</p></div>";
    }

    // Handle marking task complete
    if (isset($_GET['complete'])) {
        $task_id = intval($_GET['complete']);
        $wpdb->update(
            $table_name,
            ['status' => 'completed'],
            ['id' => $task_id],
            ['%s'],
            ['%d']
        );
        echo "<div class='updated'><p>Task marked as completed!</p></div>";
    }

    // Fetch tasks
    $tasks = $wpdb->get_results("SELECT * FROM $table_name");
    ?>
    <div class="wrap">
        <h1>Task Manager Lite</h1>

        <form method="post" style="margin-bottom:30px;">
            <h2>Add New Task</h2>
            <p><input type="text" name="title" placeholder="Task Title" required style="width:300px;"></p>
            <p><textarea name="description" placeholder="Task Description" style="width:300px;height:80px;"></textarea></p>
            <p><input type="date" name="deadline"></p>
            <p><button type="submit" name="tml_add_task" class="button button-primary">Add Task</button></p>
        </form>

        <h2>All Tasks</h2>
        <table class="widefat striped" style="max-width:800px;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($tasks): ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo esc_html($task->title); ?></td>
                            <td><?php echo esc_html($task->description); ?></td>
                            <td><?php echo esc_html($task->deadline); ?></td>
                            <td>
                                <?php echo ($task->status === 'completed') ? '✅ Completed' : '⏳ Pending'; ?>
                            </td>
                            <td>
                                <?php if ($task->status !== 'completed'): ?>
                                    <a href="?page=task-manager-lite&complete=<?php echo intval($task->id); ?>" class="button">Mark Complete</a>
                                <?php else: ?>
                                    <span style="color:green;">Done</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No tasks added yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

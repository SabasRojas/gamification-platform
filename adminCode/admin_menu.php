<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to provide the admin menu to the admin.
 *
 */
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS 4342 Admin Menu</title>

    <!-- Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <!-- Displaying a menu for various admin operations -->
    <div class="container">
        <h1>Administrator Menu:</h1>

        <ul>
            <li><a href="view_all_users.php">View all users info</a></li>
            <li><a href="view_top_user.php">View Current Top User</a></li>
            <li><a href="view_all_user_points.php">View Points for all Users</a><br>
            <li><a href="moderate_chat_room.php">Moderate Chat Room</a></li>
            <li><a href="admin_create_task.php">Create a Task</a></li>
            <li><a href="view_completed_task.php">View Completed Task with User</a></li>
            <li><a href="view_most_completed_task_type.php">View Most Completed Task Type</a></li>
            <li><a href="view_completed_group_task.php">View Task Completed by Groups</a></li>
            <li><a href="view_tasks.php">View, Modify, or Delete Tasks</a></li>
            <li><a href="observe_users.php">Update User Information</a></li>
            <li><a href="../index.php">Return to Login</a></li>

        </ul>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
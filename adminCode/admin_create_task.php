<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let the admin create a task where users can participate.
 *
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Submit'])) {

    // Grab information from the form submission and store values into variables.
    $task_name = isset($_POST['task_name']) ? $_POST['task_name'] : " ";
    $task_description = isset($_POST['task_description']) ? $_POST['task_description'] : " ";
    $task_owner = isset($_POST['task_owner']) ? $_POST['task_owner'] : " ";
    $task_type = isset($_POST['task_type']) ? $_POST['task_type'] : " ";
    $point_amount = isset($_POST['point_amount']) ? $_POST['point_amount'] : 0;
    $user_needed = isset($_POST['user_needed']) ? $_POST['user_needed'] : 0;
    $time_frame = isset($_POST['time_frame']) ? $_POST['time_frame'] : " ";

    // Insert into Task table.
    $queryTask = "INSERT INTO Task (Tname, Tdescription, Towner, Type, Tpoint_amount, Tuser_needed, Ttime_frame)
                VALUES ('$task_name', '$task_description', '$task_owner', '$task_type', $point_amount, $user_needed, '$time_frame');";

    if ($conn->query($queryTask) === TRUE) {
        echo "<br> New record created successfully for task name " . $task_name;
    } else {
        echo "<br> The record was not created, the query: <br>" . $queryTask . "  <br> Generated the error <br>" . $conn->error;
    }

    // To redirect the page to the task menu right after the query is executed, use the following statement 
    // header("Location: task_menu.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create Task</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Create Task</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input class="form-control" type="text" id="task_name" name="task_name">
            </div>
            <div class="form-group">
                <label for="task_description">Task Description</label>
                <input class="form-control" type="text" id="task_description" name="task_description">
            </div>
            <div class="form-group">
                <label for="task_owner">Task Owner</label>
                <input class="form-control" type="text" id="task_owner" name="task_owner">
            </div>
            <div class="form-group">
                <label for="task_type">Task Type</label>
                <input class="form-control" type="text" id="task_type" name="task_type">
            </div>
            <div class="form-group">
                <label for="point_amount">Point Amount</label>
                <input class="form-control" type="text" id="point_amount" name="point_amount">
            </div>
            <div class="form-group">
                <label for="user_needed">Users Needed</label>
                <input class="form-control" type="text" id="user_needed" name="user_needed">
            </div>
            <div class="form-group">
                <label for="time_frame">Time Frame</label>
                <input class="form-control" type="datetime-local" id="time_frame" name="time_frame">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
            </div>
        </form>
        <div>
            <br>
            <a href="admin_menu.php">Back to Admin Menu</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>


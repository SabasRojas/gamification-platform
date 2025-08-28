<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to provide an interface to the function which lets users edit their tasks.
 *
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['Tname'])) {
    $tname = $_GET['Tname'];
    $sql = "SELECT * FROM Task where Tname = '$tname'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}
else {
    echo "No task name received on request at update_task_interface get";
    die();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Task Update</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Update Task</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <!-- Displaying a form with the information of the user so values can be modified 
             Note that the ID is not shown to be modified, only other attributes. -->

        <form action="update_task.php" method="post">
            <input type="hidden" name="Tname" id="Tname" value="<?php echo $row['Tname'] ?>">
            <div class="form-group">
                <label for="task_description">Description</label>
                <input class="form-control" type="text" id="task_description" name="task_description" value="<?php echo $row['Tdescription'] ?>">
            </div>
                <input type="hidden" id="task_owner" name="task_owner" value="<?php echo $row['Towner'] ?>">
            <div class="form-group">
                <label for="task_type">Type</label>
                <input class="form-control" type="text" id="task_type" name="task_type" value="<?php echo $row['Type'] ?>">
            </div>
            <div class="form-group">
                <label for="task_point_amount">Point Amount</label>
                <input class="form-control" type="text" id="task_point_amount" name="task_point_amount" value="<?php echo $row['Tpoint_amount'] ?>">
            </div>
            <div class="form-group">
                <label for="task_user_needed">User Needed</label>
                <input class="form-control" type="text" id="task_user_needed" name="task_user_needed" value="<?php echo $row['Tuser_needed'] ?>">
            </div>
            <div class="form-group">
                <label for="task_time_frame">Time Frame</label>
                <input class="form-control" type="text" id="task_time_frame" name="task_time_frame" value="<?php echo $row['Ttime_frame'] ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Update">
            </div>
        </form>
        <div>
            <br>
            <a href="view_user_tasks.php">Back to User Menu</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
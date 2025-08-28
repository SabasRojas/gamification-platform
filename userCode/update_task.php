<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let the users update or edit their tasks.
 *
 */
-->

<?php

// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_POST['Tname'])){

  $tname = isset($_POST['Tname']) ? $_POST['Tname'] : " ";
  $tdescription = isset($_POST['task_description']) ? $_POST['task_description'] : " ";
  $towner = isset($_POST['task_owner']) ? $_POST['task_owner'] : " ";
  $ttype = isset($_POST['task_type']) ? $_POST['task_type'] : " ";
  $tpointamount = isset($_POST['task_point_amount']) ? $_POST['task_point_amount'] : " ";
  $tuserneeded = isset($_POST['task_user_needed']) ? $_POST['task_user_needed'] : " ";
  $ttimeframe = isset($_POST['task_time_frame']) ? $_POST['task_time_frame'] : " ";

    $query = "UPDATE Student SET Tdescription='$tdescription',Towner='$towner',Ttype='$ttype',Tpoint_amount='$tpointamount',Tuser_needed='$tuserneeded',Ttime_frame='$ttimeframe' WHERE Tname = $tname";
    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("Location: view_user_task.php");
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }

}
else {
  echo "No task name received on request at update student";
  die();
}

?>

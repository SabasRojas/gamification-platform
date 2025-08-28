<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let the user delete a task.
 *
 */
-->

<?php 

session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['Tname'])){

    $tname = $_GET['Tname'];
    $query = "DELETE from Task where Tname = '$tname'";

    if ($conn->query($query) === TRUE) {
        echo "Task deleted successfuly";
        header("Location: view_tasks.php");
     } else {
         echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "No Tname received";
    header("Location: view_user_tasks.php");
}

?>
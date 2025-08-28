<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let the admin update a users info.
 *
 */
-->

<?php

// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_POST['userID'])) {
    $userID = isset($_POST['userID']) ? $_POST['userID'] : " ";
    $userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : " ";
    $userName = isset($_POST['userName']) ? $_POST['userName'] : " ";
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : " ";
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : " ";

    $query = "UPDATE User SET userEmail='$userEmail', userName='$userName', firstName='$firstName', lastName='$lastName' WHERE userID = '$userID';";
    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("Location: observe_users.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "No user ID received on request at update user";
    die();
}
?>

<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let the admin delete a user from the database.
 *
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Use prepared statement to delete the user
    $deleteUserQuery = $conn->prepare("DELETE FROM User WHERE userID = ?");
    $deleteUserQuery->bind_param("s", $userID);

    if ($deleteUserQuery->execute() === TRUE) {
        echo "User deleted successfully";
        header("Location: observe_users.php");
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $deleteUserQuery->close();
} else {
    echo "No user ID received on request at delete user";
    header("Location: view_users.php");
}
?>

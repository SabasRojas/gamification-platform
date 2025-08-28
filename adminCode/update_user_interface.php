<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to set to be the interface when the admin wants to update a users info.
 *
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM User WHERE userID = '$userID'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
} else {
    echo "No user ID received on request at update user interface";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 User Update</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Update User</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <!-- Displaying a form with the information of the user so values can be modified 
             Note that the ID is not shown to be modified, only other attributes. -->

        <form action="update_user.php" method="post">
            <input type="hidden" name="userID" id="userID" value="<?php echo $row['userID']; ?>">
            <div class="form-group">
                <label for="userEmail">Email</label>
                <input class="form-control" type="text" id="userEmail" name="userEmail" value="<?php echo $row['userEmail']; ?>">
            </div>
            <div class="form-group">
                <label for="userName">Username</label>
                <input class="form-control" type="text" id="userName" name="userName" value="<?php echo $row['userName']; ?>">
            </div>
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input class="form-control" type="text" id="firstName" name="firstName" value="<?php echo $row['firstName']; ?>">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input class="form-control" type="text" id="lastName" name="lastName" value="<?php echo $row['lastName']; ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Update">
            </div>
        </form>
        <div>
            <br>
            <a href="observe_users.php">Back to View all Users</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>


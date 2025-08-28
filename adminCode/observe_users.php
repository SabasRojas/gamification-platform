<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to show all the users to the admin when such admin wants to update a users info.
 *
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Users</title>
    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <h1>Update User Information</h1>
    <?php
    $sql = "SELECT userID, userEmail, userName, firstName, lastName, isAdmin FROM User";

    if ($result = $conn->query($sql)) {
    ?>
        <table class="table" width=50%>
            <thead>
                <td><b>User ID</b></td>
                <td><b>Email</b></td>
                <td><b>User Name</b></td>
                <td><b>First Name</b></td>
                <td><b>Last Name</b></td>
                <td><b>Role</b></td>
                <td><b>Update</b></td>
                <td><b>Delete</b></td>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_row()) {
                ?>
                    <tr>
                        <td><?php printf("%s", $row[0]); ?></td>
                        <td><?php printf("%s", $row[1]); ?></td>
                        <td><?php printf("%s", $row[2]); ?></td>
                        <td><?php printf("%s", $row[3]); ?></td>
                        <td><?php printf("%s", $row[4]); ?></td>
                        <td><?php printf("%s", $row[5]); ?></td>
                        <td><a href="update_user_interface.php?userID=<?php echo $row[0]; ?>">Update</a></td>
                        <td><a href="delete_user.php?userID=<?php echo $row[0]; ?>">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
    <!-- Link to return to admin menu-->
    <a href="admin_menu.php">Back to Administrator Menu</a><br>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


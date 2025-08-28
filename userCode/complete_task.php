<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let the user select a task to complete.
 *
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['participate'])) {
    $selectedTask = $_POST['selectedTask'];

    // Get the point amount for the selected task
    $pointQuery = "SELECT Tpoint_amount FROM Task WHERE Tname = '$selectedTask'";
    $pointResult = $conn->query($pointQuery);

    if ($pointResult->num_rows > 0) {
        $pointRow = $pointResult->fetch_assoc();
        $pointAmount = $pointRow['Tpoint_amount'];

        // Update the User table with the new point amount
        $updateQuery = "UPDATE User SET pointAmount = pointAmount + $pointAmount WHERE userID = {$_SESSION['userID']}";

        if ($conn->query($updateQuery) === TRUE) {
            // Insert the record into Completion table
            $insertQuery = "INSERT INTO Completion (Tname, userID) 
                            VALUES ('$selectedTask', {$_SESSION['userID']})";

            if ($conn->query($insertQuery) === TRUE) {
                echo "Successfully participated in the task: $selectedTask";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Error updating user point amount: " . $updateQuery . "<br>" . $conn->error;
        }
    } else {
        echo "Error fetching point amount: " . $pointQuery . "<br>" . $conn->error;
    }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    $sql = "SELECT * FROM Task";
    if ($result = $conn->query($sql)) {
    ?>
        <form method="post" action="">
            <table class="table" width=50%>
                <thead>
                    <td>Task Name</td>
                    <td>Description</td>
                    <td>Owner</td>
                    <td>Type</td>
                    <td>Point Amount</td>
                    <td>User Needed</td>
                    <td>Time Frame</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['Tname']; ?></td>
                            <td><?php echo $row['Tdescription']; ?></td>
                            <td><?php echo $row['Towner']; ?></td>
                            <td><?php echo $row['Type']; ?></td>
                            <td><?php echo $row['Tpoint_amount']; ?></td>
                            <td><?php echo $row['Tuser_needed']; ?></td>
                            <td><?php echo $row['Ttime_frame']; ?></td>
                            <td>
                                <button type="submit" name="participate" class="btn btn-primary" value="<?php echo $row['Tname']; ?>">Participate</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- Hidden field to store the selected task -->
            <input type="hidden" name="selectedTask" id="selectedTask">
        </form>
    <?php
    }
    ?>
    <!-- Link to return to student_menu-->
    <a href="user_menu.php">Back to User Menu</a><br>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script to set the selected task when the button is clicked -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var buttons = document.querySelectorAll('.btn-primary');
            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    document.getElementById('selectedTask').value = this.value;
                });
            });
        });
    </script>
</body>

</html>
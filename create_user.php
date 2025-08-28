<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let whoever us using the system create an account.
 *
 */
-->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create User Account</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Create User</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <form action="create_user.php" method="post">
            <div class="form-group">
                <label for="userID">User ID</label>
                <input class="form-control" type="text" id="userID" name="userID">
            </div>
            <div class="form-group">
                <label for="userEmail">User Email</label>
                <input class="form-control" type="text" id="userEmail" name="userEmail">
            </div>
            <div class="form-group">
                <label for="userName">User Name</label>
                <input class="form-control" type="text" id="userName" name="userName">
            </div>
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input class="form-control" type="text" id="firstName" name="firstName">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input class="form-control" type="text" id="lastName" name="lastName">
            </div>
            <div class="form-group">
                <label for="isAdmin">Is Administrator?</label>
                <select class="form-control" id="isAdmin" name="isAdmin">
                    <option value="User">User</option>
                    <option value="Administrator">Administrator</option>
                </select>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
            </div>
        </form>
        <div>
            <br>
            <a href="index.php">Back to User Login Menu</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- PHP code starts here -->
        <?php
        require_once('config.php');

        if (isset($_POST['Submit'])) {
            // Grab information from the form submission and store values into variables.
            $userID = isset($_POST['userID']) ? $_POST['userID'] : " ";
            $userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : " ";
            $userName = isset($_POST['userName']) ? $_POST['userName'] : " ";
            $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : " ";
            $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : " ";
            $isAdmin = isset($_POST['isAdmin']) ? $_POST['isAdmin'] : "User"; // Default to User if not provided.

            // Check if the user ID already exists
            $checkUserIDQuery = $conn->prepare("SELECT * FROM User WHERE userID = ?");
            $checkUserIDQuery->bind_param("s", $userID);
            $checkUserIDQuery->execute();
            $resultUserID = $checkUserIDQuery->get_result();

            // Check if the user name already exists
            $checkUserNameQuery = $conn->prepare("SELECT * FROM User WHERE userName = ?");
            $checkUserNameQuery->bind_param("s", $userName);
            $checkUserNameQuery->execute();
            $resultUserName = $checkUserNameQuery->get_result();

            if ($resultUserID->num_rows > 0) {
                echo "Error: User with ID " . $userID . " already exists. Please choose a different User ID.";
            } elseif ($resultUserName->num_rows > 0) {
                echo "Error: User with username " . $userName . " already exists. Please choose a different username.";
            } else {
                // Insert into User table.
                $queryUser = $conn->prepare("INSERT INTO User (userID, userEmail, userName, firstName, lastName, isAdmin)
                                            VALUES (?, ?, ?, ?, ?, ?)");
                $queryUser->bind_param("ssssss", $userID, $userEmail, $userName, $firstName, $lastName, $isAdmin);

                if ($queryUser->execute() === TRUE) {
                    echo "New user created successfully with the username: " . $userName . " and role: " . $isAdmin;
                } else {
                    echo "Error: " . $queryUser->error;
                }

                // Close the prepared statements
                $queryUser->close();
            }

            // Close the prepared statements
            $checkUserIDQuery->close();
            $checkUserNameQuery->close();
        }
        ?>
    </body>

</html>
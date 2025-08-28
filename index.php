<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to provide access to either a user or an admin to the system and database.
 *
 */
-->

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CS 4342 User Login</title>

  <!-- Bootstrap CSS library https://getbootstrap.com/ -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body>
  <div style="margin-top: 20px" class="container">

    <h1>User Login</h1>
    <form action="index.php" method="post">
      <div class="form-group">
        <label for="userName">User Name</label>
        <input class="form-control" type="text" id="userName" name="userName">
      </div>
      <div class="form-group">
        <label for="userID">User ID</label>
        <input class="form-control" type="text" id="userID" name="userID">
      </div>
      <div class="form-group">
        <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
      </div>
    </form>
    <a href="create_user.php">Don't have an account? Create one now!</a><br><br>

  </div>

  <!-- jQuery and JS bundle w/ Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>

<?php
session_start();
require_once("config.php");
$_SESSION['logged_in'] = false;

if (!empty($_POST)) {
  if (isset($_POST['Submit'])) {
    $input_userName = isset($_POST['userName']) ? $_POST['userName'] : " ";
    $input_userID = isset($_POST['userID']) ? $_POST['userID'] : " ";

    $queryUser = "SELECT * FROM User  WHERE userName='" . $input_userName . "' AND userID='" . $input_userID . "';";
    $resultUser = $conn->query($queryUser);

    if ($resultUser->num_rows > 0) {
      $userRow = $resultUser->fetch_assoc();
      $_SESSION['userID'] = $userRow['userID'];
      $_SESSION['user'] = $input_userName;
      $_SESSION['logged_in'] = true;
  
      // Check user role and redirect accordingly
      if ($userRow['isAdmin'] == 'Administrator') {
          header("Location: adminCode/admin_menu.php");
      } else {
          header("Location: userCode/user_menu.php");
      }
  } else {
      echo "User not found.";
  }
  die();
  }
}
?>
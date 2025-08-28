<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to let the admin moderate the chat room.
 *
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php'); 

// Initialize $chatRoomID to avoid undefined variable warning
$chatRoomID = "";

// Check if the form is submitted to select a chat room
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectedRoom'])) {
    $chatRoomID = $_POST['selectedRoom'];
}

// Check if the chat room exists; if not, create it
$checkChatRoomQuery = $conn->prepare("SELECT * FROM Chat WHERE CRoom_ID = ?");
$checkChatRoomQuery->bind_param("s", $chatRoomID);
$checkChatRoomQuery->execute();
$resultChatRoom = $checkChatRoomQuery->get_result();

if ($resultChatRoom->num_rows == 0) {
    // Chat room doesn't exist; create it
    $createChatRoomQuery = $conn->prepare("INSERT INTO Chat (CRoom_ID) VALUES (?)");
    $createChatRoomQuery->bind_param("s", $chatRoomID);

    if ($createChatRoomQuery->execute() !== TRUE) {
        echo "Error creating chat room: " . $conn->error;
        exit();
    }

    $createChatRoomQuery->close();
}

$checkChatRoomQuery->close();

// Check if the form is submitted to delete a message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteMessage'])) {
    $messageID = $_POST['deleteMessage'];

    // Use prepared statement to delete the message
    $deleteQuery = $conn->prepare("DELETE FROM Post WHERE postID = ?");
    $deleteQuery->bind_param("s", $messageID);

    if ($deleteQuery->execute() === TRUE) {
        echo "Message deleted successfully.";
    } else {
        echo "Error: " . $deleteQuery->error;
    }

    $deleteQuery->close();
}

// Retrieve messages from the database
$queryMessages = "SELECT postID, PAction, userName FROM Post
                  JOIN User ON Post.userID = User.userID
                  WHERE CRoom_ID = '$chatRoomID'";

$resultMessages = $conn->query($queryMessages);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Moderate Chat Room</title>
    <!-- Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Moderate Chat Room</h1>

        <!-- Chat room selection form -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="selectedRoom">Select Chat Room:</label>
            <select name="selectedRoom" id="selectedRoom" required>
                <!-- Populate this with existing chat rooms -->
                <option value="1">Chat Room 1</option>
                <option value="2">Chat Room 2</option>
                <option value="3">Chat Room 3</option>
                <option value="4">Chat Room 4</option>
                <option value="5">Chat Room 5</option>
            </select>
            <button type="submit" class="btn btn-primary">Enter Chat Room</button>
        </form>

        <!-- Display existing messages -->
        <div>
            <h2>Messages</h2>
            <?php
            if ($resultMessages->num_rows > 0) {
                while ($row = $resultMessages->fetch_assoc()) {
                    echo "<p><strong>" . $row['userName'] . ":</strong> " . $row['PAction'] . "</p>";
                    // Form to delete a message
                    echo "<form method='post' action='{$_SERVER['PHP_SELF']}'>";
                    echo "<input type='hidden' name='deleteMessage' value='{$row['postID']}'>";
                    echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                    echo "</form>";
                }
            } else {
                echo "No messages in the chat room.";
            }
            ?>
        </div>

        <!-- Link to return to the admin menu -->
        <a href="admin_menu.php">Back to Admin Menu</a><br>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

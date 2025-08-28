<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to provide the user with the chat room to talk with other users.
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

// Check if the form is submitted to post a new message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $userID = $_SESSION['userID'];
    $message = $_POST['message'];

    // Use prepared statement to insert the message
    $query = $conn->prepare("INSERT INTO Post (CRoom_ID, userID, PAction) VALUES (?, ?, ?)");
    $query->bind_param("sss", $chatRoomID, $userID, $message);

    if ($query->execute() === TRUE) {
        // Redirect to refresh the page and display the new message
        header("Location: chat_room.php");
        exit();
    } else {
        echo "Error: " . $query->error;
    }

    $query->close();
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
    <title>Chat Room</title>
    <!-- Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Chat Room</h1>

        <!-- Chat room selection form -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="selectedRoom">Select Chat Room:</label>
            <select name="selectedRoom" id="selectedRoom" required>
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
                }
            } else {
                echo "No messages in the chat room.";
            }
            ?>
        </div>

        <!-- Form to post a new message -->
        <div>
            <h2>Post a Message</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="newMessage">Message:</label>
                    <textarea class="form-control" id="newMessage" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Message</button>
            </form>
        </div>

        <!-- Link to return to the user menu -->
        <a href="user_menu.php">Back to User Menu</a><br>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

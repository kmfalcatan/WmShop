<?php
session_start();

include('../ConnectionDB/connection.php');

function getRole($receiverID) {
    global $conn;

    $sql = "SELECT Role FROM College WHERE CollegeID = ? UNION SELECT Role FROM Admin WHERE AdminID = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ii", $receiverID, $receiverID);
    $stmt->execute();

    $stmt->bind_result($role);

    $stmt->fetch();

    $stmt->close();

    return $role;
}

function saveMessage($receiverID, $role, $message) {
    global $conn;

    $senderID = $_SESSION['StudentID'];
    $senderRole = 'Student';

    $sql = "INSERT INTO Message (ReceiverID, Role, Message, SenderID, SenderRole) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issss", $receiverID, $role, $message, $senderID, $senderRole);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }

    $stmt->close();
}


function sendMessage($receiverID, $message) {
    $role = getRole($receiverID);

    if ($role && saveMessage($receiverID, $role, $message)) {
        echo "<script>alert('Message sent successfully.');</script>";
    } else {
        echo "<script>alert('Error sending message.');</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiverID = $_POST['CollegeID'] ?? $_POST['AdminID'] ?? null;
    $message = $_POST['message'] ?? null;

    if ($receiverID) {
        $role = getRole($receiverID);
    }
    if ($receiverID && $message && isset($role)) {
        sendMessage($receiverID, $message);
    } else {
        echo "Error: Missing required parameters.";
        echo "<script>alert('Error: Missing required parameters.');</script>";
    }
}

if (isset($_SESSION['StudentID'])) {
    $_SESSION['SenderID'] = $_SESSION['StudentID'];
    $senderID = $_SESSION['SenderID'];
} else {
    $senderID = 'default_sender_id';
}


if (isset($_GET['CollegeID'])) {
    $receiverID = $_GET['CollegeID'];
    $role = getRole($receiverID);
} elseif (isset($_GET['AdminID'])) {
    $receiverID = $_GET['AdminID'];
    $role = getRole($receiverID);
} else {
    $role = 'default_role';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
    <link rel='stylesheet' href='../assets/css/message.css'>
</head>
<body>
    <div class='container'>
        <div class='chatContainer' style='display: block;'>
            <div class='subChatContainer'>
                <div class='studentChatContainer'>
                    <div class='backContainer' style=' width: 30rem;' onclick='toggleSubContainer(event)'>
                        <a href="../userPanel/message.php">
                            <img class='backIcon' src='../assets/img/chevron-left (1).png' alt=''>
                        </a>
                    </div>
                    <?php
include('../ConnectionDB/connection.php');
if (isset($_GET['CollegeID'])) {
    $CollegeID = $_GET['CollegeID'];
    $Role = getRole($CollegeID);
    $query = "SELECT Message FROM Message WHERE SenderRole = '$role' AND SenderID = '$receiverID' AND Role = 'Student' AND ReceiverID = '$senderID' ORDER BY MessageId DESC";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='studentChat'><p class='chat'>" . $row['Message'] . "</p></div>";
        }
    } else {
        echo "<div class='studentChat'><p class='chat'>No messages found</p></div>";
    }
} elseif (isset($_GET['AdminID'])) {
    $AdminID = $_GET['AdminID'];
    $Role = getRole($AdminID);
    $query = "SELECT Message FROM Message WHERE SenderRole = '$role' AND SenderID = '$receiverID' AND Role = 'Student' AND ReceiverID = '$senderID' ORDER BY MessageId DESC";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='studentChat'><p class='chat'>" . $row['Message'] . "</p></div>";
        }
    } else {
        echo "<div class='studentChat'><p class='chat'>No messages found</p></div>";
    }
}

?>

                    
                    <?php
                    include('../ConnectionDB/connection.php');

                    $query = "SELECT Message FROM Message WHERE SenderID = '$senderID' AND SenderRole = 'Student' AND ReceiverID = '$receiverID' AND Role = '$role' ORDER BY MessageId DESC";

                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='adminChat'><p class='chat'>" . $row['Message'] . "</p></div>";
                        }
                    } else {
                        echo "<div class='adminChat'><p class='chat'>No messages found</p></div>";
                    }

                    ?>

                </div>
                <div class='chatBarContainer'>
                    <form action='' method='post' class='chatBarContainer' id='messageForm'>
                        <?php
                        if (isset($_GET['CollegeID'])) {
                            $CollegeID = $_GET['CollegeID'];
                            echo "<input type='hidden' name='CollegeID' value='$CollegeID'>";
                            $Role = getRole($CollegeID);
                        } elseif (isset($_GET['AdminID'])) {
                            $AdminID = $_GET['AdminID'];
                            echo "<input type='hidden' name='AdminID' value='$AdminID'>";
                            $Role = getRole($AdminID);
                        }
                        ?>
                        <input type='hidden' name='Role' value='<?php echo $Role; ?>'>
                        <div class='subChatBarContainer'>
                            <textarea class='chatBar' name='message' id='message' cols='30' rows='10'></textarea>
                        </div>
                        <div class='sendContainer'>
                            <input type='submit' value='Send' class='sendIcon' name='submit'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

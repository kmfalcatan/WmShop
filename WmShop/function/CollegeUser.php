<?php
include('../ConnectionDB/connection.php');

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == "Delete") {
        $CollegeID = $_POST['CollegeID'];
        $sql = "DELETE FROM College WHERE CollegeID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $CollegeID);

        if ($stmt->execute()) {
            echo "<script>alert('College deleted successfully.');</script>";
        } else {
            echo "<script>alert('Error deleting seller: ');</script>" . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
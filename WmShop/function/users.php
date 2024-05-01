<?php
include('../ConnectionDB/connection.php');

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == "Delete") {
        $studentID = $_POST['StudentID'];
        $sql = "DELETE FROM Student WHERE StudentID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentID);

        if ($stmt->execute()) {
            echo "<script>alert('Student deleted successfully.');</script>";
        } else {
            echo "<script>alert('Error deleting seller: ');</script>" . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
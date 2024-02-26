<?php

// Start the session if it's not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../ConnectionDB/connection.php');

// Check if 'StudentID' is set in the session
if (!isset($_SESSION['StudentID']) || empty($_SESSION['StudentID'])) {
    // Redirect to login page if StudentID is not set
   // header('location: /Crimson Mart1/logIn_logOut/loginStudent/loginStudent.php');
    //exit();
}

$StudentID = $_SESSION['StudentID'];

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM Student WHERE StudentID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $StudentID);
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Close the prepared statement
$stmt->close();

// ... (continue with your code)
?>

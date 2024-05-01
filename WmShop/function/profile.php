<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../ConnectionDB/connection.php');

if (!isset($_SESSION['StudentID']) || empty($_SESSION['StudentID'])) {
}

$StudentID = $_SESSION['StudentID'];

$sql = "SELECT * FROM Student WHERE StudentID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $StudentID);
$stmt->execute();

$result = $stmt->get_result();

$stmt->close();

?>

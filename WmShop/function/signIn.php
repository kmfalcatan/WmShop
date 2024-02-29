<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $Email = trim($_POST["Email"]); // Assuming Email is used as the username
    $Password = trim($_POST["Password"]);

    // Your database connection logic here
    include('../ConnectionDB/connection.php');

    // Check admins table
    $sqlAdmins = "SELECT * FROM Admin WHERE Email=? AND Password=?";
    $stmtAdmins = $conn->prepare($sqlAdmins);
    $stmtAdmins->bind_param("ss", $Email, $Password);
    $stmtAdmins->execute();
    $resultAdmins = $stmtAdmins->get_result();

    if ($resultAdmins->num_rows > 0) {
        // Admin login successful, set Role and redirect to admin page
        $_SESSION['Role'] = 'Admin';
        header("Location: ../adminPanel/dashboard.php");
        exit();
    }

    // Check users table
    $sqlUsers = "SELECT * FROM Student WHERE Email=? AND Password=?";
    $stmtUsers = $conn->prepare($sqlUsers);
    $stmtUsers->bind_param("ss", $Email, $Password);
    $stmtUsers->execute();
    $resultUsers = $stmtUsers->get_result();

    if ($resultUsers->num_rows > 0) {
        // User login successful, set Role and College, then redirect to user page
        $userRow = $resultUsers->fetch_assoc();
        $_SESSION['Role'] = 'Student';
        $_SESSION['StudentID'] = $userRow['StudentID'];
        $_SESSION['College'] = $userRow['College']; // Assuming College is the column in the Student table
        header("Location: ../userPanel/userhomePage.php");
        exit();
    }

    // Check colleges table
    $sqlColleges = "SELECT * FROM College WHERE Email=? AND Password=?";
    $stmtColleges = $conn->prepare($sqlColleges);
    $stmtColleges->bind_param("ss", $Email, $Password);
    $stmtColleges->execute();
    $resultColleges = $stmtColleges->get_result();

    if ($resultColleges->num_rows > 0) {
        // College login successful, set Role and CollegeID, then redirect to college page
        $collegeRow = $resultColleges->fetch_assoc();
        $_SESSION['Role'] = 'College';
        $_SESSION['CollegeID'] = $collegeRow['CollegeID'];
        $_SESSION['College'] = $collegeRow['College'];
        header("Location: ../collegePanel/collegeDashboard.php");
        exit();
    }

    // If no match found, redirect to an error page or handle accordingly
    echo "wrong Password or Email";
    exit();

    $conn->close();
}
?>

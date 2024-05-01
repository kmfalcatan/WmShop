<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = trim($_POST["Email"]);
    $Password = trim($_POST["Password"]);

    include('../ConnectionDB/connection.php');

    $sqlAdmins = "SELECT * FROM Admin WHERE Email=? AND Password=?";
    $stmtAdmins = $conn->prepare($sqlAdmins);
    $stmtAdmins->bind_param("ss", $Email, $Password);
    $stmtAdmins->execute();
    $resultAdmins = $stmtAdmins->get_result();

    if ($resultAdmins->num_rows > 0) {
        $_SESSION['Role'] = 'Admin';
        header("Location: ../adminPanel/dashboard.php");
        exit();
    }

    $sqlUsers = "SELECT * FROM Student WHERE Email=? AND Password=?";
    $stmtUsers = $conn->prepare($sqlUsers);
    $stmtUsers->bind_param("ss", $Email, $Password);
    $stmtUsers->execute();
    $resultUsers = $stmtUsers->get_result();

    if ($resultUsers->num_rows > 0) {
        $userRow = $resultUsers->fetch_assoc();
        $_SESSION['Role'] = 'Student';
        $_SESSION['StudentID'] = $userRow['StudentID'];
        $_SESSION['College'] = $userRow['College'];
        header("Location: ../userPanel/userhomePage.php");
        exit();
    }

    $sqlColleges = "SELECT * FROM College WHERE Email=? AND Password=?";
    $stmtColleges = $conn->prepare($sqlColleges);
    $stmtColleges->bind_param("ss", $Email, $Password);
    $stmtColleges->execute();
    $resultColleges = $stmtColleges->get_result();

    if ($resultColleges->num_rows > 0) {
        $collegeRow = $resultColleges->fetch_assoc();
        $_SESSION['Role'] = 'College';
        $_SESSION['CollegeID'] = $collegeRow['CollegeID'];
        $_SESSION['Email'] = $collegeRow['Email'];
        $_SESSION['FirstName'] = $collegeRow['FirstName'];
        $_SESSION['LastName'] = $collegeRow['LastName'];
        $_SESSION['College'] = $collegeRow['College'];
        header("Location: ../collegePanel/collegeDashboard.php");
        exit();
    }

    echo "<script>alert('wrong Password or Email');</script>";
    exit();

    $conn->close();
}
?>

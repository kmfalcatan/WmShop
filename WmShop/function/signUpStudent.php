<?php
session_start();

$message = '';

function showAlert($message) {
    echo "<script>alert('$message');</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $middleName = $_POST["middleName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $contactNo = $_POST["contactNo"];
    $college = $_POST["college"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    
    if ($password !== $confirmPassword) {
        echo "<script>alert('Error: Passwords do not match');</script>";
        exit();
    }

    if (!endsWith($email, "@wmsu.edu.ph")) {
        echo "<script>alert('Error: Email must have the domain @wmsu.edu.ph');</script>";
        header('location: ../authetication/signUp.php');
    }

    $hashedPassword = $password;

    include('../ConnectionDB/connection.php');

    $checkEmailQuery = "SELECT COUNT(*) as count FROM PendingStudent WHERE Email = '$email'";
    $checkResult = $conn->query($checkEmailQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();
        $emailCount = $row['count'];

        if ($emailCount > 0) {
            echo "<script>alert('Error: Email is already registered');</script>";
        } else {
            $sql = "INSERT INTO PendingStudent (FirstName, LastName, MiddleName, Email, Address, ContactNo, College, Password, Role)
                    VALUES ('$firstName', '$lastName', '$middleName', '$email', '$address', '$contactNo', '$college', '$hashedPassword', 'Student')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('A new record was successfully created. Waiting for approval, it will send you an email to notify you that your account has been approved.');</script>";
            } else {
                echo "<script>alert('Error: ');</script>" . $conn->error;
            }
        }
    } else {
        echo "<script>alert('Error checking email: ');</script>" . $conn->error;
    }

    $checkResult->close();
    $conn->close();
}
function endsWith($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
}
?>

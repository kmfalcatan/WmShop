<?php
session_start();

$message = '';

function showAlert($message) {
    echo "<script>alert('$message');</script>";
}

function endsWith($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
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
    
$contactNoMaxLength = 15;
if (strlen($contactNo) > $contactNoMaxLength) {
    echo "<script>alert(Error: Contact number exceeds the maximum length allowed');</script>";
    exit();
}


    if ($password !== $confirmPassword) {
        echo "<script>alert('Error: Passwords do not match');</script>";
        exit();
    }

    if (!endsWith($email, "@gmail.com")) {
        echo "<script>alert('Error: Email must have the domain @gmail.com');</script>";
        exit();
    }

    $hashedPassword = $password;
    
    include('../ConnectionDB/connection.php');

    $checkEmailQuery = "SELECT COUNT(*) as count FROM College WHERE Email = '$email'";
    $checkResult = $conn->query($checkEmailQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();
        $emailCount = $row['count'];

        if ($emailCount > 0) {
            echo "<script>alert('Error: Email is already registered');</script>";
        } else {
            $sql = "INSERT INTO College (FirstName, LastName, MiddleName, Email, Address, ContactNo, College, Password, Role)
                    VALUES ('$firstName', '$lastName', '$middleName', '$email', '$address', '$contactNo', '$college', '$hashedPassword', 'College')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('New record created successfully');</script>";
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
?>

<?php
session_start();

$message = '';
$AdminID = '1';
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
        showAlert("Error: Passwords do not match");
        exit();
    }

    if (!endsWith($email, "@wmsu.edu.ph")) {
        showAlert("Error: Email must have the domain @wmsu.edu.ph");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    include('../ConnectionDB/connection.php');

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkEmailQuery = "SELECT COUNT(*) as count FROM College WHERE Email = '$email'";
    $checkResult = $conn->query($checkEmailQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();
        $emailCount = $row['count'];

        if ($emailCount > 0) {
            echo "<script>alert('Error: Email is already registered');</script>";
        } else {
            $sql = "INSERT INTO College (AdminID, FirstName, LastName, MiddleName, Email, Address, ContactNo, College, Password, Role)
                    VALUES ('$AdminID', '$firstName', '$lastName', '$middleName', '$email', '$address', '$contactNo', '$college', '$hashedPassword', 'College')";

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

function endsWith($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
}
?>

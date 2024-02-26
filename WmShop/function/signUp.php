<?php
session_start();

$message = '';

function showAlert($message) {
    echo "<script>alert('$message');</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $middleName = $_POST["middleName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $contactNo = $_POST["contactNo"];
    $college = $_POST["college"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    
    // You might want to perform additional validation and sanitation here

    // Check if passwords match
    if ($password !== $confirmPassword) {
        showAlert("Error: Passwords do not match");
        exit();
    }

    // Check if the email has the required domain
    if (!endsWith($email, "@wmsu.edu.ph")) {
        showAlert("Error: Email must have the domain @wmsu.edu.ph");
        exit();
    }

    // Hash the password before storing in the database
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashedPassword = $password;

    // Database connection details
    
    include('../ConnectionDB/connection.php');

    // Your SQL query to check if the email already exists in the Student table
    $checkEmailQuery = "SELECT COUNT(*) as count FROM PendingStudent WHERE Email = '$email'";
    $checkResult = $conn->query($checkEmailQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();
        $emailCount = $row['count'];

        if ($emailCount > 0) {
            showAlert("Error: Email is already registered");
        } else {
            // Your SQL query to insert data into the PendingStudent table
            $sql = "INSERT INTO PendingStudent (FirstName, LastName, MiddleName, Email, Address, ContactNo, College, Password, Role)
                    VALUES ('$firstName', '$lastName', '$middleName', '$email', '$address', '$contactNo', '$college', '$hashedPassword', 'Student')";

            if ($conn->query($sql) === TRUE) {
                showAlert("New record created successfully");
            } else {
                showAlert("Error: " . $conn->error);
            }
        }
    } else {
        showAlert("Error checking email: " . $conn->error);
    }

    // Close the check result
    $checkResult->close();
    $conn->close();
}

// Helper function to check if a string ends with another string
function endsWith($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
}
?>

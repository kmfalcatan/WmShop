<?php
include('../ConnectionDB/connection.php');

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$adminID = '1';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $PendingStudentID = $_POST['PendingStudentID'];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $middleName = $_POST["middleName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $contactNo = $_POST["contactNo"];
    $college = $_POST["college"];
    $password = $_POST["password"];
    $role = $_POST['role'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM PendingStudent WHERE PendingStudentID = ? AND role = 'Student'");
    $stmt->bind_param("s", $PendingStudentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Hash the password
        //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedPassword = $password;

        if ($_POST['action'] == "Accept") {
            // Insert into the student table using prepared statement
            $stmt = $conn->prepare("INSERT INTO Student (adminID, firstName, lastName, middleName, email, address, contactNo, college, password, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssss", $adminID, $firstName, $lastName, $middleName, $email, $address, $contactNo, $college, $hashedPassword, $role);

            if ($stmt->execute()) {
                // Delete from the pending_account table
                $stmt = $conn->prepare("DELETE FROM PendingStudent WHERE PendingStudentID = ?");
                $stmt->bind_param("s", $PendingStudentID);

                if ($stmt->execute()) {
                    $message = "User '$firstName $lastName' approved successfully.";
                } else {
                    $message = "Error deleting pending account: " . $stmt->error;
                }
            } else {
                $message = "Error inserting into student table: " . $stmt->error;
            }
        } elseif ($_POST['action'] == "Denied") {
            // Delete from the pending_account table using prepared statement
            $stmt = $conn->prepare("DELETE FROM PendingStudent WHERE PendingStudentID = ?");
            $stmt->bind_param("s", $PendingStudentID);

            if ($stmt->execute()) {
                $message = "User '$firstName $lastName' declined successfully.";
            } else {
                $message = "Error declining pending account: " . $stmt->error;
            }
        }
    } else {
        $message = "Invalid PendingStudentID or role.";
    }

    // Close the prepared statement
    $stmt->close();
}

$conn->close();
?>

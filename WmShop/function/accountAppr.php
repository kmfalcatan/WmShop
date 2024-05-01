<?php
include('../send.email.php');
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

    $stmt = $conn->prepare("SELECT * FROM PendingStudent WHERE PendingStudentID = ? AND role = 'Student'");
    $stmt->bind_param("s", $PendingStudentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $hashedPassword = $password;

        if ($_POST['action'] == "Accept") {
            $stmt = $conn->prepare("INSERT INTO Student (adminID, firstName, lastName, middleName, email, address, contactNo, college, password, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssss", $adminID, $firstName, $lastName, $middleName, $email, $address, $contactNo, $college, $hashedPassword, $role);

            if ($stmt->execute()) {
                $stmt = $conn->prepare("DELETE FROM PendingStudent WHERE PendingStudentID = ?");
                $stmt->bind_param("s", $PendingStudentID);

                if ($stmt->execute()) {
                    echo "<script>alert('User '$firstName $lastName' approved successfully.');</script>";
                } else {
                    echo "<script>alert('Error deleting pending account: ');</script>" . $stmt->error;
                }
            } else {
                echo "<script>alert('Error inserting into student table: ');</script>" . $stmt->error;
            }
        } elseif ($_POST['action'] == "Denied") {
            $stmt = $conn->prepare("DELETE FROM PendingStudent WHERE PendingStudentID = ?");
            $stmt->bind_param("s", $PendingStudentID);

            if ($stmt->execute()) {
                echo "<script>alert('User '$firstName $lastName' declined successfully.');</script>";
            } else {
                echo "<script>alert('Error declining pending account: ');</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid PendingStudentID or role.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<?php
include('../ConnectionDB/connection.php');

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === "delete") {
        $WmsuItemID = $_POST['WmsuItemID'];

        $checkSql = "SELECT * FROM WmsuItem WHERE WmsuItemID = $WmsuItemID";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows > 0) {
            $deleteSql = "DELETE FROM WmsuItem WHERE WmsuItemID = $WmsuItemID";
            if ($conn->query($deleteSql) === true) {
                header("location: ../adminPanel/dashboard.php");
                exit;
            } else {
                echo "Error deleting item: " . $conn->error;
            }
        } else {
            echo "Item not found. Delete operation failed.";
        }
    }
}
?>

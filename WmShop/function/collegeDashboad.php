<?php
include('../ConnectionDB/connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === "delete") {
        $CollegeItemID = $_POST['CollegeItemID'];

        $stmt = $conn->prepare("SELECT * FROM CollegeItem WHERE CollegeItemID = ?");
        $stmt->bind_param("i", $CollegeItemID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $deleteSql = "DELETE FROM CollegeItem WHERE CollegeItemID = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("i", $CollegeItemID);

            if ($stmt->execute()) {
                echo "<script>alert('Item deleted successfully.');</script>";
                header("location: ../collegePanel/collegeDashboard.php");
                exit;
            } else {
                echo "<script>alert('Error deleting item: ');</script>" . $stmt->error;
            }
        } else {
            echo "<script>alert('Item not found. Delete operation failed.');</script>";
        }
    }
}
?>

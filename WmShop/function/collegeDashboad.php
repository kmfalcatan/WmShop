<?php
include('../ConnectionDB/connection.php');

// ... (rest of your PHP code)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === "delete") {
        $CollegeItemID = $_POST['CollegeItemID'];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM CollegeItem WHERE CollegeItemID = ?");
        $stmt->bind_param("i", $CollegeItemID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Item found, proceed with deletion
            $deleteSql = "DELETE FROM CollegeItem WHERE CollegeItemID = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("i", $CollegeItemID);

            if ($stmt->execute()) {
                // Item deleted successfully
                echo "Item deleted successfully.";
                header("location: ../adminPanel/dashboard.php");
                exit;
            } else {
                echo "Error deleting item: " . $stmt->error;
            }
        } else {
            // Item not found
            echo "Item not found. Delete operation failed.";
        }
    }
}

// ... (rest of your HTML code)
?>

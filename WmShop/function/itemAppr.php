<?php
include('../ConnectionDB/connection.php');

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$CollegeID = '1';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $PendingItemID = $_POST['PendingItemID'];
    $CollegeID = $_POST['CollegeID'];
    $itemImage = $_POST["ItemImage"];
    $itemName = $_POST["ItemName"];
    $price = $_POST["Price"];
    $quantity = $_POST["Quantity"];
    $small = $_POST["Small"];
    $medium = $_POST["Meduim"];
    $large = $_POST["Large"];
    $xl = $_POST["XL"];
    $xxl = $_POST["XXL"];
    $xxxl = $_POST["XXXL"];
    $college = $_POST["College"];
    $typesOfItem = $_POST["TypesOfItem"];
    $description = $_POST["Description"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM PendingItem WHERE PendingItemID = ?");
    $stmt->bind_param("s", $PendingItemID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($_POST['action'] == "Accept") {
            // Insert into the CollegeItem table using prepared statement
            $stmt = $conn->prepare("INSERT INTO CollegeItem (CollegeID, ItemImage, ItemName, Price, Quantity, Small, Meduim, Large, XL, XXL, XXXL, College, TypesOfItem, Description) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("issiiiiiiiisss", $CollegeID, $itemImage, $itemName, $price, $quantity, $small, $medium, $large, $xl, $xxl, $xxxl, $college, $typesOfItem, $description);

            if ($stmt->execute()) {
                // Delete from the PendingItem table
                $stmt = $conn->prepare("DELETE FROM PendingItem WHERE PendingItemID = ?");
                $stmt->bind_param("s", $PendingItemID);

                if ($stmt->execute()) {
                    $message = "Item '$itemName' approved successfully.";
                } else {
                    $message = "Error deleting pending item: " . $stmt->error;
                }
            } else {
                $message = "Error inserting into CollegeItem table: " . $stmt->error;
            }
        } elseif ($_POST['action'] == "Denied") {
            // Delete from the PendingItem table using prepared statement
            $stmt = $conn->prepare("DELETE FROM PendingItem WHERE PendingItemID = ?");
            $stmt->bind_param("s", $PendingItemID);

            if ($stmt->execute()) {
                $message = "Item '$itemName' declined successfully.";
            } else {
                $message = "Error declining pending item: " . $stmt->error;
            }
        }
    } else {
        $message = "Invalid PendingItemID.";
    }

    // Close the prepared statement
    $stmt->close();
}

$conn->close();
?>

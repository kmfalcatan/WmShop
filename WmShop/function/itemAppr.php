<?php
include('../ItemConfig.php');
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
    $Email = $_POST['Email'];
    $CollegeName = $_POST['CollegeName'];
    $itemImage = $_POST["ItemImage"];
    $itemName = $_POST["ItemName"];
    $price = $_POST["Price"];
    $quantity = $_POST["Quantity"];
    $college = $_POST["College"];
    $typesOfItem = $_POST["TypesOfItem"];
    $description = $_POST["Description"];

    $stmt = $conn->prepare("SELECT * FROM PendingItem WHERE PendingItemID = ?");
    $stmt->bind_param("s", $PendingItemID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($_POST['action'] == "Accept") {
            $stmt = $conn->prepare("INSERT INTO CollegeItem (CollegeID, ItemImage, ItemName, Price, Quantity, College, TypesOfItem, Description, Email, CollegeName) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("issiisssss", $CollegeID, $itemImage, $itemName, $price, $quantity, $college, $typesOfItem, $description, $Email, $CollegeName);

            if ($stmt->execute()) {
                $stmt = $conn->prepare("DELETE FROM PendingItem WHERE PendingItemID = ?");
                $stmt->bind_param("s", $PendingItemID);

                if ($stmt->execute()) {
                    echo "<script>alert('Item '$itemName' approved successfully.');</script>";
                } else {
                    echo "<script>alert('Error deleting pending item: ');</script>" . $stmt->error;
                }
            } else {
                echo "<script>alert('Error inserting into CollegeItem table: ');</script>" . $stmt->error;
            }
        } elseif ($_POST['action'] == "Denied") {
            $stmt = $conn->prepare("DELETE FROM PendingItem WHERE PendingItemID = ?");
            $stmt->bind_param("s", $PendingItemID);

            if ($stmt->execute()) {
                echo "<script>alert('Item '$itemName' declined successfully.');</script>";
            } else {
                echo "<script>alert('Error declining pending item:');</script>" . $stmt->error;
            }
        }
    } else {
        echo "<script>alert('Invalid PendingItemID.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

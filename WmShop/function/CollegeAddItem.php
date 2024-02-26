<?php
session_start(); // Start the session
include('../ConnectionDB/connection.php');

$AdminID = '1'; // Assuming you still want to set AdminID to '1', you might adjust this based on your logic

// Check if the CollegeID session variable is set
if (isset($_SESSION['CollegeID'])) {
    $CollegeID = $_SESSION['CollegeID']; // Get CollegeID from the session
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $ItemImage = $_FILES['ItemImage']['name'];
        $ItemName = $_POST['ItemName'];
        $Description = $_POST['Description'];
        $Quantity = isset($_POST['Quantity']) ? (int)$_POST['Quantity'] : 0;
        $Price = $_POST['Price'];
        $Small = isset($_POST['Small']) ? (int)$_POST['Small'] : 0;
        $Meduim = isset($_POST['Meduim']) ? (int)$_POST['Meduim'] : 0;
        $Large = isset($_POST['Large']) ? (int)$_POST['Large'] : 0;
        $XL = isset($_POST['XL']) ? (int)$_POST['XL'] : 0;
        $XXL = isset($_POST['XXL']) ? (int)$_POST['XXL'] : 0;
        $XXXL = isset($_POST['XXXL']) ? (int)$_POST['XXXL'] : 0;
        $TypesOfItem = $_POST['TypesOfItem'];
        $College = $_POST['College'];

        $fileType = pathinfo($ItemImage, PATHINFO_EXTENSION);
        if ($fileType != 'jpg' && $fileType != 'jpeg' && $fileType != 'png') {
            echo"Only JPG, JPEG, or PNG files are allowed.";
        } else {
            $target_directory = 'C:\Program1\xampp\htdocs\WmShop-main\WmShop\assets\img\uploadPicture_';
            $target_file = $target_directory . basename($ItemImage);

            if (move_uploaded_file($_FILES['ItemImage']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO PendingItem (AdminID, ItemName, Quantity, Price, Small, Meduim, Large, XL, XXL, XXXL, ItemImage, Description, TypesOfItem, College, CollegeID)
                VALUES ('$AdminID', '$ItemName', '$Quantity', '$Price', '$Small', '$Meduim', '$Large', '$XL', '$XXL', '$XXXL', '$ItemImage', '$Description', '$TypesOfItem', '$College', '$CollegeID')";
                
                if ($conn->query($sql) === TRUE) {
                    echo"Image uploaded successfully and data saved in the database.";
                } else {
                    echo"Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo"Failed to upload the image.";
            }
        }
    }
} else {
    echo"CollegeID not set. Please make sure the user is logged in.";
}
?>

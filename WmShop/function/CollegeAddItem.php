<?php
session_start();
include('../ConnectionDB/connection.php');

$AdminID = '1';

if (isset($_SESSION['CollegeID'])) {
    $CollegeID = $_SESSION['CollegeID'];
    $CollegeName = $_SESSION['FirstName'] . ' ' . $_SESSION['LastName'];
    $Email = $_SESSION['Email'];
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
            $target_directory = 'C:\xampp\htdocs\WmShop-mainF\WmShop\assets\img\uploadPicture_';
            $target_file = $target_directory . basename($ItemImage);

            if (move_uploaded_file($_FILES['ItemImage']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO PendingItem (AdminID, ItemName, Quantity, Price, Small, Meduim, Large, XL, XXL, XXXL, ItemImage, Description, TypesOfItem, College, CollegeID, Email, CollegeName)
        VALUES ('$AdminID', '$ItemName', '$Quantity', '$Price', '$Small', '$Meduim', '$Large', '$XL', '$XXL', '$XXXL', '$ItemImage', '$Description', '$TypesOfItem', '$College', '$CollegeID', '$Email', '$CollegeName')";

                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Your item has been successfully saved; just wait for the approval of the admin..');</script>";
                } else {
                    echo "<script>alert('Error: ');</script>" . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Failed to upload the image.');</script>";
            }
        }
    }
} else {
    echo "<script>alert('CollegeID not set. Please make sure the user is logged in.');</script>";
}
?>

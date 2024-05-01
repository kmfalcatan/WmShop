<?php
include('../ConnectionDB/connection.php');

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$AdminID = '1';
$message = '';
if (isset($_POST['submit'])) {
  $ItemImage = $_FILES['ItemImage']['name'];
  $ItemName = $_POST['ItemName'];
  $Description = $_POST['Description'];
  $Quantity = $_POST['Quantity'];
  $Price = $_POST['Price'];
  $TypesOfItem = $_POST['TypesOfItem'];
  $College = $_POST['College'];

  $fileType = pathinfo($ItemImage, PATHINFO_EXTENSION);
  if ($fileType != 'jpg' && $fileType != 'jpeg' && $fileType != 'png') {
      $message = "Only JPG, JPEG, or PNG files are allowed.";
  }else {
    $target_directory = 'C:\xampp\htdocs\WmShop-mainF\WmShop\assets\img\uploadPicture_';
    $target_file = $target_directory . basename($ItemImage);

    if (move_uploaded_file($_FILES['ItemImage']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO WmsuItem (AdminID, ItemName, Quantity, Price, ItemImage, Description, TypesOfItem, College)
        VALUES ('$AdminID', '$ItemName', '$Quantity', '$Price', '$ItemImage', '$Description', '$TypesOfItem', '$College')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Image uploaded successfully and data saved in the database.');</script>";
        } else {
            echo "<script>alert('Error: ');</script>" . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Failed to upload the   image.');</script>";
    }
}
}
?>
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
      $message = "Only JPG, JPEG, or PNG files are allowed.";
  }else {
    $target_directory = 'C:\Program1\xampp\htdocs\WmShop-main\WmShop\assets\img\uploadPicture_';
    $target_file = $target_directory . basename($ItemImage);

    if (move_uploaded_file($_FILES['ItemImage']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO WmsuItem (AdminID, ItemName, Quantity, Price, Small, Meduim, Large, XL, XXL, XXXL, ItemImage, Description, TypesOfItem, College)
        VALUES ('$AdminID', '$ItemName', '$Quantity', '$Price', '$Small', '$Meduim', '$Large', '$XL', '$XXL', '$XXXL', '$ItemImage', '$Description', '$TypesOfItem', '$College')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Image uploaded successfully and data saved in the database.";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Failed to upload the   image.";
    }
}
}
?>
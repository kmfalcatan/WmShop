<?php
include('../ConnectionDB/connection.php');

if (isset($_POST['CartID'])) {
    $CartID = $_POST['CartID'];

    $deleteSql = "DELETE FROM Cart WHERE CartID = '$CartID'";
    $conn->query($deleteSql);

    $conn->close();
}else{
    echo "<script>alert('you can not delete this item because your order is still on going');</script>";
}
?>

<?php
include('../ConnectionDB/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $WmsuItemID = $_POST["WmsuItemID"];
    $ItemName = $_POST["ItemName"];
    $Price = $_POST["Price"];
    $Quantity = $_POST["Quantity"];
    $Small = $_POST["Small"];
    $Medium = $_POST["Medium"];
    $Large = $_POST["Large"];
    $XL = $_POST["XL"];
    $XXL = $_POST["XXL"];
    $XXXL = $_POST["XXXL"];

    $sql = "UPDATE WmsuItem SET 
            ItemName = '$ItemName',
            Price = $Price,
            Quantity = $Quantity,
            Small = $Small,
            Medium = $Medium,
            Large = $Large,
            XL = $XL,
            XXL = $XXL,
            XXXL = $XXXL
            WHERE WmsuItemID = $WmsuItemID";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Item updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating item: ');</script>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<?php
include('../ConnectionDB/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
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

    // Perform the database update query
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

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating item: " . mysqli_error($conn);
    }
}

// Close the database connection if you opened one
mysqli_close($conn);
?>
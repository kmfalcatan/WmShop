<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/viewOrders.css'>
</head>
<body>
<?php
include('../ConnectionDB/connection.php');

    if (isset($_GET['MyOrderID'])) {
        $MyOrderID = $_GET['MyOrderID'];
    $orderSql = "SELECT * FROM MyOrder WHERE MyOrderID = $MyOrderID"; 
    $orderResult = $conn->query($orderSql);

    if ($orderResult->num_rows > 0) {
        while ($orderRow = $orderResult->fetch_assoc()) {
            $MyOrderID = $orderRow['MyOrderID'];
            $UserName = $orderRow['UserName'];
            $ItemImage = $orderRow['ItemImage'];
            $ItemName = $orderRow['ItemName'];
            $Quantity = $orderRow['Quantity'];
            $TotalPrice = $orderRow['TotalPrice'];
            $Size = $orderRow['Size'];
            $Status = $orderRow['Status'];
            $Payment = $orderRow['Payment'];
    echo"<div class='container'>
        <div class='subContainer'>
            <div class='imageContainer'>
                <div class='subImageContainer'>
                    <div class='slideshow-container'>
                        <div class='mySlides'>
                          <img class='image' src='../assets/img/$ItemImage' alt='Image 1'>
                        </div>
                      </div>
                </div>
            </div>

            <div class='infoContianer'>
                <div class='subInfoContainer'>
                    <p class='inputInfo'>$UserName</p>
                </div>

                <div class='subInfoContainer'>
                    <p class='inputInfo'>$ItemName</p>
                </div>

                <div class='subInfoContainer'>
                    <p class='inputInfo'>$Quantity</p>
                    <p class='inputInfo'>₱ $TotalPrice</p>
                    <p class='inputInfo'>$Size</p>
                </div>

                <div class='subInfoContainer'>
                    <p class='inputInfo'>$Payment</p>
                </div>

                <div class='editButtonContainer'>
                    <a href='../collegePanel/orders.php'>
                        <button class='editButton'>Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>";
}
}
} else {
echo "<p>No orders found.</p>";
}

$conn->close();
?>

    <script src='../assets/js/viewDashboard.js'></script>
</body>
</html>
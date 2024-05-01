<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/myOrder.css'>
</head>
<body>
    <div class='container'>
        <div class='subContainer'>
            <div class='subContainer1'>
                <div class='orderContainer'>
                <?php
                include('../ConnectionDB/connection.php');
        session_start();

        if (!isset($_SESSION['StudentID'])) {
        } else {
            $StudentId = $_SESSION['StudentID'];

            $orderSql = "SELECT * FROM MyOrder WHERE StudentID = '$StudentId'";
            $orderResult = $conn->query($orderSql);

            if ($orderResult->num_rows > 0) {
                while ($orderRow = $orderResult->fetch_assoc()) {
                    $ItemImage = $orderRow['ItemImage'];
                    $ItemName = $orderRow['ItemName'];
                    $Quantity = $orderRow['Quantity'];
                    $Price = $orderRow['TotalPrice'];
                    $Status = $orderRow['Status'];
                    $Size = $orderRow['Size'];
                    $Payment = $orderRow['Payment'];
                    
                    echo"
                    <div class='subOrderContainer'>
                        <div class='imageContainer'>
                            <div class='subImageContainer'>
                                <img class='image' src='../assets/img/$ItemImage' alt=''>
                            </div>
                        </div>

                        <div class='statusContainer'>
                            <div class='subStatusContainer'>
                                <div class='itemNameContainer'>
                                    <p>$ItemName</p>
                                </div>

                                <div class='quantityContainer'>
                                    <p>Quantity: $Quantity</p>
                                </div>

                                <div class='quantityContainer'>
                                    <p>Total price: $Price</p>
                                </div>
                            </div>

                            <div class='subStatusContainer'>
                                <div class='itemNameContainer'>
                                    <p><span class='status'>Status: $Status</span></p>
                                </div>

                                <div class='quantityContainer'>
                                    <p>Size: $Size</p>
                                </div>

                                <div class='quantityContainer'>
                                    <p>Payment method: $Payment</p>
                                </div>
                            </div>
                        </div>
                    </div>";
        }
    } else {
        echo "<p>No orders found.</p>";
    }
}

$conn->close();
?>

</div>
</div>
            <div class='backContainer'>
                <a href='../userPanel/userhomePage.php'>
                    <button class='backButton'>Back</button>
                </a>
            </div>
        </div>
    </div>

    <script src='../assets/js/myOrder.js'></script>
</body>
</html>
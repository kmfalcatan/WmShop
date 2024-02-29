<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/orders.css'>
    <link rel='stylesheet' href='../assets/css/dashboard.css'>
</head>
<body>
    <div class='container1'>
        <div class='headerContainer'>
            <div class='subHeaderContainer'>
                <div class='imageContainer'>
                    <div class='subImageContainer'>
                        <img class='image' src='../assets/img/wmsuLogo.png' alt=''>
                    </div>

                    <div class='nameContainer'>
                        <p class='companyName'>WmShop</p>
                    </div>
                </div>

                <div class='profileContainer'>
                    <div class='subProfileContainer'>
                        <img class='image1' src='../assets/img/notification.png' alt=''>
                    </div>

                    <div class='subProfileContainer'>
                        <img class='image1' src='../assets/img/chat-lines.png' alt=''>
                    </div>

                    <div class='subProfileContainer'>
                        <div class='menubarContainer' onclick='toggleMenu(this)'>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='line'></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('sidebar.php'); ?>
        </div>
    </div>

    

    <div class='container2'>
                <div class='subContainer2'>
                <div class='itemContainer'>
    <?php
include('../ConnectionDB/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateStatus'])) {
    $MyOrderID = $_POST['MyOrderID'];
    $Status = $_POST['Status'];

    if ($Status == 'Order complete') {
        // Fetch order details
        $orderSql = "SELECT * FROM MyOrder WHERE MyOrderID = ?";
        $stmtOrder = $conn->prepare($orderSql);
        $stmtOrder->bind_param("i", $MyOrderID);
        $stmtOrder->execute();
        $orderResult = $stmtOrder->get_result();

        if ($orderResult->num_rows > 0) {
            $orderRow = $orderResult->fetch_assoc();

            $insertSql = "INSERT INTO Transaction (AdminID, UserName, ItemName, Quantity, TotalPrice, Size, ItemImage, Description, Status, date)
                          VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmtInsert = $conn->prepare($insertSql);
            $stmtInsert->bind_param("ssiiisss", $orderRow['UserName'], $orderRow['ItemName'], $orderRow['Quantity'], $orderRow['TotalPrice'], $orderRow['Size'], $orderRow['ItemImage'], $orderRow['Description'], $Status);

            if ($stmtInsert->execute()) {
                $deleteSql = "DELETE FROM MyOrder WHERE MyOrderID = ?";
                $stmtDelete = $conn->prepare($deleteSql);
                $stmtDelete->bind_param("i", $MyOrderID);

                if ($stmtDelete->execute() !== true) {
                    echo "Error deleting from my_order: " . $stmtDelete->error;
                }
            } else {
                echo "Error inserting into history: " . $stmtInsert->error;
            }
        }

        $stmtOrder->close();
        $stmtInsert->close();
        $stmtDelete->close();
    } elseif($Status == 'Cancel order'){
        $orderSql = "SELECT * FROM MyOrder WHERE MyOrderID = ?";
        $stmtOrder = $conn->prepare($orderSql);
        $stmtOrder->bind_param("i", $MyOrderID);
        $stmtOrder->execute();
        $orderResult = $stmtOrder->get_result();

        if ($orderResult->num_rows > 0) {
            $orderRow = $orderResult->fetch_assoc();

            $insertSql = "INSERT INTO CancelOrderTransaction (AdminID, UserName, ItemName, Quantity, TotalPrice, Size, ItemImage, Description, Status, date)
                          VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmtInsert = $conn->prepare($insertSql);
            $stmtInsert->bind_param("ssiiisss", $orderRow['UserName'], $orderRow['ItemName'], $orderRow['Quantity'], $orderRow['TotalPrice'], $orderRow['Size'], $orderRow['ItemImage'], $orderRow['Description'], $Status);

            if ($stmtInsert->execute()) {
                $deleteSql = "DELETE FROM MyOrder WHERE MyOrderID = ?";
                $stmtDelete = $conn->prepare($deleteSql);
                $stmtDelete->bind_param("i", $MyOrderID);

                if ($stmtDelete->execute() !== true) {
                    echo "Error deleting from my_order: " . $stmtDelete->error;
                }
            } else {
                echo "Error inserting into history: " . $stmtInsert->error;
            }
        }

        $stmtOrder->close();
        $stmtInsert->close();
        $stmtDelete->close();
    } else {
        $updateSql = "UPDATE MyOrder SET Status = ? WHERE MyOrderID = ?";
        $stmtUpdate = $conn->prepare($updateSql);
        $stmtUpdate->bind_param("si", $Status, $MyOrderID);

        if ($stmtUpdate->execute() !== true) {
            echo "Error updating Status: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();
    }
}

$orderSql = "SELECT * FROM MyOrder WHERE AdminID = 1";
$stmtOrderList = $conn->prepare($orderSql);
$stmtOrderList->execute();
$orderResult = $stmtOrderList->get_result();

if ($orderResult->num_rows > 0) {
    while ($orderRow = $orderResult->fetch_assoc()) {
        $UserName = $orderRow['UserName'];
        $ItemImage = $orderRow['ItemImage'];
        $ItemName = $orderRow['ItemName'];
        $MyOrderID = $orderRow['MyOrderID'];
        $Status = $orderRow['Status'];
                echo "
                        <div class='subItemContainer'>
                            <div class='imageContainer2'>
                                <a class='subImageContainer2' href='../adminPanel/viewOrders.php?MyOrderID=$MyOrderID'>
                                    <div class='subImageContainer2'>
                                        <img class='image6' src='../assets/img/" . $ItemImage . "' alt=''>
                                    </div>
                                </a>
                            </div>

                            <div class='infoContainer'>
                                <div class='subInfoContainer'>
                                    <p>$UserName</p>
                                </div>

                                <div class='subInfoContainer'>
                                    <p>$ItemName</p>
                                </div>
                                
                                <div class='subInfoContainer'>
                                    <p>$Status</p>
                                </div>
                            </div>

                            <div class='updateContainer'>
                                <div class='subUpdateContainer'>
                                    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                                        <input type='hidden' name='MyOrderID' value='$MyOrderID'>
                                        <select class='update' name='Status'>
                                            <option value='' " . ($Status == '' ? 'selected' : '') . ">Choose</option>
                                            <option value='Preparing order' " . ($Status == 'Preparing order' ? 'selected' : '') . ">Preparing order</option>
                                            <option value='Ready to pick up' " . ($Status == 'Ready to pick up' ? 'selected' : '') . ">Ready to pick up</option>
                                            <option value='Order complete' " . ($Status == 'Order complete' ? 'selected' : '') . ">Order complete</option>
                                            <option value='Cancel order' " . ($Status == 'Cancel order' ? 'selected' : '') . ">Cancel order</option>
                                        </select>
                                </div>

                                <div class='subUpdateContainer'>
                                    <button class='update' type='submit' name='updateStatus'>Update Status</button>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
} else {
    echo "<p>No orders found.</p>";
}

$stmtOrderList->close();
$conn->close();
?>
</div>
</div>
</div>

<script src="../assets/js/dashboard.js"></script>
</body>
</html>

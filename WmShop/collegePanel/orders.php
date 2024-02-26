<?php
session_start();

// Check if CollegeID is not set, redirect to login page
if (!isset($_SESSION['CollegeID'])) {
    header("Location: ../authentication/signIn.php");
    exit;
}

// Rest of your existing code goes here
include('../ConnectionDB/connection.php');
// ... (rest of the code)
?>

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
            
            <?php include('../collegePanel/sideBar.php') ?>
        </div>
    </div>

    <div class='container2'>
                            <div class='subContainer2'>
                                <div class='itemContainer'>
                                    
    <?php
        include('../ConnectionDB/connection.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateStatus'])) {
            $CollegeID = $_SESSION['CollegeID'];
            $Status = $_POST['Status'];
            $MyOrderID = $_POST['MyOrderID'];

            if ($Status == 'Order complete' || $Status == 'Cancel order') {
                // Fetch order details
                $orderSql = "SELECT * FROM MyOrder WHERE MyOrderID = $MyOrderID";
                $orderResult = $conn->query($orderSql);

                if ($orderResult->num_rows > 0) {
                    $orderRow = $orderResult->fetch_assoc();

                    $insertSql = "INSERT INTO CollegeTransaction (CollegeID, UserName, ItemName, Quantity, TotalPrice, Size, ItemImage, Description, Status, date)
                          VALUES ($CollegeID, '" . $orderRow['UserName'] . "', '" . $orderRow['ItemName'] . "', " . $orderRow['Quantity'] . ", " . $orderRow['TotalPrice'] . ", '" . $orderRow['Size'] . "', '" . $orderRow['ItemImage'] . "', '" . $orderRow['Description'] . "', '$Status', NOW())";

                    if ($conn->query($insertSql) === true) {
                        $deleteSql = "DELETE FROM MyOrder WHERE MyOrderID = $MyOrderID";
                        if ($conn->query($deleteSql) !== true) {
                            echo "Error deleting from my_order: " . $conn->error;
                        }
                    } else {
                        echo "Error inserting into history: " . $conn->error;
                    }
                }
            } else {
                $updateSql = "UPDATE MyOrder SET Status = '$Status' WHERE MyOrderID = $MyOrderID";

                if ($conn->query($updateSql) !== true) {
                    echo "Error updating Status: " . $conn->error;
                }
            }
        }

        if (isset($_SESSION['CollegeID'])) {
            $CollegeID = $_SESSION['CollegeID'];
            $orderSql = "SELECT * FROM MyOrder WHERE CollegeID = $CollegeID";
            $orderResult = $conn->query($orderSql);

            if ($orderResult->num_rows > 0) {
                while ($orderRow = $orderResult->fetch_assoc()) {
                    $UserName = $orderRow['UserName'];
                    $ItemImage = $orderRow['ItemImage'];
                    $ItemName = $orderRow['ItemName'];
                    $MyOrderID = $orderRow['MyOrderID'];
                    $Status = $orderRow['Status'];

                    echo "<div class='subItemContainer'>
                                        <div class='imageContainer2'>
                                            <a class='subImageContainer2' href='../adminPanel/viewOrders.php'>
                                                <div class='subImageContainer2'>
                                                    <img class='image6' src='$ItemImage' alt=''>
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
                                            <form class='updateContainer' method='POST'>
                                                <div class='subUpdateContainer'>
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
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                }
            } else {
                echo "<p>No orders found.</p>";
            }
        } else {
            echo "<p>No seller session found.</p>";
            // Redirect or handle the case when CollegeID is not found in the session
        }

        $conn->close();
    ?>
    
    </div>
                            </div>
                        </div>

<script src="../assets/js/dashboard.js"></script>
</body>
</html>

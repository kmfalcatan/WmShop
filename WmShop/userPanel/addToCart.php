<?php
session_start();

include('../ConnectionDB/connection.php');


?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/addToCart.css'>
    <link rel='stylesheet' href='../assets/css/dashboard.css'>
    <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
</head>
<body>
    <div class='container1'>
        <div class='headerContainer'>
            <div class='subHeaderContainer'>
                <div class='imageContainer'>
                    <div class='subImageContainer'>
                        <a href='../userPanel/userhomePage.php'>
                            <img class='image1' src='../assets/img/chevron-left (1).png' alt=''>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class='container2'>
        <form method='post' action=''  class='container2'>
        <div class='subContainer2' style='width: 90%;'>
             <div class='cartItemContainer'>

             <?php

include('../ConnectionDB/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    if (isset($_SESSION['StudentID'])) {
        $StudentID = $_SESSION['StudentID'];
        $totalPrice = 0;

        if (isset($_POST['WmsuItemID']) && is_array($_POST['WmsuItemID'])) {
            foreach ($_POST['WmsuItemID'] as $selectedItemCartID) {
                $cartSql = "SELECT * FROM Cart WHERE StudentID = '$StudentID' AND CartID = '$selectedItemCartID'";
                $cartResult = $conn->query($cartSql);

                if ($cartResult->num_rows > 0) {
                    while ($cartRow = $cartResult->fetch_assoc()) {
                        $CartID = $cartRow['CartID'];
                        $WmsuItemID = $cartRow['WmsuItemID'];
                        $CollegeItemID = $cartRow['CollegeItemID'];
                        $UserName = $cartRow['UserName'];
                        $ItemName = $cartRow['ItemName'];
                        $ItemImage = $cartRow['ItemImage'];
                        $Quantity = $cartRow['Quantity'];
                        $TotalPrice = $cartRow['TotalPrice'];
                        $Size = $cartRow['Size'];
                        $CollegeID = isset($cartRow['CollegeID']) ? $cartRow['CollegeID'] : 0;
                        $AdminID = isset($cartRow['AdminID']) ? $cartRow['AdminID'] : 0;
                        $Description = $cartRow['Description'];

                        $totalPrice += $TotalPrice * $Quantity;

                        $insertOrderSql = "INSERT INTO PlaceOrder (CartID, AdminID, CollegeID, WmsuItemID, CollegeItemID, UserName, ItemName, Quantity, TotalPrice, Size, ItemImage, Description, StudentID) 
                                          VALUES ('$CartID', '$AdminID', '$CollegeID', '$WmsuItemID', '$CollegeItemID', '$UserName', '$ItemName', '$Quantity', '$TotalPrice', '$Size', '$ItemImage', '$Description', '$StudentID')";
                        $conn->query($insertOrderSql);
                    }
                }
            }
            echo "<script>alert('Items checked out successfully!')</script>";
            header("location: ../userPanel/placeOrder.php");
        } else {
            echo "<script>alert('No items selected for checkout!')</script>";
        }
    } else {
        echo "<script>alert('Session not set. Please login first!')</script>";
    }
}

if (isset($_SESSION['StudentID'])) {
    $StudentID = $_SESSION['StudentID'];

$cartSql = "SELECT * FROM Cart WHERE StudentID = '$StudentID'";
$cartResult = $conn->query($cartSql);

if ($cartResult->num_rows > 0) {
    while ($cartRow = $cartResult->fetch_assoc()) {
        $CartID = $cartRow['CartID'];
        $WmsuItemID = $cartRow['WmsuItemID'];
        $CollegeItemID = $cartRow['CollegeItemID'];
        $UserName = $cartRow['UserName'];
        $ItemName = $cartRow['ItemName'];
        $ItemImage = $cartRow['ItemImage'];
        $Quantity = $cartRow['Quantity'];
        $TotalPrice = $cartRow['TotalPrice'];
        $Size = $cartRow['Size'];
        $CollegeID = isset($cartRow['CollegeID']) ? $cartRow['CollegeID'] : 0;
        $AdminID = isset($cartRow['AdminID']) ? $cartRow['AdminID'] : 0;
        $Description = $cartRow['Description'];

        echo "
        <div class='subCartItemContainer'>
            <div class='checkBoxContainer'>
                <input class='checkBox' type='checkbox' name='WmsuItemID[]' value='$CartID' data-cart-id='$CartID' data-price='$TotalPrice' data-quantity='$Quantity' data-item-name='$ItemName' data-size='$Size' data-item-picture='$ItemImage' data-description='$Description'>
                <input type='hidden' value='$WmsuItemID'>
                <input type='hidden' value='$CollegeItemID'>
                <input type='hidden' value='$CollegeID'>
                <input type='hidden' value='$AdminID'>
            </div>
        
            <div class='imageContainer2'>
                <div class='subImageContainer2'>
                    <img class='image6' src='../assets/img/$ItemImage' alt=''>
                </div>
            </div>
        
            <div class='itemInfoContainer'>
                <div class='subItemInfoContainer'>
                    <p class='itemName'>$ItemName</p>
                </div>
        
                <div class='subItemInfoContainer'>
                    <p class='itemName' id='quantity'>Quantity: $Quantity</p>
                </div>
        
                <div class='subItemInfoContainer'>
                    <p class='itemName' id='price'>Price:₱ $TotalPrice</p>
                </div>
        
                <div class='subItemInfoContainer'>
                    <p class='itemName'>Size: $Size</p>
                </div>
            </div>
        
            <div class='checkBoxContainer'>
                <img class='deleteIcon' data-cart-id='$CartID' src='../assets/img/delete (1).png' alt=''>
            </div>
        </div>";
        
            }
            }
        }
             else {
            echo "<script>alert('No items in the cart');</script>";
            }
            
            
            $conn->close();
            ?>
             </div>

             <div class='checkOutContainer' id='totalPrice'>
                <p>Total price: ₱<span>0</span></p>

                <a href='../userPanel/placeOrder.php'>
                    <button class='viewButton' type='submit' name='checkout'>Checkout</button>
                </a>
             </div>
        </div>
        </form>
    </div>

    <script src='../assets/js/addToCart.js'></script>
</body>
</html>

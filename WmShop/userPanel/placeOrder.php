<?php
include('../ConnectionDB/connection.php');

session_start();

$totalPrice = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['place_order'])) {
        $StudentID = $_SESSION['StudentID'];
        $paymentMethod = $_POST['payment_method'];
        
        $moveToMyOrderSql = "INSERT INTO MyOrder (StudentID, WmsuItemID, CollegeItemID, UserName, ItemName, ItemImage, Quantity, TotalPrice, Size, Description, AdminID, CollegeID, Status, Payment)
                            SELECT StudentID, WmsuItemID, CollegeItemID, UserName, ItemName, ItemImage, Quantity, TotalPrice, Size, Description, AdminID, CollegeID, 'Pending', '$paymentMethod'
                            FROM PlaceOrder WHERE StudentID = '$StudentID'";
        if ($conn->query($moveToMyOrderSql) === TRUE) {
            $deleteCartSql = "DELETE FROM PlaceOrder WHERE StudentID = '$StudentID'";
            if ($conn->query($deleteCartSql) === TRUE) {
                echo "<script>alert('Order placed successfully.')</script>";
                header("Location: ../userPanel/myOrder.php");
            } else {
                echo "<script>alert('Error deleting record: ');</script>" . $conn->error;
            }
        } else {
            echo "<script>alert('Error:');</script>" . $moveToMyOrderSql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['cancel_order'])) {
        $StudentID = $_SESSION['StudentID'];
        
        $deleteCartSql = "DELETE FROM PlaceOrder WHERE StudentID = '$StudentID'";
        if ($conn->query($deleteCartSql) === TRUE) {
            header("location: ../userPanel/addToCart.php");
        } else {
            echo "<script>alert('Error deleting record: ');</script>" . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/placeOrder.css'>
    <link rel='stylesheet' href='../assets/css/dashboard.css'>
    <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AcJFnvAxTdmwFShSqvXW6hBNKLDTSVhvCPkLxqOZf35NPgZzHAtKWClE-QFAGEwjkO8fGohTMF7lRIWs&currency=PHP"></script>
</head>
<body>
    <div class='container1'>
        <div class='headerContainer'>
            <div class='subHeaderContainer'>
                <div class='imageContainer'>

                    <div class='nameContainer'>
                        <p class='companyName'>Place order</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='container2'>
        <div class='subContainer2'>
             <div class='cartItemContainer'>

             <?php

if (isset($_SESSION['StudentID'])) {
    $StudentID = $_SESSION['StudentID'];

    $cartSql = "SELECT * FROM PlaceOrder WHERE StudentID = '$StudentID'";
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
            $Price = $cartRow['TotalPrice'];
            $TotalPrice = $Quantity * $Price;
            $Size = $cartRow['Size'];
            $CollegeID = !empty($cartRow['CollegeID']) ? $cartRow['CollegeID'] : 0;
            $AdminID = !empty($cartRow['AdminID']) ? $cartRow['AdminID'] : 0;
            $Description = $cartRow['Description'];

            $totalPrice += $TotalPrice;

            echo "
            <div class='subCartItemContainer'>
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
                        <p class='itemName' id='price'>Price: $Price</p>
                    </div>
            
                    <div class='subItemInfoContainer'>
                        <p class='itemName'>Size: $Size</p>
                    </div>

                    <div class='subItemInfoContainer'>
                        <p class='itemName'>Total Price:₱ $TotalPrice</p>
                    </div>
                </div>
            </div>";
        }
    } else {
        echo "<p>No items in the cart</p>";
    }
} else {
    echo "<p>User session not set</p>";
}

$conn->close();
?>

             </div>

             <div class='paymentContainer'> 
                <div class='subPaymentContainer'>
                    <p>Payment option:</p>
                </div>

                <div class='paymentButtoonContainer'>
                    <form style="
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;" method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                        <select class='paymentButton' name='payment_method' id=''>
                            <option value=''>Choose payment method</option>
                            <option value='Cash on delivery'>Cash on delivery</option>
                        </select>
                        <button type='submit' name='place_order' class='viewButton'>Place order</button>
                    </form>
                    <div id="paypal-button-container"></div>
                </div>
             </div>

             <div class='checkOutContainer'>
                <p>Total price:₱ <?php echo $totalPrice; ?></p>

                <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                    <button type='submit' name='cancel_order' class='viewButton'>Back</button>
                </form>
             </div>
        </div>
    </div>

    <script>
        paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?php echo $totalPrice; ?>'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            var formData = new FormData();
            formData.append('place_order', 'true');
            formData.append('payment_method', 'Paypal');
            fetch('<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
}).render('#paypal-button-container');

    </script>
</body>
</html>

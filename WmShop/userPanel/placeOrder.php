<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/placeOrder.css'>
    <link rel='stylesheet' href='../assets/css/dashboard.css'>
</head>
<body>
    <div class='container1'>
        <div class='headerContainer'>
            <div class='subHeaderContainer'>
                <div class='imageContainer'>
                    <div class='subImageContainer'>
                        <a href='../userPanel/addToCart.php'>
                            <img class='image' src='../assets/img/chevron-left (1).png' alt=''>
                        </a>
                    </div>

                    <div class='nameContainer'>
                        <p class='companyName'>WmShop</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='container2'>
        <div class='subContainer2'>
             <div class='cartItemContainer'>
                <div class='subCartItemContainer'>
                    <div class='imageContainer2'>
                        <div class='subImageContainer2'>
                            <img class='image6' src='' alt=''>
                        </div>
                    </div>

                    <div class='itemInfoContainer'>
                        <div class='subItemInfoContainer'>
                            <p class='itemName'>Item name:</p>
                        </div>

                        <div class='subItemInfoContainer'>
                            <p class='itemName'>Quantity:</p>
                        </div>

                        <div class='subItemInfoContainer'>
                            <p class='itemName'>Price:</p>
                        </div>

                        <div class='subItemInfoContainer'>
                            <p class='itemName'>Size:</p>
                        </div>
                    </div>
                </div>
             </div>

             <div class='paymentContainer'> 
                <div class='subPaymentContainer'>
                    <p>Payment option:</p>
                </div>

                <div class='paymentButtoonContainer'>
                    <select class='paymentButton' name='' id=''>
                        <option value=''>Choose payment method</option>
                        <option value=''>Cash of pick up</option>
                        <option value=''>Paypal</option>
                    </select>
                </div>
             </div>

             <div class='checkOutContainer'>
                <p>Total price:</p>

                <button class='viewButton'>Place order</button>
             </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/addToCart.css'>
    <link rel='stylesheet' href='../assets/css/dashboard.css'>
</head>
<body>
    <div class='container1'>
        <div class='headerContainer'>
            <div class='subHeaderContainer'>
                <div class='imageContainer'>
                    <div class='subImageContainer'>
                        <a href='../userPanel/userhomePage.php'>
                            <img class='image' src='../assets/img/chevron-left (1).png' alt=''>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='container2'>
        <div class='subContainer2'>
             <div class='cartItemContainer'>
                <div class='subCartItemContainer'>
                    <div class='checkBoxContainer'>
                        <input class='checkBox' type='checkbox'>
                    </div>

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

                    <div class='checkBoxContainer'>
                        <img class='deleteIcon' src='../assets/img/delete (1).png' alt=''>
                    </div>
                </div>
             </div>

             <div class='checkOutContainer'>
                <p>Total price:</p>

                <a href='../userPanel/placeOrder.php'>
                    <button class='viewButton'>Checkout</button>
                </a>
             </div>
        </div>
    </div>
</body>
</html>
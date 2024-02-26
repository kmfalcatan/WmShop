<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/userHomePage.css'>
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

                <div class='profileContainer'>
                    <a href='../userPanel/notification.php'>
                        <div class='subProfileContainer'>
                            <img class='image1' src='../assets/img/notification.png' alt=''>
                        </div>
                    </a>

                    <a href='/userPanel/message.php'>
                        <div class='subProfileContainer'>
                            <img class='image1' src='../assets/img/chat-lines.png' alt=''>
                        </div>
                    </a>

                    <a href='/userPanel/addToCart.php'>
                        <div class='subProfileContainer'>
                            <img class='image1' src='../assets/img/cart-2.png' alt=''>
                        </div>
                    </a>

                    <div class='subProfileContainer'>
                        <div class='menubarContainer' onclick='toggleMenu(this)'>
                            <div class='line'></div>
                            <div class='line'></div>
                            <div class='line'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='searchBarContainer'>
        <input class='searchBar' type='text' placeholder='Search item..' id='searchInput' oninput='filterItems()'>
    </div>

    <div class='container'  id='itemContainer'>
        <div class='itemContainer'>
            <div class='subContainer'>
                <div class='imageContainer1'>
                    <img class='imageItem' src='' alt=''>
                </div>
    
                <div class='itemInfoContainer'>
                    <div class='subItemInfoContainer'>
                        <div class='itemNameContainer'>
                            <p class='itemName'>Dept Shirt</p>
                            <p class='itemName'>Price: 500</p>
                        </div>
    
                        <div class='viewButtonContainer'>
                            <button class='viewButton'>View</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class='viewIconContainer'>
                <div class='subViewIconContainer'>
                    <a href='../userPanel/viewItem.php'>
                        <div class='viewIcon'>
                            <img class='icon' src='../assets/img/view-icon-symbol-sign-vector-removebg-preview.png' alt=''>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class='itemContainer'>
            <div class='subContainer'>
                <div class='imageContainer1'>
                    <img class='imageItem' src='' alt=''>
                </div>
    
                <div class='itemInfoContainer'>
                    <div class='subItemInfoContainer'>
                        <div class='itemNameContainer'>
                            <p class='itemName'>Dept Shirt</p>
                            <p class='itemName'>Price: 500</p>
                        </div>
    
                        <div class='viewButtonContainer'>
                            <button class='viewButton'>View</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class='viewIconContainer'>
                <div class='subViewIconContainer'>
                    <a href=''>
                        <div class='viewIcon'>
                            <img class='icon' src='../assets/img/view-icon-symbol-sign-vector-removebg-preview.png' alt=''>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src='../assets/js/dashboard.js'></script>
    <script src='../assets/js/userhomePage.js'></script>
</body>
</html>
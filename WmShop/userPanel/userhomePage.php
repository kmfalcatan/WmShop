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

    <link rel='stylesheet' href='../assets/css/userHomePage.css'>
</head>
<body>
    <div class='container1'>
        <div class='headerContainer'>
            <div class='subHeaderContainer'>
                <div class='imageContainer'>
                    <div class='subImageContainer'>
                        <img class='image7' src='../assets/img/wmsuLogo.png' alt=''>
                    </div>

                    <div class='nameContainer'>
                        <p class='companyName'>WmShop</p>
                    </div>
                </div>

                <div class='profileContainer'>
                    <a href='../userPanel/message.php'>
                        <div class='subProfileContainer'>
                            <img class='image1' src='../assets/img/chat-lines.png' alt=''>
                        </div>
                    </a>

                    <a href='../userPanel/addToCart.php'>
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
            <?php include('sideBar.php'); ?>
        </div>
    </div>

    <div class='searchBarContainer'>
        <input class='searchBar' type='text' placeholder='Search item..' id='searchInput' oninput='filterItems()'>
    </div>

    <div class='filterContainer'>
        <div class='subFilterContainer'>
            <a href='../userPanel/filterItem.php'>
                <img class='filterImage' src='../assets/img/th-removebg-preview.png' alt=''>
            </a>
        </div>

        <div class='subFilterContainer'>
            <a href='../userPanel/jacket.php'>
                <img class='filterImage' src='../assets/img/sports_jacket-512.png' alt=''>
            </a>
        </div>

        <div class='subFilterContainer'>
            <a href='../userPanel/t-shirt.php'>
                <img class='filterImage' src='../assets/img/6148418.png' alt=''>
            </a>
        </div>

        <div class='subFilterContainer'>
            <a href='../userPanel/lanyard.php'>
                <img class='filterImage' src='../assets/img/pngtree-lanyard-design-vector-id-card-template-png-image_7328968.png' alt=''>
            </a>
        </div>

        <div class='subFilterContainer'>
            <a href='../userPanel/poloShirt.php'>
                <img class='filterImage' src='../assets/img/2525520.png' alt=''>
            </a>
        </div>  

        <div class='subFilterContainer'>
            <a href='../userPanel/accessories.php'>
                <img class='filterImage' src='../assets/img/vector-men-and-women-clothes-accessories-icons-removebg-preview.png' alt=''>
            </a>
        </div>
    </div>

    <?php
include('../ConnectionDB/connection.php');

if (isset($_SESSION['College'])) {
    $college = $_SESSION['College'];

    $wmsuItemSql = "SELECT * FROM WmsuItem";
    $wmsuItemResult = $conn->query($wmsuItemSql);

    $collegeItemSql = "SELECT * FROM CollegeItem WHERE College = '$college'";
    $collegeItemResult = $conn->query($collegeItemSql);

    echo "<div class='container' id='itemContainer'>";

    if ($wmsuItemResult->num_rows > 0) {
        while ($row = $wmsuItemResult->fetch_assoc()) {
            $WmsuItemID = $row['WmsuItemID'];
            $ItemName = $row['ItemName'];
            $Price = $row['Price'];
            $ItemImage = $row['ItemImage'];
            echo "<div class='itemContainer'>";
            echo "<div class='subContainer'>";
            echo "<div class='imageContainer1'>";
            echo "<img class='imageItem' src='../assets/img/$ItemImage' alt=''>";
            echo "</div>";

            echo "<div class='itemInfoContainer'>";
            echo "<div class='subItemInfoContainer'>";
            echo "<div class='itemNameContainer'>";
            echo "<p class='itemName'>$ItemName</p>";
            echo "<p class='itemName'>Price: $Price</p>";
            echo "</div>";

            echo "<div class='viewButtonContainer'>";
            echo "<a href='../userPanel/viewItem.php?WmsuItemID=$WmsuItemID'>";
            echo "<button class='viewButton'>View</button>";
            echo "</a>";
            echo "</div>";

            echo "</div>";
            echo "</div>";
            echo "</div>";

            echo "<div class='viewIconContainer'>";
            echo "<div class='subViewIconContainer'>";
            echo "<a href='../userPanel/viewItem.php?WmsuItemID=$WmsuItemID'>";
            echo "<div class='viewIcon'>";
            echo "<img class='icon' src='../assets/img/view-icon-symbol-sign-vector-removebg-preview.png' alt=''>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }

    if ($collegeItemResult->num_rows > 0) {
        while ($row = $collegeItemResult->fetch_assoc()) {
            $CollegeItemID = $row['CollegeItemID'];
            $ItemName = $row['ItemName'];
            $Price = $row['Price'];
            $ItemImage = $row['ItemImage'];
            echo "<div class='itemContainer'>";
            echo "<div class='subContainer'>";
            echo "<div class='imageContainer1'>";
            echo "<img class='imageItem' src='../assets/img/$ItemImage' alt=''>";
            echo "</div>";

            echo "<div class='itemInfoContainer'>";
            echo "<div class='subItemInfoContainer'>";
            echo "<div class='itemNameContainer'>";
            echo "<p class='itemName'>$ItemName</p>";
            echo "<p class='itemName'>Price: $Price</p>";
            echo "</div>";

            echo "<div class='viewButtonContainer'>";
            echo "<a href='../userPanel/CollegeViewItem.php?CollegeItemID=$CollegeItemID'>";
            echo "<button class='viewButton'>View</button>";
            echo "</a>";
            echo "</div>";

            echo "</div>";
            echo "</div>";
            echo "</div>";

            echo "<div class='viewIconContainer'>";
            echo "<div class='subViewIconContainer'>";
            echo "<a href='../userPanel/CollegeViewItem.php?CollegeItemID=$CollegeItemID'>";
            echo "<div class='viewIcon'>";
            echo "<img class='icon' src='../assets/img/view-icon-symbol-sign-vector-removebg-preview.png' alt=''>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }

    echo "</div>";
} else {
    echo "<script>alert('No college user is logged in.');</script>";
}

$conn->close();
?>

    </div>
    <script src='../assets/js/dashboard.js'></script>
    <script src='../assets/js/userhomePage.js'></script>
</body>
</html>
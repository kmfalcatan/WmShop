<?php
session_start();

include('../ConnectionDB/connection.php');

// ... (rest of your PHP code)

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
            <?php include('sideBar.php'); ?>
        </div>
    </div>

    <div class='searchBarContainer'>
        <input class='searchBar' type='text' placeholder='Search item..' id='searchInput' oninput='filterItems()'>
    </div>

    <div class='container'  id='itemContainer'>
    <?php
include('../ConnectionDB/connection.php');

// Check if a user is logged in
if (isset($_SESSION['College'])) {
    $college = $_SESSION['College'];

    // Retrieve data from WmsuItem table
    $wmsuItemSql = "SELECT * FROM WmsuItem WHERE TypesOfItem = 'Department T-Shirt'";
    $wmsuItemResult = $conn->query($wmsuItemSql);

    // Retrieve data from CollegeItem table for the logged-in college
    $collegeItemSql = "SELECT * FROM CollegeItem WHERE College = '$college' AND TypesOfItem = 'Department T-Shirt'";
    $collegeItemResult = $conn->query($collegeItemSql);

    echo "<div class='container' id='itemContainer'>";

    // Display items from WmsuItem table
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

    // Display items from CollegeItem table
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
            echo "<a href='../userPanel/viewT-shirt.php?CollegeItemID=$CollegeItemID'>";
            echo "<button class='viewButton'>View</button>";
            echo "</a>";
            echo "</div>";

            echo "</div>";
            echo "</div>";
            echo "</div>";

            echo "<div class='viewIconContainer'>";
            echo "<div class='subViewIconContainer'>";
            echo "<a href='../userPanel/viewT-shirt.php?CollegeItemID=$CollegeItemID'>";
            echo "<div class='viewIcon'>";
            echo "<img class='icon' src='../assets/img/view-icon-symbol-sign-vector-removebg-preview.png' alt=''>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }

    echo "</div>"; // Close container
} else {
    echo "<p>No college user is logged in.</p>";
}

$conn->close();
?>
    </div>
    <script src='../assets/js/dashboard.js'></script>
    <script src='../assets/js/userhomePage.js'></script>
</body>
</html>
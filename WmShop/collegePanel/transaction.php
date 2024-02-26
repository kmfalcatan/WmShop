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

    <link rel='stylesheet' href='../assets/css/dashboard.css'>
    <link rel='stylesheet' href='../assets/css/accountAppr.css'>
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
            
            <?php include('sideBar.php'); ?>
        </div>
    </div>

        <div class='container'>
           <div class='searchBarContainer'>
                <input class='searchBar' type='text' placeholder='Search...' id='searchInput' oninput='filterItems()'>
           </div>

           <div class='tableContainer' id='itemContainer'>
                <table>
                    <thead>
                        <tr>
                            <th>FULL NAME</th>
                            <th>ITEM IMAGE</th>
                            <th>ITEM NAME</th>
                            <th>QUANTITY</th>
                            <th>SIZE</th>
                            <th>PRICE</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        include('../ConnectionDB/connection.php');

              if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (isset($_SESSION['CollegeID'])) {
                    $CollegeID = $_SESSION['CollegeID'];

                    $sql = "SELECT * FROM CollegeTransaction WHERE CollegeID = $CollegeID";
                    $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $userName = $row['UserName'];
                    $itemImage = $row['ItemImage'];
                    $itemName = $row['ItemName'];
                    $quantity = $row['Quantity'];
                    $size = $row['Size'];
                    $price = $row['TotalPrice'];
                        echo"<tr>
                            <td>" .$userName. "</td>";
                            echo"<td>" .$itemImage. "</td>";
                            echo"<td>" .$itemName. "</td>";
                            echo"<td>" .$quantity. "</td>";
                            echo"<td>" .$size. "</td>";
                            echo"<td>" .$price. "</td>";
                        echo"</tr>";
                    }
                  }
                }
              }
              $conn->close();
              ?>
                    </tbody>
                </table>
           </div>
        </div>
    </div>

    <script src='../assets/js/accountAppr.js'></script>
    <script src="../assets/js/search.js"></script>
</body>
</html>
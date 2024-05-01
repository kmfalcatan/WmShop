<?php
session_start();

include('../ConnectionDB/connection.php');
include('../function/collegeDashboad.php');


?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

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
                    <a href='../collegePanel/message.php'>
                        <div class='subProfileContainer'>
                            <img class='image1' src='../assets/img/chat-lines.png' alt=''>
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
            
            <?php include('../collegePanel/sideBar.php'); ?>
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
                        <th rowspan='1'>ITEM IMAGE</th>
                        <th rowspan='1'>ITEM NAME</th>
                        <th rowspan='1'>QUANTITY</th>
                        <th rowspan='1'>PRICE</th>
                        <th rowspan='1'>ACTION</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    if (isset($_SESSION['CollegeID'])) {
                        $CollegeID = $_SESSION['CollegeID'];
                        $sql = "SELECT * FROM CollegeItem WHERE CollegeID = $CollegeID";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $CollegeItemID = $row['CollegeItemID'];
                                $ItemImage = $row['ItemImage'];
                                $ItemName = $row['ItemName'];
                                $Quantity = $row['Quantity'];
                                $Price = $row['Price']; 
                                
                                echo"<td>" .$ItemName. "</td>";
                                echo"<td>
                                        <img class='image8' src='../assets/img/" .$ItemImage. "' alt=''>
                                    </td>";
                                echo"<td>" .$Quantity. "</td>";
                                echo"<td>" .$Price. "</td>";
                                echo"<td class='actionContainer'>";
                                echo"<form action='../collegePanel/editDashboard.php' method='POST'>
                                    <input type='hidden' name='CollegeItemID' value='" . $CollegeItemID . "'>
                                    <input type='hidden' name='ItemImage' value='" . $ItemImage . "'>
                                    <input type='hidden' name='ItemName' value='" . $ItemName . "'>
                                    <input type='hidden' name='Quantity' value='" . $Quantity . "'>
                                    <input type='hidden' name='Price' value='" . $Price . "'>
                                    <button class='action'>Edit</button>
                                </form>";
                                echo"<form action='' method='POST' onsubmit='return confirmDelete()'>
                                    <input type='hidden' name='CollegeItemID' value='" . $CollegeItemID . "'>
                                    <button class='action' value='delete' name='action'>Delete</button>
                                </form>
                                </td>
                                </tr>";
                            }
                        }
                    } else {
                        header("location: ../authetication/signIn.php");
                        exit;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src='../assets/js/dashboard.js'></script>

    <script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this item?');
    }
    </script>

    <script src="../assets/js/search.js"></script>
</body>
</html>

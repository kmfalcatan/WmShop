<?php include('../function/dashboard.php') ?>

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
                    <a href='../adminPanel/notification.php'>
                        <div class='subProfileContainer'>
                            <img class='image1' src='../assets/img/notification.png' alt=''>
                        </div>
                    </a>

                    <a href='../adminPanel/message.php'>
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

            <?php include('sidebar.php'); ?>
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
                            <th rowspan='2'>ITEM NAME</th>
                            <th rowspan='2'>ITEM IMAGE</th>
                            <th rowspan='2'>QUANTITY</th>
                            <th class='th4' colspan='6'>STOCKS</th>
                            <th rowspan='2'>PRICE</th>
                            <th rowspan='2'>ACTION</th>
                        </tr>

                        <tr>
                            <th>S</th>
                            <th>M</th>
                            <th>L</th>
                            <th>XL</th>
                            <th>XXL</th>
                            <th>XXXL</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        include('../ConnectionDB/connection.php');
                        
                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                            $sql = "SELECT * FROM WmsuItem";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $WmsuItemID = $row['WmsuItemID'];
                                    $ItemImage = $row['ItemImage'];
                                    $ItemName = $row['ItemName'];
                                    $Quantity = $row['Quantity'];
                                    $Small = $row['Small'];
                                    $Meduim = $row['Meduim'];
                                    $Large = $row['Large'];
                                    $XL = $row['XL'];
                                    $XXL = $row['XXL'];
                                    $XXXL = $row['XXXL'];
                                    $Price = $row['Price'];
                        echo"<tr>
                            <td>" .$ItemName. " </td>";
                            echo"<td><img class='image8' src='../assets/img/" .$ItemImage. "' alt=''></td>";
                            echo"<td>" .$Quantity. "</td>";
                            echo"<td>" .$Small. "</td>";
                            echo"<td>" .$Meduim. "</td>";
                            echo"<td>" .$Large. "</td>";
                            echo"<td>" .$XL. "</td>";
                            echo"<td>" .$XXL. "</td>";
                            echo"<td>" .$XXXL. "</td>";
                            echo"<td>" .$Price. "</td>";
                            echo"<td class='actionContainer'>";
                            echo"<form action='../adminPanel/editDashboard.php' method='POST'>
                                <input type='hidden' name='WmsuItemID' value='" . $WmsuItemID . "'>
                                <input type='hidden' name='ItemImage' value='" . $ItemImage . "'>
                                <input type='hidden' name='ItemName' value='" . $ItemName . "'>
                                <input type='hidden' name='Quantity' value='" . $Quantity . "'>
                                <input type='hidden' name='Small' value='" . $Small . "'>
                                <input type='hidden' name='Meduim' value='" . $Meduim . "'>
                                <input type='hidden' name='Large' value='" . $Large . "'>
                                <input type='hidden' name='XL' value='" . $XL . "'>
                                <input type='hidden' name='XXL' value='" . $XXL . "'>
                                <input type='hidden' name='XXXL' value='" . $XXXL . "'>
                                <input type='hidden' name='Price' value='" . $Price . "'>
                                <button class='action'>Edit</button>
                            </form>";
                            echo"<form action='' method='POST' onsubmit='return confirmDelete()'>
                                <input type='hidden' name='WmsuItemID' value='" . $WmsuItemID . "'>
                                <button class='action' value='delete' name='action'>Delete</button>
                            </form>
                            </td>
                        </tr>";
                        }
                    }
                } else {
                }
            ?>
                    </tbody>
                </table>
           </div>
        </div>
    </div>

    <script src='../assets/js/dashboard.js'></script>
    <script src="../assets/js/search.js"></script>
    <script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this item?');
    }
    </script>
</body>
</html>
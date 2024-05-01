<?php include('../function/itemAppr.php') ?>

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
                            <th rowspan='1'>NAME</th>
                            <th rowspan='1'>ITEM IMAGE</th>
                            <th rowspan='1'>ITEM NAME</th>
                            <th rowspan='1'>QUANTITY</th>
                            <th rowspan='1'>PRICE</th>
                            <th rowspan='1'>DESCRIPTION</th>
                            <th rowspan='1'>ACTION</th>
                        </tr>
                    </thead>
                    
                    <?php
                        include('../ConnectionDB/connection.php');

                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM PendingItem";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $PendingItemID = $row['PendingItemID'];
                                $CollegeName = $row['CollegeName'];
                                $CollegeID = $row['CollegeID'];
                                $itemImage = $row["ItemImage"];
                                $itemName = $row["ItemName"];
                                $price = $row["Price"];
                                $quantity = $row["Quantity"];
                                $college = $row["College"];
                                $typesOfItem = $row["TypesOfItem"];
                                $description = $row["Description"];
                                $Email = $row["Email"];
                   echo"<tbody>
                        <tr>
                            <td>" .$CollegeName. " </td>
                            <td>" .$itemName. " </td>
                            <td><img class='image8' src='../assets/img/" .$itemImage. "' alt=''></td>
                            <td>$quantity</td>
                            <td>$price</td>
                            <td>$description</td>
                            <td class='actionContainer'>
                            <form action='itemAppr.php' method='POST' onsubmit='return confirmDelete()'>
                                <input type='hidden' name='PendingItemID' value='$PendingItemID'>
                                <input type='hidden' name='CollegeID' value='$CollegeID'>
                                <input type='hidden' name='ItemImage' value='$itemImage'>
                                <input type='hidden' name='ItemName' value='$itemName'>
                                <input type='hidden' name='Price' value='$price'>
                                <input type='hidden' name='Quantity' value='$quantity'>
                                <input type='hidden' name='College' value='$college'>
                                <input type='hidden' name='TypesOfItem' value='$typesOfItem'>
                                <input type='hidden' name='Description' value='$description'>
                                <input type='hidden' name='Email' value='$Email'>
                                <input type='hidden' name='CollegeName' value='$CollegeName'>
                                <button class='action' name='action' value='Accept'>Accept</button>
                                <button class='action' name='action' value='Denied'>Denied</button>
                            </form>
                            </td>
                        </tr>
                    </tbody>";
                }
            }

            $conn->close();
            ?>
                </table>
           </div>
        </div>
    </div>

    <script src='../assets/js/dashboard.js'></script>
    <script src='../assets/js/search.js'></script>
    <script>
    function confirmDelete() {
        return confirm('Are you sure you want to denied/accept this item?');
    }
    </script>
</body>
</html>
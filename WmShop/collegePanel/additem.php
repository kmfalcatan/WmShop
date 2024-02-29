<?php include('../function/CollegeAddItem.php') ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/additem.css'>
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

            <?php include('sidebar.php'); ?>
        </div>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class='container10'>
            <div class='subContainer10'>
                <div class='imageContainer10'>
                    <div class='subImageContainer10'>
                        <div class='slideshow-container'>
                            <div id="pictureContainer" class='mySlides'>
                                <img class='image10' id='uploadedImage' src='#' alt=''>
                            </div>
                        </div>
                    </div>

                    <div class='uploadButtonCoontainer10'>
                        <input type='file' name='ItemImage' id='image' accept='image/*' class='uploadButton10'>
                    </div>
                </div>

                <div class='infoContianer10'>
                    <div class='subInfoContainer10'>
                        <input class='inputInfo10' type='text' name='ItemName' placeholder='Item Name'>
                    </div>

                    <div class='subInfoContainer10'>
                        <input class='inputInfo10' type='number' name='Price' placeholder='Price'>
                    </div>

                    <div class='stockContainer10'>
                        <div class='subStockContainer10'>
                            <p>Stocks:</p>
                        </div>

                        <div class='subInfoContainer10'>
                            <input class='inputInfo10' type='number' name='Quantity' placeholder='Quantity of accessories and etc'>
                        </div>

                        <div class='subStockContainer10'>
                            <p>Size Quantity:</p>
                        </div>

                        <div class='sizeContainer10'>
                            <input class='size' type='number' name='Small' placeholder='S'>
                            <input class='size' type='number' name='Meduim' placeholder='M'>
                            <input class='size' type='number' name='Large' placeholder='L'>
                            <input class='size' type='number' name='XL' placeholder='XL'>
                            <input class='size' type='number' name='XXL' placeholder='XXL'>
                            <input class='size' type='number' name='XXXL' placeholder='XXXL'>
                        </div>

                        <div class='subStockContainer10'>
                            <p>other information:</p>
                        </div>

                        <div class='subInfoContainer10'>
                            <?php
                            // Assuming you have a connection to the database in your connection.php file
                            include('../ConnectionDB/connection.php');

                            // Check if CollegeID is set in the session
                            if (isset($_SESSION['CollegeID'])) {
                                $CollegeID = $_SESSION['CollegeID'];

                                // Assuming you have a table named 'Colleges' with columns 'CollegeID' and 'College'
                                $sql = "SELECT CollegeID, College FROM College WHERE CollegeID = $CollegeID";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $College = $row['College'];
                                        echo "<input type='text' class='inputInfo10' name='College' value='$College' readonly>";
                                    }
                                }
                            }

                            // Close the database connection
                            $conn->close();
                            ?>
                        </div>


                        <div class='subInfoContainer10'>
                            <select name='TypesOfItem' class='inputInfo10'>
                                <option value=''>Types of item</option>
                                <option value='Uniform'>Uniform</option>
                                <option value="Lanyard">Lanyard</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Department T-Shirt">Department T-Shirt</option>
                                <option value="Department Jacket">Department Jacket</option>
                                <option value="Department Polo Shirt">Department Polo Shirt</option>
                            </select>
                        </div>

                        <div class='subStockContainer10'>
                            <p>Description:</p>
                        </div>

                        <div class='subInfoContainer10'>
                            <input class='inputInfo10' type='text' name='Description' placeholder='Description'>
                        </div>
                    </div>
                </div>

                <div class='editButtonContainer10'>
                    <button class='editButton10' type='submit' name='submit'>Add item</button>
                </div>
            </div>
        </div>
    </form>

    <script src='../assets/js/viewDashboard.js'></script>
    <script src='../assets/js/dashboard.js'></script>
    <script src='../assets/js/addItem.js'></script>
</body>
</html>

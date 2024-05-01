<?php include('../function/addItem.php') ?>

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
    <form action="" method="post" enctype="multipart/form-data">
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
                            <p>other information:</p>
                        </div>

                        <div class='subInfoContainer10'>
                            <select name='College' class='inputInfo10'>
                                <option value=''>Choose college</option>
                                <option class="department" value="College of Computing Studies">
                                    College of Computing Studies
                                </option>
                                <option class="department" value="College of Agriculture">
                                    College of Agriculture
                                </option>
                                <option class="department" value="College of Architecture">
                                    College of Architecture
                                </option>
                                <option class="department" value="College of Asian and Islamic Studies">
                                    College of Asian and Islamic Studies
                                </option>
                                <option class="department" value="College of Criminal justice Educaiton">
                                    College of Criminal justice Educaiton
                                </option>
                                <option class="department" value="College of Engineering">
                                    College of Engineering
                                </option>
                                <option class="department" value="College of Forestry and Environmental Studies">
                                    College of Forestry and Environmental Studies
                                </option>
                                <option class="department" value="College of Home Economics">
                                    College of Home Economics
                                </option>
                                <option class="department" value="College of Law">
                                    College of Law
                                </option>
                                <option class="department" value="College of Liberal Arts">
                                    College of Liberal Arts
                                </option>
                                <option class="department" value="College of Nursing">
                                    College of Nursing
                                </option>
                                <option class="department" value="College of Public Administration and Development Studies">
                                    College of Public Administration and Development Studies
                                </option>
                                <option class="department" value="College of Sports Science and Physical Education">
                                    College of Sports Science and Physical Education
                                </option>
                                <option class="department" value="College of Science and Mathematics">
                                    College of Science and Mathematics
                                </option>
                                <option class="department" value="College of Social Work and Community development">
                                    College of Social Work and Community development
                                </option>
                                <option class="department" value="College of Teacher Education">
                                    College of Teacher Education
                                </option>
                            </select>
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

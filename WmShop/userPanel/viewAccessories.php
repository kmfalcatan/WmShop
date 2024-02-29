<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/dashboard.css'>
    <link rel='stylesheet' href='../assets/css/viewItem.css'>
</head>
<body>
    <div class='container1'>
        <div class='headerContainer'>
            <div class='subHeaderContainer'>
                <div class='imageContainer'>
                    <div class='subImageContainer'>
                        <a href='../userPanel/accessories.php'>
                            <img class='image6' src='../assets/img/chevron-left (1).png' alt=''>
                        </a>
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

                    <a href='../adminPanel/message.php'>
                        <div class='subProfileContainer'>
                            <img class='image1' src='../assets/img/cart-2.png' alt=''>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
include('../ConnectionDB/connection.php');
            if (isset($_GET['CollegeItemID'])) {
                $CollegeItemID = $_GET['CollegeItemID'];
                $sql = "SELECT * FROM CollegeItem WHERE CollegeItemID = $CollegeItemID";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $ItemName = $row['ItemName'];
                        $Quantity = $row['Quantity'];
                        $Price = $row['Price'];
                        $ItemImage = $row['ItemImage'];
                        $Description = $row['Description']; 
                        $CollegeItemID = $row['CollegeItemID'];
    echo"<div class='container2'>
        <div class='subContainer2'>
            <div class='itemImageContainer'>
                <div class='subItemImageContainer'>
                    <div class='imageContainer3'>
                        <div class='slideshow-container'>
                            <div class='mySlides'>
                              <img class='image10' src='../assets/img/" .$ItemImage. "' alt='Image 1'>
                            </div>
                        </div>
                    </div>
                </div>";

                echo"<div class='infoContainer'>
                    <div class='itemNameContainer'>
                        <div class='subItemNameContainer'>
                            <p>" .$ItemName. "</p>
                        </div>";

                        echo"<div class='priceContainer'>
                            <p>Price: " .$Price. "</p>
                        </div>";

                        echo"<div class='subItemNameContainer'>
                            <select class='quantity' name='' id=''>
                                <option value=''>QUANTITY:</option>";
                                for ($i = 1; $i <= min($Quantity, 10); $i++) {
                                    echo "<option value='" . $i . "'>" . $i . "</option>";
                                }
                            echo"</select>

                            <select class='quantity' name='Size' id=''>
                                <option value=''>Size:</option>
                                <option value='S'>S</option>
                                <option value='M'>M</option>
                                <option value='L'>L</option>
                                <option value='XL'>XL</option>
                                <option value='XXL'>XXL</option>
                                <option value='XXXL'>XXXL</option>
                            </select>

                            <button class='quantity'>Message</button>
                        </div>

                        <div class='subItemNameContainer'>
                            <button type='submit' name='addToCart' class='addToCart'>Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>";

            echo"<div class='descriptionContainer'>
                <div class='subDescriptionContainer'>
                    <p>Description:</p>
                </div>

                <div class='description'>
                    <p>" .$Description. "</p>
                </div>
            </div>";

            echo"<div class='feedbackContainer'>
                <div class='subFeedbackContainer'>
                    <div class='feedback'>
                        <div class='subFeedback'>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                                Amet iusto ipsa laborum accusantium dolore sunt soluta nesciunt optio aliquam odit exercitationem porro, 
                                tenetur ducimus facilis assumenda! Iusto voluptatibus eaque nobis?
                            </p>
                        </div>

                        <div class='usernameContainer'>
                            <p>Username:</p>
                        </div>
                    </div>
                </div>

                <div class='feedbackChatContainer'>
                    <div class='chatContainer'>
                        <textarea class='chat' name='' id='' cols='30' rows='10'></textarea>
                    </div>

                    <div class='sendContainer'>
                        <img class='send' src='../assets/img/201-2016537_send-message-icon-white-clipart-computer-icons-clip.png' alt=''>
                    </div>
                </div>
            </div>
        </div>";
        
        if (isset($_POST['addToCart'])) {
            $quantityToAdd = $_POST['Quantity'];
            $Size = $_POST['Size'];
            $insertCartSql = "INSERT INTO Cart (CollegeItemID, ItemName, Quantity, Price, ItemImage, Description, StudentID, Size) 
                              VALUES ('$CollegeItemID', '$ItemName', '$quantityToAdd', '$Price', '$ItemImage', '$Description', '$StudentId', '$Size')";
            $conn->query($insertCartSql);


            echo "<p class = 'message'>Item added to the cart successfully!</p>";
        }
    }
}
}


$conn->close();
?>   

    </div>

    <script src='../assets/js/viewDashboard.js'></script>
</body>
</html>
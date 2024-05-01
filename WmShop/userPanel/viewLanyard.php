<?php
session_start();
include('../ConnectionDB/connection.php');

if (isset($_SESSION['StudentID'])) {
    $StudentID = $_SESSION['StudentID'];

    $getUserInfoSql = "SELECT FirstName, LastName FROM Student WHERE StudentID = $StudentID";
    $userInfoResult = $conn->query($getUserInfoSql);

    if ($userInfoResult->num_rows > 0) {
        $userInfo = $userInfoResult->fetch_assoc();
        $FirstName = $userInfo['FirstName'];
        $LastName = $userInfo['LastName'];

        $UserName = $FirstName . "" . $LastName;
    } else {
        $FirstName = "Guest";
        $LastName = "";
    }
} else {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['addToCart'])) {
    $quantityToAdd = $_POST['Quantity'];
    $Size = $_POST['Size'];
    $CollegeItemID = $_POST['CollegeItemID'];
    $ItemName = $_POST['ItemName'];
    $Price = $_POST['TotalPrice'];
    $ItemImage = $_POST['ItemImage'];
    $Description = $_POST['Description'];
    $AdminID = isset($_POST['AdminID']) ? $_POST['AdminID'] : 0;
    $CollegeID = isset($_POST['CollegeID']) ? $_POST['CollegeID'] : 0;
    $CollegeItemID = isset($_POST['CollegeItemID']) ? $_POST['CollegeItemID'] : 0;
    $WmsuItemID = isset($_POST['WmsuItemID']) ? $_POST['WmsuItemID'] : 0;

    $TotalPrice = (int)$Price;

    $insertCartSql = "INSERT INTO Cart (StudentID, WmsuItemID, ItemName, UserName, Quantity, TotalPrice, ItemImage, Description, CollegeItemID, CollegeID, AdminID, Size) 
                      VALUES ('$StudentID','$WmsuItemID', '$ItemName', '$UserName', '$quantityToAdd', '$TotalPrice', '$ItemImage', '$Description', '$CollegeItemID', '$CollegeID', '$AdminID', '$Size')";
    if ($conn->query($insertCartSql) === TRUE) {
        echo "<script>alert('Item added to the cart successfully!');</script>";
    } else {
        echo "<script>alert('Error: ');</script>" . $insertFeedbackSql . "<br>" . $conn->error;
    }
}

if (isset($_POST['submitFeedback'])) {
    $feedbackText = isset($_POST['feedbackText']) ? mysqli_real_escape_string($conn, $_POST['feedbackText']) : null;

     $CollegeItemID = isset($_POST['CollegeItemID']) ? $_POST['CollegeItemID'] : null;

    if (!$CollegeItemID) {
        echo "<script>alert('Error: CollegeItemID is missing!');</script>";
        exit();
    }

    if ($feedbackText) {
         $insertFeedbackSql = "INSERT INTO WmsuFeedBack (WmsuItemID, CollegeItemID, UserName, FeedBack) 
                              VALUES (null, $CollegeItemID, '$UserName', '$feedbackText')";

        if ($conn->query($insertFeedbackSql) === TRUE) {
            header("Location: {$_SERVER['PHP_SELF']}?CollegeItemID=$CollegeItemID");
            exit();
        } else {
            echo "<script>alert('Error: ');</script>" . $insertFeedbackSql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Error: Invalid feedback text!');</script>";
    }
}

$conn->close();
?>

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
                        <a href='../userPanel/filterItem.php'>
                            <img class='image6' src='../assets/img/chevron-left (1).png' alt=''>
                        </a>
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
                $CollegeID = $row['CollegeID'];

                echo "<div class='container2'>
                    <div class='subContainer2'>
                        <div class='itemImageContainer'>
                            <div class='subItemImageContainer'>
                                <div class='imageContainer3'>
                                    <div class='slideshow-container'>
                                        <div class='mySlides'>
                                            <img class='image10' src='../assets/img/" . $ItemImage . "' alt='Image 1'>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                            echo "<div class='infoContainer'>
                                <div class='itemNameContainer'>
                                    <div class='subItemNameContainer'>
                                        <p>" . $ItemName . "</p>
                                    </div>";

                                    echo "<div class='priceContainer'>
                                        <p>Price: " . $Price . "</p>
                                    </div>";

                                    echo "<div class='subItemNameContainer'>
                                        <form method='post'>
                                            <input type='hidden' name='CollegeItemID' value='$CollegeItemID'>
                                            <input type='hidden' name='ItemName' value='$ItemName'>
                                            <input type='hidden' name='TotalPrice' value='$Price'>
                                            <input type='hidden' name='ItemImage' value='$ItemImage'>
                                            <input type='hidden' name='Description' value='$Description'>
                                            <input type='hidden' name='CollegeID' value='$CollegeID'>
                                            <select class='quantity' name='Quantity' required>
                                                <option value=''>QUANTITY:</option>";
                                                for ($i = 1; $i <= min($Quantity, 10); $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                            echo "</select>
                                            <select class='quantity' name='Size'>
                                                <option value=''>Size:</option>
                                                <option value='S'>S</option>
                                                <option value='M'>M</option>
                                                <option value='L'>L</option>
                                                <option value='XL'>XL</option>
                                                <option value='XXL'>XXL</option>
                                                <option value='XXXL'>XXXL</option>
                                            </select>
                                            <button type='submit' name='addToCart' class='addToCart'>Add to Cart</button>
                                        </form>
                                    </div>

                                    <div class='subItemNameContainer'>
                                        <button class='quantity'>Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>";

                        echo "<div class='descriptionContainer'>
                            <div class='subDescriptionContainer'>
                                <p>Description:</p>
                            </div>

                            <div class='description'>
                                <p>" . $Description . "</p>
                            </div>
                        </div>";
                    }
                }
            }
        
            $conn->close();
            ?>   

            <div class='feedbackContainer'>

            <?php
            include('../ConnectionDB/connection.php');

            if (isset($_GET['CollegeItemID'])) {
            $CollegeItemID = $_GET['CollegeItemID'];
            $sql = "SELECT * FROM WmsuFeedBack WHERE CollegeItemID = $CollegeItemID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $FeedBack = $row['FeedBack'];
            $UserName = $row['UserName'];
                echo"<div class='subFeedbackContainer'>
                    <div class='feedback'>
                        <div class='subFeedback'>
                            <p>
                                $FeedBack
                            </p>
                        </div>

                        <div class='usernameContainer'>
                            <p>Username: $UserName</p>
                        </div>
                    </div>";
                }
            }
            }

            $conn->close();
            ?> 
                </div>

                <div class='feedbackChatContainer'>
                        <form method='post' class='chatContainer'>
                            <div class='chatContainer'>
                                <textarea class='chat' name='feedbackText' id='' cols='30' rows='10'></textarea>
                            </div>
                                <input type='hidden' name='CollegeItemID' value='<?php echo $CollegeItemID; ?>'>
                            <div class='sendContainer'>
                                <button type='submit' name='submitFeedback'>
                                    <img class='send' src='../assets/img/201-2016537_send-message-icon-white-clipart-computer-icons-clip.png' alt=''>
                                </button>
                            </div>
                        </form>
                    </div>
                        </div>
                    </div>
                </div>

    </div>

    <script src='../assets/js/viewDashboard.js'></script>
</body>
</html>

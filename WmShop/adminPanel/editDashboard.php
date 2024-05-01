<?php
include('../ConnectionDB/connection.php');

if (isset($_GET['WmsuItemID'])) {
    $WmsuItemID = $_GET['WmsuItemID'];
    $query = "SELECT * FROM WmsuItem WHERE WmsuItemID = $WmsuItemID";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ItemName = $row['ItemName'];
        $Price = $row['Price'];
        $Quantity = $row['Quantity'];
        $ItemImage = $row['ItemImage'];
    } else {
        
    }
} else {
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $WmsuItemID = $_POST["WmsuItemID"];
    $ItemName = $_POST["ItemName"];
    $Price = $_POST["Price"];
    $Quantity = $_POST["Quantity"];

    $sql = "UPDATE WmsuItem SET 
            ItemName = '$ItemName',
            Price = $Price,
            Quantity = $Quantity
            WHERE WmsuItemID = $WmsuItemID";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Item updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating item: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link rel='stylesheet' href='../assets/css/viewDashboard.css'>
</head>
<body>
    <div class='container'>
        <div class='backButtonContainer'>
            <div class='subbackButtonContainer'>
                <a href='../adminPanel/dashboard.php'>
                    <img class='backButton' src='../assets/img/chevron-left (1).png' alt=''>
                </a>
            </div>
        </div>
        
        <form method="post" action="../adminPanel/editDashboard.php">
            <input type="hidden" name="WmsuItemID" value="<?php echo $WmsuItemID; ?>">
            <div class='subContainer'>
                <div class='imageContainer'>
                    <div class='subImageContainer'>
                        <div class='slideshow-container'>
                            <div class='mySlides'>
                                <img class='image' src='../assets/img/<?php echo $ItemImage; ?>' >
                            </div>
                        </div>
                    </div>
                </div>

                <div class='infoContianer'>
                    <div class='subInfoContainer'>
                        <input class='inputInfo' type='text' name='ItemName' placeholder='Item Name:' value='<?php echo $ItemName; ?>'>
                    </div>

                    <div class='subInfoContainer'>
                        <input class='inputInfo' type='number' name='Price' placeholder='Price:' value='<?php echo $Price; ?>'>
                    </div>

                    <div class='stockContainer'>
                        <div class='subStockContainer'>
                            <p>Stocks:</p>
                        </div>

                        <div class='subInfoContainer'>
                            <input class='inputInfo' type='number' name='Quantity' placeholder='Quantity of accessories and etc:' value='<?php echo $Quantity; ?>'>
                        </div>

                        <div class='subStockContainer'>
                            <p>Size Quantity:</p>
                        </div>
                    </div>

                    <div class='editButtonContainer'>
                        <button name="submit" type='submit' class='editButton'>Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

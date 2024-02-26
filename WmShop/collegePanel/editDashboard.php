<?php
include('../ConnectionDB/connection.php');

// Fetch item details based on CollegeItemID
if (isset($_GET['CollegeItemID'])) {
    $CollegeItemID = $_GET['CollegeItemID'];
    $query = "SELECT * FROM CollegeItem WHERE CollegeItemID = $CollegeItemID";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ItemName = $row['ItemName'];
        $Price = $row['Price'];
        $Quantity = $row['Quantity'];
        $Small = $row['Small'];
        $Meduim = $row['Meduim'];
        $Large = $row['Large'];
        $XL = $row['XL'];
        $XXL = $row['XXL'];
        $XXXL = $row['XXXL'];
        $ItemImage = $row['ItemImage'];  // Assuming this column exists in your database
    } else {
        // Handle error, item not found
    }
} else {
    // Handle error, CollegeItemID not set
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $CollegeItemID = $_POST["CollegeItemID"];
    $ItemName = $_POST["ItemName"];
    $Price = $_POST["Price"];
    $Quantity = $_POST["Quantity"];
    $Small = $_POST["Small"];
    $Meduim = $_POST["Meduim"];
    $Large = $_POST["Large"];
    $XL = $_POST["XL"];
    $XXL = $_POST["XXL"];
    $XXXL = $_POST["XXXL"];

    // Perform the database update query
    $sql = "UPDATE CollegeItem SET 
            ItemName = '$ItemName',
            Price = $Price,
            Quantity = $Quantity,
            Small = $Small,
            Meduim = $Meduim,
            Large = $Large,
            XL = $XL,
            XXL = $XXL,
            XXXL = $XXXL
            WHERE CollegeItemID = $CollegeItemID";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        //echo "Item updated successfully!";
    } else {
        echo "Error updating item: " . mysqli_error($conn);
    }
}

// Close the database connection if you opened one
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
                <a href='../collegePanel/collegeDashboard.php'>
                    <img class='backButton' src='../assets/img/chevron-left (1).png' alt=''>
                </a>
            </div>
        </div>
        
        <form method="post" action="../collegePanel/editDashboard.php">
            <input type="hidden" name="CollegeItemID" value="<?php echo $CollegeItemID; ?>">
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

                        <div class='sizeContainer'>
                            <input class='size' type='number' name='Small' placeholder='S' value='<?php echo $Small; ?>'>
                            <input class='size' type='number' name='Meduim' placeholder='M' value='<?php echo $Meduim; ?>'>
                            <input class='size' type='number' name='Large' placeholder='L' value='<?php echo $Large; ?>'>
                            <input class='size' type='number' name='XL' placeholder='XL' value='<?php echo $XL; ?>'>
                            <input class='size' type='number' name='XXL' placeholder='XXL' value='<?php echo $XXL; ?>'>
                            <input class='size' type='number' name='XXXL' placeholder='XXXL' value='<?php echo $XXXL; ?>'>
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

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

// Get CollegeID from the session
$CollegeID = $_SESSION['CollegeID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/analytics.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        <?php include('../collegePanel/sideBar.php'); ?>
    </div>
</div>
<div class="container2">
    <div class="itemContainer">
        <div class="subItemContainer">

            <?php
            include('../ConnectionDB/connection.php');

            // Assuming $CollegeID is defined before this code snippet
            if (isset($CollegeID)) {
                $CollegeID = $_SESSION['CollegeID'];
                $sql = "SELECT ItemName, ItemImage, SUM(Quantity) as TotalSales FROM CollegeItem WHERE CollegeID = $CollegeID GROUP BY ItemName, ItemImage";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $itemImage = $row['ItemImage'];
                        $itemName = $row['ItemName'];
                        echo "<div class='item'>
                        <div class='imageContainer3'>
                            <img class='image10' src='../assets/img/" . $itemImage . "' alt=''>
                        </div>
                        <div class='itemName'>
                            <p>" . $itemName . "</p>
                        </div>
                    </div>";
                    }
                } else {
                    echo "No records found.";
                }

                $conn->close();
            } else {
                echo "CollegeID is not set.";
            }
            ?>

        </div>
    </div>

    <div class="graphContainer">
        <div class="subGraphContainer">
            <canvas class="barGraph" id="barGraph" width="460" height="200"></canvas>
        </div>

        <div class="subGraphContainer">
            <canvas class="pieGraph" id="pieGraph" width="600" height="200"></canvas>
        </div>
    </div>

    <div class="graphContainer">
        <div class="subGraphContainer1">
            <table>
                <thead>
                <tr>
                    <th>ITEM NAME</th>
                    <th>TOTAL PRICE</th>
                    <th>INCOME PERCENTAGE</th>
                    <th>TOTAL INCOME</th>
                </tr>
                </thead>

                <tbody>
                <?php
                include('../ConnectionDB/connection.php');

                // Assuming $CollegeID is defined before this code snippet
                if (isset($CollegeID)) {
                    $CollegeID = $_SESSION['CollegeID'];
                    $sql = "SELECT ItemName, SUM(Quantity) as TotalQuantity, SUM(TotalPrice) as TotalPrice FROM CollegeTransaction WHERE CollegeID = $CollegeID AND Status = 'Order Complete' GROUP BY ItemName";
                    $result = $conn->query($sql);

                    $itemNames = [];
                    $quantities = [];
                    $totalPrices = [];
                    $incomes = [];
                    $totalIncome = 0; // Initialize total income

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $itemNames[] = $row['ItemName'];
                            $totalPrices[] = $row['TotalPrice'];

                            // Calculate 5% income for the current row
                            $income = 0.10 * $row['TotalPrice'];
                            $incomes[] = $income;

                            // Accumulate income to the total
                            $totalIncome += $income;

                            echo "<tr>
                        <td>" . $row['ItemName'] . "</td>
                        <td>" . $row['TotalPrice'] . "</td>
                        <td>10%</td>
                        <td>$income</td>
                    </tr>";
                        }
                    }
                    $conn->close();
                } else {
                    echo "CollegeID is not set.";
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="subGraphContainer1">
            <table>
                <thead>
                <tr>
                    <th>ITEM IMAGE</th>
                    <th>ITEM NAME</th>
                    <th>SALES</th>
                </tr>
                </thead>

                <tbody>

                <?php
                include('../ConnectionDB/connection.php');

                // Assuming $CollegeID is defined before this code snippet
                if (isset($CollegeID)) {
                    $CollegeID = $_SESSION['CollegeID'];
                    $sql = "SELECT ItemName, ItemImage, SUM(Quantity) as TotalSales FROM CollegeTransaction WHERE CollegeID = $CollegeID AND Status = 'Order Complete' GROUP BY ItemName, ItemImage";
                    $result = $conn->query($sql);

                    $itemNames = [];
                    $totalSales = [];

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $itemImage = $row['ItemImage'];
                            $itemName = $row['ItemName'];
                            $totalSale = $row['TotalSales'];

                            echo "<tr>
                        <td><img class='image8' src='../assets/img/" . $itemImage . "' alt=''></td>";
                            echo "<td>" . $itemName . "</td>
                        <td>$totalSale</td>
                    </tr>";

                            // Store data for the chart
                            $itemNames[] = $itemName;
                            $totalSales[] = $totalSale;
                        }
                    }
                    $conn->close();
                } else {
                    echo "CollegeID is not set.";
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script src="../assets/js/dashboard.js"></script>
<script>
    // Get the context of the canvas element for the bar graph
    var ctxBar = document.getElementById('barGraph').getContext('2d');

    // Initialize the bar graph
    var barGraph = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($itemNames); ?>,
            datasets: [{
                label: 'Total Income',
                data: <?php echo json_encode($incomes); ?>,
                backgroundColor: '#b10303',
                borderColor: '#500000',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Get the context of the canvas element for the pie chart
    var ctxPie = document.getElementById('pieGraph').getContext('2d');

    // Initialize the pie chart
    var pieGraph = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($itemNames); ?>,
            datasets: [{
                data: <?php echo json_encode($totalSales); ?>,
                backgroundColor: [
                    '#500000',
                    '#b10303',
                    '#ff0000',
                    '#ff5757',
                    '#ffc0c0'
                ],
                borderColor: [
                    '#fff0f0',
                    '#ffc0c0',
                    '#ff5757',
                    '#ff0000',
                    '#b10303',
                    '#500000'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
</body>
</html>

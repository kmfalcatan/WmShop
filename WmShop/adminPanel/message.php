<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link rel='stylesheet' href='../assets/css/message.css'>
</head>
<body>
    <div class='container'>
        <div class='subContainer'>
            <div class='backContainer' onclick='toggleSubContainer(event)'>
                <a href='../adminPanel/dashboard.php'>
                    <img class='backIcon' src='../assets/img/chevron-left (1).png' alt=''>
                </a>
            </div>
            
            <div class='searchBarContainer'>
                <input class='searchBar' type='text' placeholder='Search'>
            </div>

            <div class='messageContainer'>
                <?php
                include('../ConnectionDB/connection.php');
                $studentQuery = "SELECT StudentID, Role, CONCAT(FirstName, ' ', LastName) AS FullName FROM Student";
                $studentResult = $conn->query($studentQuery);

                if ($studentResult->num_rows > 0) {
                    while ($studentRow = $studentResult->fetch_assoc()) {
                        $StudentID = $studentRow['StudentID'];
                        $Role = $studentRow['Role'];
                        echo "<a href='../adminPanel/chat copy.php?StudentID=$StudentID&Role=$Role'>";
                        echo "<input type='hidden' name='Role' value='$Role'>";
                        echo "<div class='subMessageContainer' onclick='toggleChatContainer(\"" . $studentRow['FullName'] . "\", " . $studentRow['StudentID'] . ", \"Student\")'>";
                        echo "<div class='nameContainer'>";
                        echo "<p>" . $studentRow['FullName'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
                }

                $collegeQuery = "SELECT CollegeID, Role, CONCAT(FirstName, ' ', LastName) AS FullName FROM College";
                $collegeResult = $conn->query($collegeQuery);

                if ($collegeResult->num_rows > 0) {
                    while ($collegeRow = $collegeResult->fetch_assoc()) {
                        $CollegeID = $collegeRow['CollegeID'];
                        $Role = $collegeRow['Role'];
                        echo "<a href='../adminPanel/chat copy.php?CollegeID=$CollegeID&Role=$Role'>";
                        echo "<input type='hidden' name='Role' value='$Role'>";
                        echo "<div class='subMessageContainer' onclick='toggleChatContainer(\"" . $collegeRow['FullName'] . "\", " . $collegeRow['CollegeID'] . ", \"College\")'>";
                        echo "<div class='nameContainer'>";
                        echo "<p>" . $collegeRow['FullName'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <script src='../assets/js/message.js'></script>
    <script>
        <?php
        if (isset($_GET['success'])) {
            echo "alert('Success: " . $_GET['success'] . "');";
        } elseif (isset($_GET['error'])) {
            echo "alert('Error: " . $_GET['error'] . "');";
        }
        ?>
    </script>
</body>
</html>

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
                <a href='../UserPanel/userHomePage.php'>
                    <img class='backIcon' src='../assets/img/chevron-left (1).png' alt=''>
                </a>
            </div>
            
            <div class='searchBarContainer'>
                <input class='searchBar' type='text' placeholder='Search'>
            </div>

            <div class='messageContainer'>
                <?php
                include('../ConnectionDB/connection.php');

                $CollegeQuery = "SELECT CollegeID, Role, CONCAT(FirstName, ' ', LastName) AS FullName FROM College";
                $CollegeResult = $conn->query($CollegeQuery);

                if ($CollegeResult->num_rows > 0) {
                    while ($CollegeRow = $CollegeResult->fetch_assoc()) {
                        $CollegeID = $CollegeRow['CollegeID'];
                        $Role = $CollegeRow['Role'];
                        echo "<a href='../userPanel/chat copy.php?CollegeID=$CollegeID'>
                        <input type='hidden' value='$Role'>";
                        echo "<div class='subMessageContainer' onclick='toggleChatContainer(\"" . $CollegeRow['FullName'] . "\", " . $CollegeRow['CollegeID'] . ", \"College\")'>";
                        echo "<div class='nameContainer'>";
                        echo "<p>" . $CollegeRow['FullName'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</a>";
                    }
                }

                $collegeQuery = "SELECT AdminID, Role FROM Admin";
                $collegeResult = $conn->query($collegeQuery);

                if ($collegeResult->num_rows > 0) {
                    while ($collegeRow = $collegeResult->fetch_assoc()) {
                        $AdminID = $collegeRow['AdminID'];
                        $Role = $collegeRow['Role'];
                        echo "<a href='../userPanel/chat copy.php?AdminID=$AdminID'>
                        <input type='hidden' value='$Role'>";
                        echo "<div class='subMessageContainer' onclick='toggleChatContainer(\"" . $collegeRow['AdminID'] . ", \"Admin\")'>";
                        echo "<div class='nameContainer'>";
                        echo "<p>" . $Role . "</p>";
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
</body>
</html>
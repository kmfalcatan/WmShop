<?php include('../function/CollegeUser.php') ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/dashboard.css'>
    <link rel='stylesheet' href='../assets/css/accountAppr.css'>
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
                        <p class='companyName'>College</p>
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

        <div class='container'>
            <div class='filterContainer1'>
                <div class='subFilterContainer1'>
                    <a href='../adminPanel/users.php' class='filter1'><button class='filter1' onclick='changeColor(this)'>Student</button></a>
                </div>
            </div>

           <div class='searchBarContainer'>
                <input class='searchBar' type='text' placeholder='Search...' id='searchInput' oninput='filterItems()'>
           </div>

           <div class='tableContainer' id='itemContainer'>
                <table>
                    <thead>
                        <tr>
                            <th >FULL NAME</th>
                            <th >EMAIL</th>
                            <th >ADDRESS</th>
                            <th >CONTACT NO.</th>
                            <th >COLLEGE</th>
                            <th >ACTION</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include('../ConnectionDB/connection.php');
                        
                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM College";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $CollegeID = $row['CollegeID'];
                                $FirstName = $row['FirstName'];
                                $LastName = $row['LastName'];
                                $Email = $row['Email'];
                                $Address = $row['Address'];
                                $ContactNo = $row['ContactNo'];
                                $College = $row['College'];
                        echo"<tr>
                            <td>" .$FirstName . ' ' . $LastName. "</td>";
                            echo"<td>" .$Email. "</td>";
                            echo"<td>" .$Address. "</td>";
                            echo"<td>" .$ContactNo. "</td>";
                            echo"<td>" .$College. "</td>";
                            echo"<td class='actionContainer'>
                                <form method='post' action='' onsubmit='return confirmDelete()'>";
                                    echo"<input type='hidden' name='CollegeID' value='" . $CollegeID . "'>";
                                    echo"<input type='hidden' name='FirstName' value='" . $FirstName . "'>";
                                    echo"<input type='hidden' name='LastName' value='" . $LastName . "'>";
                                    echo"<input type='hidden' name='Email' value='" . $Email . "'>";
                                    echo"<input type='hidden' name='Address' value='" . $Address . "'>";
                                    echo"<input type='hidden' name='ContactNo' value='" . $ContactNo . "'>";
                                    echo"<input type='hidden' name='College' value='" . $College . "'>";
                                    echo"<button class='action' name='action' value='Delete'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                        }
                    }
                        $conn->close();
                    ?>
                    </tbody>
                </table>
           </div>
        </div>
    </div>

    <script src='../assets/js/accountAppr.js'></script>
    <script src="../assets/js/search.js"></script>
    <script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this user?');
    }
    </script>
</body>
</html>
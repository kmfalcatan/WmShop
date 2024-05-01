<?php include('../function/accountAppr.php') ?>

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

        <div class='container'>
           <div class='searchBarContainer'>
                <input class='searchBar' type='text' placeholder='Search...' id='searchInput' oninput='filterItems()'>
           </div>

           <div class='tableContainer' id='itemContainer'>
        <table>
            <thead>
                <tr>
                    <th>FULL NAME</th>
                    <th>EMAIL</th>
                    <th>ADDRESS</th>
                    <th>CONTACT NO.</th>
                    <th>COLLEGE</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <?php
                        include('../ConnectionDB/connection.php');

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM PendingStudent";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $PendingStudentID = $row['PendingStudentID'];
                    $firstName = $row["FirstName"];
                    $lastName = $row["LastName"];
                    $middleName = $row["MiddleName"];
                    $email = $row["Email"];
                    $address = $row["Address"];
                    $contactNo = $row["ContactNo"];
                    $college = $row["College"];
                    $password = $row["Password"];
                    $role = $row['Role'];
                    echo "<tbody>
                        <tr>
                            <td>$firstName $lastName</td>
                            <td>$email</td>
                            <td>$address</td>
                            <td>$contactNo</td>
                            <td>$college</td>
                            <td class='actionContainer'>
                                <form action='accountAppr.php' method='POST' onsubmit='return confirmDelete()'>
                                    <input type='hidden' name='PendingStudentID' value='$PendingStudentID'>
                                    <input type='hidden' name='firstName' value='$firstName'>
                                    <input type='hidden' name='lastName' value='$lastName'>
                                    <input type='hidden' name='middleName' value='$middleName'>
                                    <input type='hidden' name='email' value='$email'>
                                    <input type='hidden' name='address' value='$address'>
                                    <input type='hidden' name='contactNo' value='$contactNo'>
                                    <input type='hidden' name='college' value='$college'>
                                    <input type='hidden' name='password' value='$password'>
                                    <input type='hidden' name='role' value='$role'>
                                    <button class='action' name='action' value='Accept'>Accept</button>
                                    <button class='action' name='action' value='Denied'>Denied</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>";
                }
            }

            $conn->close();
            ?>
        </table>
           </div>
        </div>
    </div>

    <script src='../assets/js/accountAppr.js'></script>
    <script src="../assets/js/search.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script>
    function confirmDelete() {
        return confirm('Are you sure you want to denied/accept this user?');
    }
    </script>
</body>
</html>
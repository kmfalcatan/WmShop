<?php
session_start(); 
include('../function/profile.php'); 
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/profile.css'>
    <link rel='stylesheet' href='../assets/css/index.css'>
</head>
<body>
    <div class='signUpContainer'>
        <div class='subSignInContainer1'>
            <div class='signIn1'>
                <p>Profile</p>
            </div>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='inputUserContainer1'>
                            <div class='subInputUserContainer2'>
                                <p class='inputUser1'>" . $row['FirstName'] . "</p>";
                                echo "<p class='inputUser1'>" . $row['LastName'] . "</p>";
                                echo "<p class='inputUser1'>" . $row['MiddleName'] . "</p>
                            </div>";

                            echo "<div class='subInputUserContainer2'>
                                <p class='inputUser2'>" . $row['Email'] . "</p>
                            </div>";

                            echo "<div class='subInputUserContainer2'>
                                <p class='inputUser2'>" . $row['Address'] . "</p>
                            </div>";

                            echo "<div class='subInputUserContainer2'>
                                <p class='inputUser2'>" . $row['ContactNo'] . "</p>
                            </div>";

                            echo "<div class='subInputUserContainer2'>
                                <p class='inputUser2'>" . $row['College'] . "</p>
                            </div>";

                            echo "<div class='subInputUserContainer2'>
                                <a href='../userPanel/editProfile.php?studentID=$row[StudentID]'>
                                    <button class='signInButton'>Edit</button>
                                </a>

                                <a href='../userPanel/userhomePage.php'>
                                    <button class='signInButton'>Back</button>
                                </a>
                            </div>
                        </div>";
                }
            } else {
                echo 'You have no items listed.';
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>

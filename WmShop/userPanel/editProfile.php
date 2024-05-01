<?php
include('../ConnectionDB/connection.php');

$FirstName = $LastName = $MiddleName = $Email = $Address = $ContactNo = $College = "";
$StudentID = isset($_GET['studentID']) ? $_GET['studentID'] : '';

if (!empty($StudentID)) {
    $query = "SELECT * FROM student WHERE StudentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $StudentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $FirstName = isset($row["FirstName"]) ? $row["FirstName"] : "";
        $LastName = isset($row["LastName"]) ? $row["LastName"] : "";
        $MiddleName = isset($row["MiddleName"]) ? $row["MiddleName"] : "";
        $Email = isset($row["Email"]) ? $row["Email"] : "";
        $Address = isset($row["Address"]) ? $row["Address"] : "";
        $ContactNo = isset($row["ContactNo"]) ? $row["ContactNo"] : "";
        $College = isset($row["College"]) ? $row["College"] : "";
    } else {
    }
    $stmt->close();
} else {
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $StudentID = isset($_POST["StudentID"]) ? $_POST["StudentID"] : "";
    $FirstName = isset($_POST["FirstName"]) ? $_POST["FirstName"] : "";
    $LastName = isset($_POST["LastName"]) ? $_POST["LastName"] : "";
    $MiddleName = isset($_POST["MiddleName"]) ? $_POST["MiddleName"] : "";
    $Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
    $Address = isset($_POST["Address"]) ? $_POST["Address"] : "";
    $ContactNo = isset($_POST["ContactNo"]) ? $_POST["ContactNo"] : "";
    $College = isset($_POST["College"]) ? $_POST["College"] : "";

    $query = "UPDATE student SET 
            FirstName = ?,
            LastName = ?,
            MiddleName = ?,
            Email = ?,
            Address = ?,
            ContactNo = ?,
            College = ?
            WHERE StudentID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $FirstName, $LastName, $MiddleName, $Email, $Address, $ContactNo, $College, $StudentID);

    if ($stmt->execute()) {
    } else {
        echo "Error updating item: " . $stmt->error;
        echo "<script>alert('Error updating item: ');</script>" . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/editProfile.css'>
    <link rel='stylesheet' href='../assets/css/index.css'>
</head>
<body>
    <div class='signUpContainer'>
        <div class='subSignInContainer1'>
            <div class='signIn1'>
                <p>Edit profile</p>
            </div>

            <form method="post" action="../userPanel/editProfile.php">  
                <input type="hidden" name="StudentID" value="<?php echo $StudentID; ?>">
                <div class='inputUserContainer1'>
                    <div class='subInputUserContainer2'>
                        <input class='inputUser1' type='text' name='FirstName' value='<?php echo $FirstName; ?>'>
                        <input class='inputUser1' type='text' name='LastName' value='<?php echo $LastName; ?>'>
                        <input class='inputUser1' type='text' name='MiddleName' value='<?php echo $MiddleName; ?>'>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='text' name='Email' value='<?php echo $Email; ?>' readonly>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='text' name='Address' value='<?php echo $Address; ?>'>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='text' name='ContactNo' value='<?php echo $ContactNo; ?>'>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='text' name='College' value='<?php echo $College; ?>'>
                    </div>
                    <div class='subInputUserContainer2'>
                        <button class='signInButton' type="submit">Save</button>
                    </form>
                    </div>
                </div>
                <div class="backButton"> 
                    <a href='../userPanel/profile.php'>
                        <button class='signInButton'>Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

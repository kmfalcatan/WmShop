<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "WmShopdb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
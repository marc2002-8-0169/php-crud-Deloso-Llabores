<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_acts";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("failed to connect...".$conn->connect_error);
}

?>
<?php  

error_reporting( ~E_DEPRECATED & ~E_NOTICE );

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cr11_karel_kraus_petadoption";

$conn = new mysqli($localhost, $username, $password, $dbname);

if($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}




?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dashbord";

// Create connection
$dbs = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $dbs->connect_error);
}
?>

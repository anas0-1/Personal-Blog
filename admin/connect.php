<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dashbord";

// Create connection
$dbs = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$dbs) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

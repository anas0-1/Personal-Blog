<?php
include "connect.php";

// Check connection
if ($dbs->connect_error) {
    die("Connection failed: " . $dbs->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $title = $dbs->real_escape_string($_POST['title']);
    $text = $dbs->real_escape_string($_POST['text']);

    // Get the image data
    $coverData = file_get_contents($_FILES['cover']['tmp_name']);

    // Insert data into database
    $sql = "INSERT INTO posts (title, text, cover) VALUES (?, ?, ?)";
    $stmt = $dbs->prepare($sql);
    $stmt->bind_param("sss", $title, $text, $coverData);

    if ($stmt->execute()) {
        echo "Post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $dbs->error;
    }

    $stmt->close();
}


$dbs->close();
?>


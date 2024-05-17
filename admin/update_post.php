<?php
// Include necessary files and start session if needed
include "connect.php"; // Assuming this file contains database connection code

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    
    // Handle cover image upload if provided
    if ($_FILES['cover']['error'] == UPLOAD_ERR_OK) {
        // Process the uploaded cover image
        $cover_tmp_name = $_FILES['cover']['tmp_name'];
        $cover_name = $_FILES['cover']['name'];
        $cover_path = "path/to/uploads/" . $cover_name; // Set the path where you want to store the cover image
        
        // Move the uploaded file to the desired location
        move_uploaded_file($cover_tmp_name, $cover_path);
        
        // Update the post record with the new cover image path in the database
        $sql = "UPDATE posts SET title = '$title', text = '$text', cover = '$cover_path' WHERE id = '$post_id'";
    } else {
        // If no new cover image is uploaded, update the post record without changing the cover image path
        $sql = "UPDATE posts SET title = '$title', text = '$text' WHERE id = '$post_id'";
    }
    
    // Execute the SQL query
    if ($dbs->query($sql) === TRUE) {
        // If update is successful, redirect back to the post-edit.php page with a success message
        header("Location: post-edit.php?id=$post_id&success=Post updated successfully");
        exit();
    } else {
        // If an error occurs, redirect back to the post-edit.php page with an error message
        header("Location: post-edit.php?id=$post_id&error=Error updating post: " . $dbs->error);
        exit();
    }
} else {
    // If the form is not submitted via POST method, redirect to a suitable location
    header("Location: error.php");
    exit();
}

// Close database connection
$dbs->close();
?>

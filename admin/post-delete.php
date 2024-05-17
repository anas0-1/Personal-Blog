<?php

include "connect.php"; 

if (isset($_GET['id'])) {
    
    $post_id = mysqli_real_escape_string($dbs, $_GET['id']);

 
    $sql = "DELETE FROM posts WHERE id = '$post_id'";


    if ($dbs->query($sql) === TRUE) {
        
        header("Location: message.php?success=Post deleted successfully");
        exit();
    } else {
        // If an error occurs, redirect back to the page with an error message
        header("Location: message.php?error=Error deleting post: " . $dbs->error);
        exit();
    }
} else {
    // If post ID is not provided in the URL, redirect back to the page with an error message
    header("Location: index.php?error=Post ID not provided");
    exit();
}

// Close database connection
$dbs->close();
?>

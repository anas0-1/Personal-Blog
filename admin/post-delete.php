<?php
include "connect.php";

// Check if the post ID is provided in the URL
if (isset($_GET['Idarticle'])) {
    // Sanitize the ID to prevent SQL injection
    $post_id = $_GET['Idarticle'];

    // Construct the DELETE query to delete the post
    $sql = "DELETE FROM posts WHERE Idarticle = :Idarticle";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':Idarticle', $post_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // If successful, redirect with success message
            header("Location: message.php?success=Post deleted successfully");
            exit();
        } else {
            // If an error occurs, redirect with error message
            header("Location: message.php?error=Error deleting post");
            exit();
        }
    } catch (PDOException $e) {
        // If an exception occurs, redirect with error message
        header("Location: message.php?error=" . $e->getMessage());
        exit();
    }
} else {
    // If post ID is not provided in the URL, redirect with error message
    header("Location: index.php?error=Post ID not provided");
    exit();
}
?>

<?php
// Include necessary files and start session if needed
include "connect.php"; // Assuming this file contains database connection code

// Check if the post ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $post_id = mysqli_real_escape_string($dbs, $_GET['id']);

    // Construct the SELECT query to fetch the post details
    $sql = "SELECT * FROM posts WHERE id = '$post_id'";

    // Execute the query
    $result = $dbs->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if the post exists
        if ($result->num_rows > 0) {
            // Fetch the post data
            $post = $result->fetch_assoc();
        } else {
            // If the post does not exist, display an error message
            echo "Post not found.";
            exit(); // Stop further execution
        }
    } else {
        // If an error occurs, display the error message
        echo "Error: " . $dbs->error;
        exit(); // Stop further execution
    }
} else {
    // If post ID is not provided in the URL, display an error message
    echo "Post ID not provided.";
    exit(); // Stop further execution
}

// Close database connection
$dbs->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style1.css">
    <!-- Include any necessary CSS or Bootstrap -->
</head>
<body>
    <h1>Edit Post</h1>
    <!-- Form for editing post details -->
    <form action="update_post.php" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <label class="form-header" for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>"><br>
        <label class="form-header" for="text">Text:</label><br>
        <textarea id="text" name="text"><?php echo $post['text']; ?></textarea><br>
        <!-- Add a file input field for uploading the cover image -->
        <label class="form-header" for="cover">Cover Image:</label><br><br>
        <input type="file" id="cover" name="cover-1"><br><br>
        
        <!-- Display the current cover image if available -->
       
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>

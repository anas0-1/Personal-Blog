<?php
// Include necessary files and start session if needed
include "connect.php"; // Assuming this file contains database connection code

// Check if the post ID is provided in the URL
if (isset($_GET['Idarticle'])) {
    // Sanitize the ID to prevent SQL injection
    $post_id = filter_var($_GET['Idarticle'], FILTER_SANITIZE_NUMBER_INT);

    // Construct the SELECT query to fetch the post details
    $sql = "SELECT * FROM article WHERE Idarticle = :Idarticle";

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Idarticle', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    // Check if the post exists
    if ($stmt->rowCount() > 0) {
        // Fetch the post data
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // If the post does not exist, display an error message
        echo "Post not found.";
        exit(); // Stop further execution
    }
} else {
    // If post ID is not provided in the URL, display an error message
    echo "Post ID not provided.";
    exit(); // Stop further execution
}
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
    <form action="update_post.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="Idarticle" value="<?php echo htmlspecialchars($post_id); ?>">
        <label class="form-header" for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>"><br>
        <label class="form-header" for="text">Text:</label><br>
        <textarea id="text" name="Content"><?php echo htmlspecialchars($post['Content']); ?></textarea><br>
        <!-- Add a file input field for uploading the cover image -->
        <label class="form-header" for="cover">Cover Image:</label><br><br>
        <input type="file" id="cover" name="image"><br><br>
        
       
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>

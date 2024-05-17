<?php
include "connect.php"; // Assuming this file contains database connection code
include "uploadimg.php"; // Assuming the class definition is in uploadimg.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = filter_var($_POST['Idarticle'], FILTER_SANITIZE_NUMBER_INT);
    $title = $_POST['title'];
    $text = $_POST['Content'];

    try {
        UploadImg::upload($post_id, $conn);

        // If the image is uploaded successfully, update the post details
        $sql = "UPDATE article SET title = ?, Content = ? WHERE Idarticle = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $text, $post_id]);

        header("Location: post-edit.php?Idarticle=$post_id&success=Post updated successfully");
        exit();
    } catch (Exception $e) {
        header("Location: error.php");
        exit();
    }
} else {
    header("Location: error.php");
    exit();
}
?>

<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<div class="main-table">
    <h3 class="mb-3">All Posts 
        <a href="post-add.php" class="btn btn-success">Add New</a></h3>

    <!-- Error and Success Messages -->
    <div class="alert alert-warning">
        Error message goes here
    </div>

    <div class="alert alert-success">
        Success message goes here
    </div>

    <!-- Table of Posts -->
    <table class="table t1 table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>Title</th>
                <th>Articles</th>
                <th>Comments</th>
                <th>Likes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td><a href="single_post.php?post_id=1">Post Title</a></td>
                <td>Articles Name</td>
                <td><i class="bi bi-chat-left-text-fill" aria-hidden="true"></i> 5</td>
                <td><i class="bi bi-hand-thumbs-up-fill" aria-hidden="true"></i> 10</td>
                <td>
                    <a href="post-delete.php?post_id=1" class="btn-1 btn-danger">Delete</a>
                    <a href="post-edit.php?post_id=1" class="btn-1 btn-warning">Edit</a>
                    <a href="post-publish.php?post_id=1&publish=1" class="btn-1 btn-link disabled">Public</a>
                    <a href="post-publish.php?post_id=1&publish=0" class="btn-1 btn-link">Private</a>
                </td>
            </tr>
            <!-- Additional rows go here -->
        </tbody>
    </table>

    <!-- Empty Table Message -->
    <div class="alert alert-warning">
        Empty!
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>




    

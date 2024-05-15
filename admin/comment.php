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
        <h3 class="mb-3">All Comments</h3>
        <!-- PHP error and success alerts -->
        <div class="alert alert-warning">
            Error message here
        </div>
        <!-- PHP success alert -->
        <div class="alert alert-success">
            Success message here
        </div>
        <!-- Table for displaying comments -->
        <table class="table t1 table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Comment</th>
                    <th scope="col">User</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample comment row (use PHP loop to generate rows dynamically) -->
                <tr>
                    <th scope="row">1</th>
                    <td><a href="single_post.php?post_id=1">Post Title</a></td>
                    <td>Comment text</td>
                    <td>@username</td>
                    <td><a href="comment-delete.php?comment_id=1" class="btn-btn btn-danger">Delete</a></td>
                </tr>
                <!-- End of sample comment row -->
            </tbody>
        </table>
        <!-- Empty table message -->
        <div class="alert alert-warning">
            Empty!
        </div>
    </div>

</body>


</html>
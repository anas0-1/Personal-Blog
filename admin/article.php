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
        <h3 class="mb-3">All Posts</h3>
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#createPostModal">Add New</button>


     

        <!-- Table of Posts -->
        <table class="table t1 table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connect.php";

                // Check connection
                if ($dbs->connect_error) {
                    die("Connection failed: " . $dbs->connect_error);
                }

                // Fetch posts from the database
                $sql = "SELECT * FROM posts";
                $result = $dbs->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["text"] . "</td>";
                        echo "<td>";
                        echo "<a href='post-delete.php?id=" . $row["id"] . "' class='btn-btn btn-danger'>Delete</a>";
                        echo "<a href='post-edit.php?id=" . $row["id"] . "' class='btn-btn btn-warning'>Edit</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No posts found</td></tr>";
                }

                $dbs->close();
                ?>
            </tbody>
        </table>


        <!-- Empty Table Message -->
        <div class="alert alert-warning">
            Empty!
        </div>
    </div>

    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" enctype="multipart/form-data" action="save_post.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="postTitle" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="postText" class="form-label">Text</label>
                            <textarea class="form-control" id="postText" name="text"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postCover" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="postCover" name="cover">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="custom-btn btn-close-red" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="custom-btn btn-create">Create</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
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
    <script src="index.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <aside class="Rectangle1">
        <div class="title">
            <span>blog</span><span class="highlight">MASTER</span>
        </div>
        <div class="container">
            <div class="text">ADMIN</div>
            <div class="circle">
                <img src="image/im.png" alt="Profile Image">
            </div>
        </div>
        <div class="cnt-1">
            <button class="btn" onclick="showSection('home')"><img src="svg/home.svg" class="icon"> Home</button>
            <button class="btn" onclick="showSection('user')"><img src="svg/user.svg" class="icon"> Users</button>
            <button class="btn" onclick="showSection('articles1')"><img src="svg/article.svg" class="icon"> Articles</button>
            <button class="btn" onclick="showSection('comment1')"><img src="svg/comment.svg" class="icon"> Comments</button>
            <button class="btn" onclick="window.location.href='../pageUser/user.php'"><img src="svg/set.svg" class="icon"> Settings</button>
        </div>
        </div>
        <div class="cnt-2">
            <button class="btn" onclick="window.location.href='../pageUser/logout.php'"> Logout <img src="svg/logout.svg"></button>
        </div>
    </aside>
    <main>
        <section id="user"  style="display: none;">
            <?php

            include 'users.php';
            ?>
        </section>
        <section id="comment1" style="display: none;">
            <?php

            include 'comment.php';
            ?>


        </section>


        <section id="articles1" style="display: none;">
            <?php

            include 'article.php';
            ?>
        </section>

       
        <section id="logout" style="display: none;">
            <?php

            include 'logout.php';
            ?>
        </section>

    </main>



</body>

</html>
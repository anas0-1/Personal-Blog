<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>
    <link rel="stylesheet" type="text/css" href="userStyle.css">
</head>
<body>

<aside class="Rectangle1">
    <div class="title">
        <span>blog</span><span class="highlight">MASTER</span>
    </div>
    <div class="container">
        <div class="text">ADMIN</div>
        <div class="circle">
            <?php
            // Connect to database
            $hostname = "localhost"; 
            $username = "root";
            $password = "";
            $dbname = "store";

            $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch image from the database
            $sql = "SELECT image FROM testblob WHERE id = 1";
            $result = $conn->query($sql);

            if ($result->rowCount() > 0) {
                // Output data of each row
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    // Display the image
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Profile Image">';
                }
            } else {
                echo "0 results";
            }
            $conn = null; // Close the connection
            ?>
        </div>
    </div>
    <div class="cnt-1">
        <button class="btn" ><img src="svg/home.svg" class="icon"> Home</button>
        <button class="btn" ><img src="svg/set.svg" class="icon"> Settings</button>
    </div>
    <div class="cnt-2">
        <button class="btn"> Logout   <img src="svg/logout.svg" ></button>
    </div>
</aside>
<main>
    <section class="inputs">
        <p class="main_text">Edit your username</p>
        <div class="FormInput">
            <div class="inputF">
                <img src="./vectors/Profile.svg" alt="error">
                <input type="text" id="username" name="username" placeholder=" New username">
                <img src="vectors/edit.svg" alt="">
            </div>
        </div>
        <p class="main_text">Edit your email</p>
        <div class="FormInput">
            <div class="inputF">
                <img src="./vectors/Profile.svg" alt="error">
                <input type="text" id="email" name="email" placeholder="New email">
                <img src="vectors/edit.svg" alt="">
            </div>
        </div>
        <p class="main_text">Edit your password</p>
        <div class="FormInput">
            <div class="inputF">
                <img src="./vectors/Profile.svg" alt="error">
                <input type="password" id="password" name="password" placeholder="Old password">
                <img src="vectors/Lock.svg" alt="">
            </div>
        </div>
        <div class="FormInput">
            <div class="inputF">
                <img src="./vectors/Profile.svg" alt="error">
                <input type="password" id="password" name="password" placeholder="New password">
                <img src="vectors/Lock.svg" alt="">
            </div>
        </div>
        <div class="FormInput">
            <div class="inputF">
                <img src="./vectors/Profile.svg" alt="error">
                <input type="password" id="password" name="password" placeholder="Confirm New password">
                <img src="vectors/Lock.svg" alt="">
            </div>
        </div>
    </section>
</main>

</body>
</html>

<?php
session_start();
require 'UpdateInfo.php'; // Include the UpdateInfo class

// Check if user is logged in
if (!isset($_SESSION['iduser'])) {
    header("Location: ../login.html");
    exit();
}

// Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'blog';

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Instance of the UpdateInfo class
$updateInfo = new UpdateInfo($conn);

// Check if updating user information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['iduser'];

    if (isset($_POST['update_username'])) {
        // Update username
        $new_username = $_POST['update_username'];
        $updateInfo->updateUsername($user_id, $new_username);
    }

    if (isset($_POST['update_email'])) {
        // Update email
        $new_email = $_POST['update_email'];
        $updateInfo->updateEmail($user_id, $new_email);
    }

    if (isset($_POST['update_password'])) {
        // Update password
        $new_password = $_POST['update_password'];
        $updateInfo->updatePassword($user_id, $new_password);
    }

    // Update user image
    if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
        try {
            $imageData = file_get_contents($_FILES['userfile']['tmp_name']);
            $updateInfo->updateUserImage($user_id, $imageData);
        } catch (Exception $e) {
            echo '<h4>' . $e->getMessage() . '</h4>';
        }
    }
}

// Fetch user information from database based on session user_id
$user_id = $_SESSION['iduser'];

try {
    $stmt = $conn->prepare("SELECT * FROM user WHERE iduser = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

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
        <div class="circle">
            <?php
            // Display user profile image
            if (isset($_SESSION['iduser'])) {
                try {
                    $stmt = $conn->prepare("SELECT image FROM user WHERE iduser = :iduser");
                    $stmt->bindParam(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Display the image
                            $imageData = $row['image'];
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Profile Image">';
                        }
                    } else {
                        echo "0 results";
                    }
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "User ID not found in session";
            }
            ?>
        </div>

        <?php
        // Display username
        if (isset($_SESSION['iduser'])) {
            try {
                $stmt = $conn->prepare("SELECT username FROM user WHERE iduser = :iduser");
                $stmt->bindParam(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Display the username
                        echo '<div class="text">' . $row['username'] . '</div>';
                    }
                } else {
                    echo "Username not found in the database";
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "User ID not found in session";
        }
        ?>
    </div>

    <div class="cnt-1">
        <button class="btn"><a href="../myphptest/accueil.php"><img src="svg/home.svg" class="icon"> Home</a></button>
        <button class="btn"><img src="svg/set.svg" class="icon"> Settings</button>
    </div>
    <div class="cnt-2">
        <form action="logout.php" method="post">
            <button type="submit" class="btn">Logout <img src="svg/logout.svg"></button>
        </form>
    </div>
</aside>
<main>
    <section class="inputs">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <p class="main_text">Edit your username</p>
            <div class="FormInput">
                <div class="inputF">
                    <img src="./vectors/Profile.svg" alt="error">
                    <input type="text" id="update_username" name="update_username" placeholder=" New username">
                    <img src="vectors/edit.svg" alt="">
                </div>
            </div>
            <p class="main_text">Edit your email</p>
            <div class="FormInput">
                <div class="inputF">
                    <img src="./vectors/Profile.svg" alt="error">
                    <input type="text" id="update_email" name="update_email" placeholder="New email">
                    <img src="vectors/edit.svg" alt="">
                </div>
            </div>
            <p class="main_text">Edit your password</p>
            <div class="FormInput">
                <div class="inputF">
                    <img src="./vectors/Profile.svg" alt="error">
                    <input type="password" id="update_password" name="update_password" placeholder="New password">
                    <img src="vectors/Lock.svg" alt="">
                </div>
            </div>
            <p class="main_text">Change your profile picture</p>
            <div class="FormInput">
                <div class="inputF">
                    <img src="./vectors/Profile.svg" alt="error">
                    <input type="file" id="userfile" name="userfile">
                    <img src="vectors/image.svg" alt="">
                </div>
            </div>
            <button type="submit" name="login">Submit Changes</button>
        </form>
    </section>
</main>
</body>
</html>

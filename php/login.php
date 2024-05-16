<?php
session_start();

// Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'blog';

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Form submission handling
if (isset($_POST['login'])) {
    $email_username = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Query to fetch user from database based on email or username
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email OR username = :username");
        $stmt->bindParam(':email', $email_username);
        $stmt->bindParam(':username', $email_username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            // Password is correct, set session and redirect based on role
            $_SESSION['iduser'] = $row['iduser'];
            if ($row['idrole'] == 1) {
                header("Location: welcomeadmin.php");
                exit();
            } elseif ($row['idrole'] == 2) {
                header("Location: ../myphptest/accueil.php");
                exit();
            } else {
                // Redirect to a default page if role is not defined
                header("Location: default.php");
                exit();
            }
        } else {
            // Password is incorrect or user not found
            echo "Invalid email/username or password. Please try again.";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

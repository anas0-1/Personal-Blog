<?php
session_start();

// Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'persBlog';

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
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
        $stmt->bindParam(':email', $email_username);
        $stmt->bindParam(':username', $email_username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            // Password is correct, set session and redirect to dashboard or home page
            $_SESSION['username'] = $row['username'];
            header("Location: welcome.php"); // Redirect to dashboard page
            exit();
        } else {
            // Password is incorrect or user not found
            echo "Invalid email/username or password. Please try again.";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

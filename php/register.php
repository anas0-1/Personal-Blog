<?php
session_start();
error_log("Script is being executed.");

// Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'persBlog';

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    error_log("Connected to database successfully.");
} catch(PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    die("Connection failed: " . $e->getMessage());
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Form submitted.");

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    error_log("Username: $username");
    error_log("Email: $email");
    error_log("Password: $password");
    error_log("Confirm Password: $confirm_password");

    // Validate inputs (you can add more validation)
    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        error_log("All fields are filled.");

        if ($password === $confirm_password) {
            error_log("Passwords match.");

            // Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                // Insert user data into database
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();

                error_log("User registered successfully.");
                // Redirect to success page or do something else
                $_SESSION['username'] = $username; // Start session for logged-in user
                header("Location: welcome.php");
                exit();
            } catch(PDOException $e) {
                error_log("Error: " . $e->getMessage());
                echo "Error: " . $e->getMessage();
            }
        } else {
            error_log("Passwords do not match.");
            echo "Passwords do not match.";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
} else {
    error_log("Form not submitted.");
    echo "Form not submitted.";
}
?>

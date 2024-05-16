<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['iduser'])) {
    // Redirect or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Function to upload image to database
function upload($iduser) {
    // Get the image info
    $size = getimagesize($_FILES['userfile']['tmp_name']);

    // Check if a file was uploaded
    if(is_uploaded_file($_FILES['userfile']['tmp_name']) && ($size != false)) {
        // Assign variables
        $type = $size['mime'];
        $handle = fopen($_FILES['userfile']['tmp_name'], "rb");
        $size = $_FILES['userfile']['size'];
        $name = $_FILES['userfile']['name'];
        $maxsize = 4294967296; // 4GB

        // Check if the file size is less than the maximum file size
        if($_FILES['userfile']['size'] < $maxsize ) {
            $hostname = "localhost";
            $dbname = "blog";
            $user = "root";
            $pass = "";

            try {
                // Connect to the database
                $DBH = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);

                // Set error mode
                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare SQL query
                $STH = $DBH->prepare("UPDATE user SET image = :image WHERE iduser = :iduser");

                // Bind parameters
                $STH->bindParam(':image', $handle, PDO::PARAM_LOB);
                $STH->bindParam(':iduser', $iduser, PDO::PARAM_INT);

                // Execute the query
                $STH->execute();

                echo "<p>Image uploaded successfully</p>";
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            // Throw an exception if the file size exceeds the maximum allowed
            throw new Exception("File Size Error");
        }
    } else {
        // Throw an exception if the file is not uploaded or unsupported
        throw new Exception("Unsupported Image Format!");
    }
}

// Check if a file was submitted
if(!isset($_FILES['userfile'])) {
    echo "<p>Please select a file</p>";
} else {
    try {
        // Upload image for the user in the session
        upload($_SESSION['iduser']);
    } catch(Exception $e) {
        echo '<h4>'.$e->getMessage().'</h4>';
    }
}
?>


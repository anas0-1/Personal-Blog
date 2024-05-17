<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta rel="viewport" content="width=device-width , initial-scale=1.0">
        <link rel="stylesheet"  href="././css/articleStyle.css">
        <title>articlepage</title> 
    </head>
    <body>
     <header>
    <nav class="head">
        <h3 class="logo">blogMASTER</h3>
        <div class="nav_items">
        <img  class="home_logo " src="./vectors/home.svg" alt="error">
        <a href="accueil.php" class="accueil">Accueil</a>
        <?php
session_start(); // Start the session to access session variables

// Connect to database
$hostname = "localhost"; 
$username = "root";
$password = "";
$dbname = "blog";

$conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if iduser is set in the session
if (isset($_SESSION['iduser'])) {
    // Fetch image from the database for the user in the session
    $sql = "SELECT image FROM user WHERE iduser = :iduser";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Display the image
            $imageData = $row['image'];
            echo '<div class="circle">';
        echo '<a href="../pageUser/user.php"><img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Profile Image"></a>';
        echo '</div>';

        }
    } else {
        echo '<a href="../pageUser/user.php" class="signin">Sign in</a>';
    }
} 
?>

        </div>
    </nav>
    </header>
    <section>
    <form method="GET" action="accueil.php">
            <div class="form-group has-search">
                <input type="text" class="form-control" placeholder="Search" name="search">
            </div>
        </form>
    </section>
         <section >
             <div class="grid-container">
            <div class="gridarticle">
            <?php
$conn = mysqli_connect("localhost", "root", "", "blog");
if ($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
}


if (isset($_GET['IdArticle'])) {
    $articleId = $_GET['IdArticle'];
    $sql = "SELECT article.title, article.Content, article.image, category.category_name, user.username 
    FROM article 
    JOIN user ON article.iduser = user.iduser 
    JOIN category ON article.IdCategorie = category.IdCategorie 
    WHERE article.IdArticle = '$articleId'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<img class="imagearticle" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Profile Image">';
            echo '<h1>' . $row["title"] . '</h1>';
            echo '<p class="cat">' . $row["category_name"] . '</p>';
            echo '<p class="adminname">' . $row["username"] . '</p>';
            echo '<hr class="ligne">';
            echo '<div class="divp">';
            echo '<p class="paragraphe">' . $row["Content"] . '</p>';
            echo '</div>';
        }
    } else {
        echo "0 result";
    }
} else {
    echo "Aucun article spécifié.";
}

$conn->close();
?>
</div>
<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (!isset($_SESSION['iduser'])) {
        // Redirect or handle unauthorized access
        header("Location: login.php");
        exit();
    }

    // Validate and sanitize the comment input
    $commentContent = $_POST['comment'];
    // You can add more validation and sanitization as needed

    // Get the current article ID
    $articleId = $_GET['IdArticle'];

    $articleId = $_POST['IdArticle'];
    // Insert the comment into the database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO comment (comment_cont, iduser, idarticle) VALUES (:comment, :iduser, :idarticle)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':comment', $commentContent, PDO::PARAM_STR);
    $stmt->bindParam(':iduser', $_SESSION['iduser'], PDO::PARAM_INT);
    $stmt->bindParam(':idarticle', $articleId, PDO::PARAM_INT);
    $stmt->execute();
}
?>

<section class="commentlike">
    <div class="stat">
        <div class="like_stat">
            <img src="./vectors/Like.svg" alt="">
            <p class="nbrlikes">10K</p>
        </div>
        <div class="comment_stat">
            <img src="./vectors/comment.svg" alt="">
            <?php
// Database connection parameters
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

try {
    // Connect to the database using PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the article ID from the URL
    $articleId = $_GET['IdArticle'];

    // Prepare the SQL query to count comments for the current article
    $sql = "SELECT COUNT(*) AS comment_count FROM comment WHERE idarticle = :idarticle";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idarticle', $articleId, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get the comment count
    $commentCount = $row['comment_count'];

    // Display the comment count
 
    echo '<p class="nmbComment">' . $commentCount . '</p>';
} catch (PDOException $e) {
    // Display an error message if unable to connect to the database
    echo "Connection failed: " . $e->getMessage();
}
?>
        </div>
    </div>
    <hr class="ligne1">
    <div><p class="Comments">Comments</p></div>
    <div class="commentaire">
    <!-- Display existing comments -->
    <?php
    // Connect to the database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch and display existing comments for the current article
    $articleId = $_GET['IdArticle'];
    $sql = "SELECT comment.comment_cont, user.username, user.image 
            FROM comment 
            JOIN user ON comment.iduser = user.iduser 
            WHERE comment.idarticle = :idarticle";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idarticle', $articleId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Display each comment
            echo'<hr class="ligne1">';
            echo '<div class="comm">';
            echo '<img id="#Comimg" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Profile Image">';
            echo '<p class="username">' . $row['username'] . '</p>';
            echo '<p class="commentcontent">' . $row['comment_cont'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "No comments found.";
    }

    // Close the database connection
    $conn = null;
    ?>
</div>

    <div class="inputF">
        <form method="post" action="">
        <input type="hidden" name="IdArticle" value="<?php echo $_GET['IdArticle']; ?>">
            <img src="./vectors/Send.svg" alt="">
            <input type="text" name="comment" placeholder="Your comment">
            <input type="submit" value="Submit">
        </form>
    </div>       
</section>

        <script src="./script/articlescript.js"></script>
    </body>
</html>
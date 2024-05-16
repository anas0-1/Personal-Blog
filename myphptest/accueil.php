<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="././css/acceuilStyle.css">
    <title>Article</title>
    
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
        echo '<a href="../pageUser/user.php"><img id="pr_img" src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Profile Image"></a>';
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
        <main>
        <section class="search_section">
    <form method="GET" action="accueil.php">
            <div class="form-group has-search">
                <input type="text" class="form-control" placeholder="Search" name="search">
            </div>
        </form>
    </section>
        <section class="grid_section">
        <?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "blog");
if ($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
}

// Vérifier si un terme de recherche a été soumis
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    
    // Requête SQL pour rechercher dans les articles
    $sql = "SELECT article.IdArticle, article.title, category.category_name, article.Content, user.username, article.datepublier, article.image 
            FROM article 
            JOIN user ON article.iduser = user.iduser 
            JOIN category ON article.IdCategorie = category.IdCategorie
            WHERE article.title LIKE '%$searchTerm%' OR article.Content LIKE '%$searchTerm%' OR user.username LIKE '%$searchTerm%' OR category.category_name LIKE '%$searchTerm%'";
} else {
    // Si aucun terme de recherche n'a été soumis, afficher tous les articles
    $sql = "SELECT article.IdArticle, article.title, category.category_name, article.Content, user.username, article.datepublier, article.image
            FROM article 
            JOIN user ON article.iduser = user.iduser 
            JOIN category ON article.IdCategorie = category.IdCategorie";
}


// Exécuter la requête SQL
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Générer le contenu HTML des articles
    echo '<div class="grid-container">';
    while ($row = $result->fetch_assoc()) {
        $imageData = $row['image'];
        $imageBase64 = base64_encode($imageData);
        echo '<div >';
        echo '<img id="card_img" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image depuis la base de données"><br>';
        echo '<div>';
        echo '<p class="adminname">' . $row["username"] . '</p>';
        echo '<p class="categoryarticle">' . $row["category_name"] . '</p>';
        echo '</div>';
        echo '<h1>' . $row["title"] . '</h1>';
        // Afficher la date de publication
        $datePublication = new DateTime($row["datepublier"]);
        $dateActuelle = new DateTime();
        $difference = date_diff($datePublication, $dateActuelle);
        if ($difference->y > 0) {
            echo '<p class="moment">' . $difference->y . ' ans ago</p>';
        } elseif ($difference->m > 0) {
            echo '<p class="moment">' . $difference->m . ' mois ago</p>';
        } elseif ($difference->d > 0) {
            echo '<p class="moment">' . $difference->d . ' jours ago</p>';
        } else {
            echo '<p class="moment">Today</p>';
        }
        // Add link to article.php with idarticle as query parameter
        echo '<a href="article.php?IdArticle=' . $row["IdArticle"] . '"><button class="more">Read more</button></a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "0 result";
}

// Fermer la connexion à la base de données
$conn->close();
?>


        </section>
        </main>   
        <footer>

        </footer>
        <script src="./script/accueilscript.js"></script>

</body>
</html>

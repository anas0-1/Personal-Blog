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

         <section class="commentlike">
            
                    <div class="stat">
                        <div class="like_stat">
                            <svg class="svgLike" width="30" height="48" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="48" height="48" fill="white"/>
                            <path d="M10.875 8C7.07813 8 4 11.013 4 14.7296C4 21.4592 12.125 27.577 16.5 29C20.875 27.577 29 21.4592 29 14.7296C29 11.013 25.9219 8 22.125 8C19.8 8 17.7438 9.12996 16.5 10.8595C15.8661 9.97557 15.0239 9.25421 14.0447 8.75646C13.0656 8.25871 11.9783 7.99924 10.875 8Z" stroke="#585757" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <P class="nbrlikes">10K</P>
                        </div>
                        <div class="comment_stat">
                            <svg class="svgComment" width="25" height="25" viewBox="0 0 35 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="29" height="29" fill="white"/>
                            <path d="M14.5 25.375C16.6509 25.375 18.7534 24.7372 20.5418 23.5422C22.3302 22.3473 23.7241 20.6488 24.5472 18.6617C25.3703 16.6745 25.5857 14.4879 25.166 12.3784C24.7464 10.2689 23.7107 8.33111 22.1898 6.81022C20.6689 5.28932 18.7311 4.25358 16.6216 3.83396C14.5121 3.41435 12.3255 3.62971 10.3383 4.45281C8.35117 5.27592 6.65273 6.66979 5.45777 8.45818C4.26281 10.2466 3.625 12.3491 3.625 14.5C3.625 16.298 4.06 17.9933 4.83333 19.4868L3.625 25.375L9.51321 24.1667C11.0067 24.94 12.7032 25.375 14.5 25.375Z" stroke="#585757" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p class="nmbComment">230</p>
                        </div>
                </div>
                <hr class="ligne1">
                <div><p class="Comments">Comments</p></div>
                <div class="commentaire">
                    <div>
                        <img id="profileimg" src="/img/téléchargement.png">
                    </div>
                    <div class="user_comment">
                        <p class="username">user name</p>
                        <p class="commentcontent">comment content</p>
                    </div>
                </div>
                <div class="inputF">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.73 10.8733L7.39671 2.70667C6.75212 2.38584 6.02426 2.27163 5.31238 2.37959C4.60051 2.48756 3.93925 2.81245 3.41876 3.30997C2.89828 3.80749 2.54391 4.45342 2.40395 5.15971C2.264 5.866 2.34528 6.59826 2.63671 7.25667L5.43671 13.5217C5.50024 13.6731 5.53296 13.8357 5.53296 14C5.53296 14.1643 5.50024 14.3269 5.43671 14.4783L2.63671 20.7433C2.39953 21.2762 2.29926 21.8598 2.34502 22.4413C2.39078 23.0227 2.58111 23.5835 2.89872 24.0727C3.21634 24.5618 3.65116 24.9639 4.16367 25.2422C4.67618 25.5206 5.25014 25.6665 5.83338 25.6667C6.37965 25.6612 6.91778 25.5337 7.40838 25.2933L23.7417 17.1267C24.3211 16.8352 24.8081 16.3885 25.1483 15.8364C25.4886 15.2843 25.6688 14.6485 25.6688 14C25.6688 13.3515 25.4886 12.7157 25.1483 12.1636C24.8081 11.6115 24.3211 11.1648 23.7417 10.8733H23.73ZM22.6917 15.0383L6.35838 23.205C6.1439 23.308 5.90306 23.3429 5.66816 23.3052C5.43326 23.2674 5.21552 23.1587 5.04414 22.9937C4.87276 22.8286 4.75594 22.6151 4.70933 22.3818C4.66272 22.1485 4.68856 21.9065 4.78338 21.6883L7.57171 15.4233C7.60781 15.3397 7.63897 15.254 7.66504 15.1667H15.7034C16.0128 15.1667 16.3095 15.0437 16.5283 14.825C16.7471 14.6062 16.87 14.3094 16.87 14C16.87 13.6906 16.7471 13.3938 16.5283 13.175C16.3095 12.9562 16.0128 12.8333 15.7034 12.8333H7.66504C7.63897 12.746 7.60781 12.6603 7.57171 12.5767L4.78338 6.31167C4.68856 6.09346 4.66272 5.85147 4.70933 5.61816C4.75594 5.38485 4.87276 5.17137 5.04414 5.00634C5.21552 4.84131 5.43326 4.73262 5.66816 4.69484C5.90306 4.65707 6.1439 4.69202 6.35838 4.795L22.6917 12.9617C22.8828 13.0596 23.0432 13.2083 23.1552 13.3915C23.2672 13.5747 23.3264 13.7853 23.3264 14C23.3264 14.2147 23.2672 14.4253 23.1552 14.6085C23.0432 14.7917 22.8828 14.9404 22.6917 15.0383Z" fill="#808080"/>
                        </svg>
                        
                <input type="text"  placeholder=" Your comment">
                </div>       
            </section>
        </section>
        <script src="./script/articlescript.js"></script>
    </body>
</html>
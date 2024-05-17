<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";

try {
    // Create connection using PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define and execute the SQL query
    $sql = "SELECT * FROM `user`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch all results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<div class="crud-1 text-center">
    <table class="table">
        <thead class="table">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <!-- <th scope="col">Date of Create</th> -->
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($results)) {
                foreach ($results as $row) {
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["iduser"]); ?></td>
                        <td><?php echo htmlspecialchars($row["username"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["phone"]); ?></td> 
                        
                        <td>
                        <a href="edit.php?iduser=<?php echo htmlspecialchars($row["iduser"]); ?>"><i class="bi bi-pencil-square text-primary"></i></a>
                        <a href="delete.php?iduser=<?php echo htmlspecialchars($row["iduser"]); ?>"><i class="bi bi-trash3-fill text-danger"></i></a>
                    </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

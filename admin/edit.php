<?php
include "connect.php";

// Check if form is submitted
if (isset($_POST['submit'])) {
    $id = $_POST['id']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $enrollNumber = $_POST['enrollnumber'];
    $dateOfCreate = $_POST['date'];


    $sql = "UPDATE `crud` SET Name=?, Email=?, Phone=?, `Enroll Number`=?, `Date of create`=? WHERE id=?";
    $stmt = mysqli_prepare($dbs, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $phone, $enrollNumber, $dateOfCreate, $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        
        header("Location: index.php?success=user_updated");
        exit();
    } else {
        
        echo "Error updating record: " . mysqli_error($dbs);
        exit();
    }
}

// Fetch user 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details from the database based on ID
    $sql = "SELECT * FROM `crud` WHERE id=?";
    $stmt = mysqli_prepare($dbs, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (!$result) {
        die("Query failed: " . mysqli_error($dbs));
    }
    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['Name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $enrollNumber = $row['Enroll Number'];
        $dateOfCreate = $row['Date of create'];
    } else {
        header("Location: index.php?error=user_not_found");
        exit();
    }
} else {
   
    header("Location: index.php?error=id_not_provided");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="text-center mb-4 bg-info">
            <h3>Edit User</h3>
            <p class="text-muted">Update the form below to edit the user</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Hidden input -->
                    <div class="col">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $name; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" value="<?php echo $email; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone:</label>
                        <input type="tel" class="form-control" name="phone" placeholder="phone" value="<?php echo $phone; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Enroll Number:</label>
                        <input type="tel" class="form-control" name="enrollnumber" placeholder="Enroll number" value="<?php echo $enrollNumber; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Of Create :</label>
                        <input type="date" class="form-control" name="date" placeholder="date" value="<?php echo $dateOfCreate; ?>">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-download"></i> Save</button>
                        <a href="index.php" class="btn btn-danger"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
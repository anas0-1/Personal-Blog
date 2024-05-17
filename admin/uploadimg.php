<?php
class UploadImg {
    public static function upload($idarticle, $conn) {
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];
            $max_size = 4294967296; // 4GB

            if($size < $max_size) {
                try {
                    $image_data = file_get_contents($tmp_name);
                    $sql = "UPDATE article SET image = :image WHERE Idarticle = :Idarticle";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':image', $image_data, PDO::PARAM_LOB);
                    $stmt->bindParam(':Idarticle', $idarticle, PDO::PARAM_INT);
                    $stmt->execute();

                    echo "<p>Image uploaded successfully</p>";
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                throw new Exception("File size exceeds the maximum limit");
            }
        } else {
            throw new Exception("Failed to upload image");
        }
    }
}
?>

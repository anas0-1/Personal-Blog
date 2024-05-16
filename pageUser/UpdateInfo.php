<?php

class UpdateInfo {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateUsername($user_id, $new_username) {
        try {
            $stmt = $this->conn->prepare("UPDATE user SET username = :new_username WHERE iduser = :user_id");
            $stmt->bindParam(':new_username', $new_username);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return true; 
        } catch(PDOException $e) {
            // Handle any exceptions
            return false; 
        }
    }

    public function updateEmail($user_id, $new_email) {
        try {
            $stmt = $this->conn->prepare("UPDATE user SET email = :new_email WHERE iduser = :user_id");
            $stmt->bindParam(':new_email', $new_email);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return true; 
        } catch(PDOException $e) {
            // Handle any exceptions
            return false; 
        }
    }

    public function updatePassword($user_id, $new_password) {
        try {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE user SET password = :hashed_password WHERE iduser = :user_id");
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return true; 
        } catch(PDOException $e) {
            // Handle any exceptions
            return false; 
        }
    }

    public function updateUserImage($user_id, $imageData) {
        try {
            $stmt = $this->conn->prepare("UPDATE user SET image = :imageData WHERE iduser = :user_id");
            $stmt->bindParam(':imageData', $imageData, PDO::PARAM_LOB);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true; 
        } catch(PDOException $e) {
            // Handle any exceptions
            return false; 
        }
    }
    
} 
?>

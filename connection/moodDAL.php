<?php


require_once "database.php";


class MoodDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertMood($mood) {
        $sql = "INSERT INTO mood (id, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $mood->id, $mood->description);
        return $stmt->execute();
    }

    // Update method
    public function updateMood($mood) {
        $sql = "UPDATE mood SET description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $mood->description, $mood->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeMood($id) {
        $sql = "DELETE FROM mood WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
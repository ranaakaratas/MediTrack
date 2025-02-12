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
        return $stmt->execute([
            $mood->id,
            $mood->description
        ]);
    }

    // Update method
    public function updateMood($mood) {
        $sql = "UPDATE mood SET description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $mood->description,
            $mood->id
        ]);
    }

    // Remove method
    public function removeMood($id) {
        $sql = "DELETE FROM mood WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Get mood by ID
    public function getMoodById($id) {
        $query = $this->conn->prepare("SELECT * FROM mood WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Mood");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all moods
    public function getAllMoods() {
        $query = $this->conn->prepare("SELECT * FROM mood");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"Mood");
    }
}

?>

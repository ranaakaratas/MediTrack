<?php

require_once "database.php";

class ActivityDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertActivity($activity) {
        $sql = "INSERT INTO activity (id, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $activity->id, $activity->description);
        return $stmt->execute();
    }

    // Update method
    public function updateActivity($activity) {
        $sql = "UPDATE activity SET description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $activity->description, $activity->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeActivity($id) {
        $sql = "DELETE FROM activity WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Get activity by ID
    public function getActivityById($id) {
        $query = $this->conn->prepare("SELECT * FROM activity WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Activity");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all activities
    public function getAllActivities() {
        $query = $this->conn->prepare("SELECT * FROM activity");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"Activity");
    }
}

?>
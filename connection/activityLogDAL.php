<?php

require_once "database.php";

class ActivityLogDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertActivityLog($activityLog) {
        $sql = "INSERT INTO activitylog (id, activityId, timestamp) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $activityLog->id, $activityLog->activityId, $activityLog->timestamp);
        return $stmt->execute();
    }

    // Update method
    public function updateActivityLog($activityLog) {
        $sql = "UPDATE activitylog SET activityId = ?, timestamp = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isi", $activityLog->activityId, $activityLog->timestamp, $activityLog->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeActivityLog($id) {
        $sql = "DELETE FROM activitylog WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


?>
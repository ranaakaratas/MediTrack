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
        $sql = "INSERT INTO activitylog (id, activityId, timestamp, patientId) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisi", $activityLog->id, $activityLog->activityId, $activityLog->timestamp, $activityLog->patientId);
        return $stmt->execute();
    }

    // Update method
    public function updateActivityLog($activityLog) {
        $sql = "UPDATE activitylog SET activityId = ?, timestamp = ?, patientId = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isii", $activityLog->activityId, $activityLog->timestamp, $activityLog->patientId, $activityLog->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeActivityLog($id) {
        $sql = "DELETE FROM activitylog WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Get activity log by ID
    public function getActivityLogById($id) {
        $query = $this->conn->prepare("SELECT * FROM activitylog WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "ActivityLog");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all activity logs
    public function getAllActivityLogs() {
        $query = $this->conn->prepare("SELECT * FROM activitylog");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"ActivityLog");
    }

    public function getActivityLogsByPatientId($patientId) {
        $query = $this->conn->prepare("SELECT * FROM activitylog WHERE patientId = ?");
        $query->execute([$patientId]);
        return $query->fetchAll(PDO::FETCH_CLASS,"ActivityLog");
    }
}

?>

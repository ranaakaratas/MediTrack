<?php

require_once "database.php";

class MedicationLogDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertMedicationLog($medicationLog) {
        $sql = "INSERT INTO medicationlog (id, medicationId, timestamp, dosage, patientId) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisdi", $medicationLog->id, $medicationLog->medicationId, $medicationLog->timestamp, $medicationLog->dosage, $medicationLog->patientId);
        return $stmt->execute();
    }

    // Update method
    public function updateMedicationLog($medicationLog) {
        $sql = "UPDATE medicationlog SET medicationId = ?, timestamp = ?, dosage = ?, patientId = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isdii", $medicationLog->medicationId, $medicationLog->timestamp, $medicationLog->dosage, $medicationLog->patientId, $medicationLog->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeMedicationLog($id) {
        $sql = "DELETE FROM medicationlog WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Get medication log by ID
    public function getMedicationLogById($id) {
        $query = $this->conn->prepare("SELECT * FROM medicationlog WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "MedicationLog");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all medication logs
    public function getAllMedicationLogs() {
        $query = $this->conn->prepare("SELECT * FROM medicationlog");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"MedicationLog");
    }
}

?>

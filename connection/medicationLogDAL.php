<?php

require_once "database.php";

class MedicationLogDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }


    public function getMedicationsByDate($date) {
        $sql = "SELECT * FROM medicationlog WHERE DATE(timestamp) = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Insert method
    public function insertMedicationLog($medicationLog) {
        $sql = "INSERT INTO medicationlog (id, medicationId, dosage, timestamp, patientId) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $medicationLog->id,
            $medicationLog->medicationId,
            $medicationLog->dosage,
            $medicationLog->timestamp,
            $medicationLog->patientId
        ]);
    }

    // Update method
    public function updateMedicationLog($medicationLog) {
        $sql = "UPDATE medicationlog SET medicationId = ?, timestamp = ?, dosage = ?, patientId = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $medicationLog->medicationId,
            $medicationLog->timestamp,
            $medicationLog->dosage,
            $medicationLog->patientId,
            $medicationLog->id
        ]);
    }

    // Remove method
    public function removeMedicationLog($id) {
        $sql = "DELETE FROM medicationlog WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
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

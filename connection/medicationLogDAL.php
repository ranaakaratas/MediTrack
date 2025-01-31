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
        $sql = "INSERT INTO medicationlog (id, medicationId, timestamp, dosage) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisd", $medicationLog->id, $medicationLog->medicationId, $medicationLog->timestamp, $medicationLog->dosage);
        return $stmt->execute();
    }

    // Update method
    public function updateMedicationLog($medicationLog) {
        $sql = "UPDATE medicationlog SET medicationId = ?, timestamp = ?, dosage = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isdi", $medicationLog->medicationId, $medicationLog->timestamp, $medicationLog->dosage, $medicationLog->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeMedicationLog($id) {
        $sql = "DELETE FROM medicationlog WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getMedicationsByPatientId($patientId) {
        $query = $this->conn->prepare("
            SELECT medication.name, medicationlog.timestamp, medicationlog.dosage 
            FROM medicationlog 
            JOIN medication ON medicationlog.medicationId = medication.id 
            WHERE medicationlog.id IN (SELECT id FROM prescribedmedication WHERE patientId = ?)
        ");
        $query->execute([$patientId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
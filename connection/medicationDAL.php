<?php

require_once "database.php";

class MedicationDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertMedication($medication) {
        $sql = "INSERT INTO medication (id, name) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $medication->id,
            $medication->name
        ]);
    }

    // Update method
    public function updateMedication($medication) {
        $sql = "UPDATE medication SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $medication->name,
            $medication->id
        ]);
    }

    // Remove method
    public function removeMedication($id) {
        $sql = "DELETE FROM medication WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Get medication by ID
    public function getMedicationById($id) {
        $query = $this->conn->prepare("SELECT * FROM medication WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Medication");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all medications
    public function getAllMedications() {
        $query = $this->conn->prepare("SELECT * FROM medication");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"Medication");
    }
}

?>

<?php

require_once "dataAccess.php";


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
        $stmt->bind_param("is", $medication->id, $medication->name);
        return $stmt->execute();
    }

    // Update method
    public function updateMedication($medication) {
        $sql = "UPDATE medication SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $medication->name, $medication->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeMedication($id) {
        $sql = "DELETE FROM medication WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


?>
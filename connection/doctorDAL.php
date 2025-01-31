<?php

require_once "database.php";

class DoctorDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertDoctor($doctor) {
        $sql = "INSERT INTO doctor (id, name, specialty, contactInfo, hospital) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issss", $doctor->id, $doctor->name, $doctor->specialty, $doctor->contactInfo, $doctor->hospital);
        return $stmt->execute();
    }

    // Update method
    public function updateDoctor($doctor) {
        $sql = "UPDATE doctor SET name = ?, specialty = ?, contactInfo = ?, hospital = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $doctor->name, $doctor->specialty, $doctor->contactInfo, $doctor->hospital, $doctor->id);
        return $stmt->execute();
    }

    // Remove method
    public function removeDoctor($id) {
        $sql = "DELETE FROM doctor WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getDoctorById($doctorId) {
        $query = $this->conn->prepare("
            SELECT name, specialty, contactInfo, hospital 
            FROM doctor 
            WHERE id = ?
        ");
        $query->execute([$doctorId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
}

?>
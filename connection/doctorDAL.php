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
        $sql = "INSERT INTO doctor (id, name, specialty, contactInfo, hospital) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $doctor->id,
            $doctor->name,
            $doctor->specialty,
            $doctor->contactInfo,
            $doctor->hospital,
            $doctor->password
        ]);
    }

    // Update method
    public function updateDoctor($doctor) {
        $sql = "UPDATE doctor SET name = ?, specialty = ?, contactInfo = ?, hospital = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $doctor->name,
            $doctor->specialty,
            $doctor->contactInfo,
            $doctor->hospital,
            $doctor->password,
            $doctor->id
        ]);
    }

    // Remove method
    public function removeDoctor($id) {
        $sql = "DELETE FROM doctor WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Get doctor by ID
    public function getDoctorById($id) {
        $query = $this->conn->prepare("SELECT * FROM doctor WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Doctor");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all doctors
    public function getAllDoctors() {
        $query = $this->conn->prepare("SELECT * FROM doctor");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"Doctor");
    }

    // Check doctor login credentials
    public function checkDoctorLogin($contactInfo, $password) {
        $query = $this->conn->prepare("SELECT * FROM Doctor WHERE contactInfo = ? AND password = ?");
        $query->execute([$contactInfo, $password]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Doctor");
        return count($result) == 0 ? null : $result[0];
    }
}

?>
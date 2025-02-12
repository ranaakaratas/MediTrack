<?php

require "database.php";

class PatientDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertPatient($patient) {
        $sql = "INSERT INTO patient (id, dob, name, gender, phoneNo, medicalNotes, doctorId, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $patient->id,
            $patient->dob,
            $patient->name,
            $patient->gender,
            $patient->phoneNo,
            $patient->medicalNotes,
            $patient->doctorId,
            $patient->email,
            $patient->password
        ]);
    }

    // Update method
    public function updatePatient($patient) {
        $sql = "UPDATE patient SET dob = ?, name = ?, gender = ?, phoneNo = ?, medicalNotes = ?, doctorId = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $patient->dob,
            $patient->name,
            $patient->gender,
            $patient->phoneNo,
            $patient->medicalNotes,
            $patient->doctorId,
            $patient->email,
            $patient->password,
            $patient->id
        ]);
    }

    // Remove method
    public function removePatient($id) {
        $sql = "DELETE FROM patient WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Get patient by ID
    public function getPatientById($id) {
        $query = $this->conn->prepare("SELECT * FROM patient WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Patient");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all patients
    public function getAllPatients() {
        $query = $this->conn->prepare("SELECT * FROM patient");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"Patient");
    }

    // Check patient login credentials
    public function checkPatientLogin($email, $password) {
        $query = $this->conn->prepare("SELECT * FROM patient WHERE email = ? AND password = ?");
        $query->execute([$email, $password]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "Patient");
        return count($result) == 0 ? null : $result[0];
    }
}

?>
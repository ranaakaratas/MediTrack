<?php

require_once "database.php";

class PatientDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    public function getAllPatients()
    {
        $statement = $this->conn->prepare('SELECT name, dob, gender FROM patient');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, 'Patient');
        return $result; 
    }

    public function getPatientByEmail($email)
    {
        $statement = $this->conn->prepare('SELECT * FROM patient WHERE email = ?');
        $statement->execute([$email]);
        $result = $statement->fetchAll(PDO::FETCH_CLASS, 'Patient');
        return count($result) == 0 ? null : $result[0];
    }

    public function getPatientById($patientId) {
        $statement = $this->conn->prepare("SELECT * FROM patient WHERE id = ?");
        $statement->execute([$patientId]);
    
        // Fetch as an object
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Patient');
        $patient = $statement->fetch();
    
        return $patient ?: null; // Ensure null is returned if no patient is found
    }
    

}

?>
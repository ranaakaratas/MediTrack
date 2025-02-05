<?php
class Patient {
    // Private properties representing database fields
    private $id; // Unique identifier for the patient
    private $dob; // Date of birth of the patient
    private $name; // Patient's full name
    private $gender; // Gender of the patient
    private $phoneNo; // Contact number of the patient
    private $medicalNotes; // Medical notes related to the patient
    private $doctorId; // ID of the assigned doctor
    private $email; // Patient's email address
    private $password; // Patient's password for authentication

    private $doctor = null; // Doctor object representing the assigned doctor

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->dob, $this->name, $this->gender, $this->phoneNo, $this->medicalNotes, $this->doctorId, $this->email, $this->password";
    }

    // Magic method to get a property's value dynamically
    public function __get($name) {
        return $this->$name;
    }

    // Magic method to set a property's value dynamically
    public function __set($name, $value) {
        $this->$name = $value;
    }
}
?>

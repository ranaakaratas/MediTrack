<?php
class PrescribedMedication {
    // Private properties representing database fields
    private $id; // Unique identifier for the prescribed medication entry
    private $patientId; // ID of the patient receiving the medication
    private $doctorId; // ID of the doctor who prescribed the medication
    private $medicationId; // ID of the medication being prescribed

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->patientId, $this->doctorId, $this->medicationId";
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
<?php
class MedicationLog {
    // Private properties representing database fields
    private $id; // Unique identifier for the medication log entry
    private $medicationId; // ID of the medication being logged
    private $timestamp; // Time when the medication was administered
    private $dosage; // Dosage amount given to the patient
    private $patientId; // ID of the patient receiving the medication

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->medicationId, $this->timestamp, $this->dosage, $this->patientId";
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
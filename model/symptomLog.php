<?php
class SymptomLog {
    // Private properties representing database fields
    private $id; // Unique identifier for the symptom log entry
    private $symptomId; // ID referencing the symptom type
    private $severity; // Severity level of the symptom (integer scale)
    private $timestamp; // Time when the symptom was recorded
    private $patientId; // ID of the patient experiencing the symptom

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->symptomId, $this->severity, $this->timestamp, $this->patientId";
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
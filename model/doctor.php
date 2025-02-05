<?php
class Doctor {
    // Private properties representing database fields
    private $id; // Unique identifier for the doctor
    private $name; // Doctor's full name
    private $specialty; // Medical specialty of the doctor
    private $contactInfo; // Contact information (e.g., phone or email)
    private $hospital; // Hospital where the doctor works

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->name, $this->specialty, $this->contactInfo, $this->hospital";
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
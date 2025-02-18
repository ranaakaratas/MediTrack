<?php
class Symptom {
    // Private properties representing database fields
    private $id; // Unique identifier for the symptom entry
    private $description; // Description of the symptom

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->description";
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

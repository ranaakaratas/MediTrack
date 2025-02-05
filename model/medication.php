<?php
class Medication {
    // Private properties representing database fields
    private $id; // Unique identifier for the medication
    private $name; // Name of the medication

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->name";
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

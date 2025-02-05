<?php
class Activity {
    private $id;
    private $description;

    // Method to get full details
    public function getFullDetails() {
        return "$this->id, $this->description";
    }

    // Magic method to get property
    public function __get($name) {
        return $this->$name;
    }

    // Magic method to set property
    public function __set($name, $value) {
        $this->$name = $value;
    }
}
?>
<?php
class Patient {
    private $dob;
    private $name;
    private $gender;
    private $phoneNo;
    private $medicalNotes;
    private $doctorId;
    private $id;

    // Method to get full details
    public function getFullDetails() {
        return "$this->id, $this->name, $this->dob, $this->gender, $this->phoneNo, $this->medicalNotes";
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
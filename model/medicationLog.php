<?php

class MedicationLog {
    private $id;
    private $medicationId;
    private $timestamp;
    private $dosage;

    public function getFullDetails() {
        return "$this->id, $this->medicationId, $this->timestamp, $this->dosage";
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

?>
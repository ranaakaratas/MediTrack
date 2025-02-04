<?php

class SymptomLog {
    private $id;
    private $symptomId;
    private $severity;
    private $timestamp;

    public function getFullDetails() {
        return "$this->id, $this->symptomId, $this->severity, $this->timestamp";
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}
?>

<?php
class MoodLog {
    private $id;
    private $moodId;
    private $energyLevel;
    private $moodLevel;
    private $timestamp;

    // Method to get full details
    public function getFullDetails() {
        return "$this->id, $this->moodId, $this->energyLevel, $this->moodLevel, $this->timestamp";
    }

    // Magic method to get property
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    // Magic method to set property
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
?>
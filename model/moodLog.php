<?php
class MoodLog {
    // Private properties representing database fields
    private $id; // Unique identifier for the mood log entry
    private $moodId; // ID referencing the mood type
    private $energyLevel; // Energy level recorded (integer scale)
    private $moodLevel; // Mood level recorded (integer scale)
    private $timestamp; // Time when the mood was recorded
    private $patientId; // ID of the patient whose mood is logged

    private $mood = null; // Mood object representing the mood type
    private $patient = null; // Patient object representing the patient

    // Method to get full details as a formatted string
    public function getFullDetails() {
        return "$this->id, $this->moodId, $this->energyLevel, $this->moodLevel, $this->timestamp, $this->patientId";
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
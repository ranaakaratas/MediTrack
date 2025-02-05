<?php
class ActivityLog {
    private $id;
    private $activityId;
    private $timestamp;
    private $patientId;

    private $activity = null;
    private $patient = null;

    // Method to get full details
    public function getFullDetails() {
        return "$this->id, $this->activityId, $this->timestamp, $this->patientId";
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

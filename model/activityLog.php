<?php
class ActivityLog {
    private $id;
    private $activityId;
    private $timestamp;

    public function getFullDetails() {
        return "$this->id, $this->activityId, $this->timestamp";
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}

?>
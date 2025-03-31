<?php

require_once "database.php";

class MoodLogDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    public function getMoodsByDate($date) {
        $sql = "SELECT * FROM moodlog WHERE DATE(timestamp) = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
    }
    

    // Insert method
    public function insertMoodLog($moodLog) {
        $statement = $this->conn->prepare('INSERT INTO moodlog (id, moodId, energyLevel, moodLevel, timestamp, patientId) 
                            VALUES (?, ?, ?, ?, ?, ?)');
        $statement->execute([
            $moodLog->id,
            $moodLog->moodId,
            $moodLog->energyLevel,
            $moodLog->moodLevel,
            $moodLog->timestamp,
            $moodLog->patientId
        ]);

    return $this->conn->lastInsertId();
    }

    // Update method
    public function updateMoodLog($moodLog) {
        $sql = "UPDATE moodlog SET moodId = ?, energyLevel = ?, moodLevel = ?, timestamp = ?, patientId = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $moodLog->moodId, 
            $moodLog->energyLevel, 
            $moodLog->moodLevel, 
            $moodLog->timestamp, 
            $moodLog->patientId, 
            $moodLog->id
        ]);
    }

    // Remove method
    public function removeMoodLog($id) {
        $sql = "DELETE FROM moodlog WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    /* public function getMoodsByDate($date) {
        $query = "SELECT * FROM moodLog WHERE DATE(timestamp) = :date ORDER BY timestamp DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } */

    
    
    // Get mood log by ID
    public function getMoodLogById($id) {
        $query = $this->conn->prepare("SELECT * FROM moodlog WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_CLASS, "MoodLog");
        return count($result) == 0 ? null : $result[0];
    }

    // Get all mood logs
    public function getAllMoodLogs() {
        $query = $this->conn->prepare("SELECT * FROM moodlog");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,"MoodLog");
    }

    public function getMoodLogsByPatientId($patientId) {
        $query = $this->conn->prepare("SELECT * FROM moodlog WHERE patientId = ?");
        $query->execute([$patientId]);
        return $query->fetchAll(PDO::FETCH_CLASS,"MoodLog");
    }

    public function getMoodLogsByPatientIdAndDate($patientId, $date) {
        $query = $this->conn->prepare("SELECT * FROM moodlog WHERE patientId = ? AND DATE(`timestamp`) = ?");
        $query->execute([$patientId, $date]);
        return $query->fetchAll(PDO::FETCH_CLASS, "MoodLog");
    }
   
    public function getLogsByPatientId($patientId) {
        $query = $this->conn->prepare("SELECT * FROM moodLog WHERE patientId = ?");
        $query->execute([$patientId]);
        return $query->fetchAll(PDO::FETCH_CLASS, "MoodLog");
    }
    
    public function getMoodLogsByPatientIdBetweenDates($patientId, $startDate, $endDate) {
        $query = $this->conn->prepare("SELECT * FROM moodlog WHERE patientId = ? AND DATE(timestamp) BETWEEN ? AND ?");
        $query->execute([$patientId, $startDate, $endDate]);
        return $query->fetchAll(PDO::FETCH_CLASS, "MoodLog");
    }
    
}

?>
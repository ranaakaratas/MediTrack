<?php


require_once "database.php";


class MoodLogDAL {
    private $conn;

    public function __construct() {
        $db = Database::getInstance(); // Get the singleton instance
        $this->conn = $db->getConnection(); // Get the PDO connection
    }

    // Insert method
    public function insertMoodLog($moodLog) {

        $statement = $this->conn->prepare(
            "INSERT INTO moodlog (moodId, energyLevel, moodLevel, timestamp) VALUES (?, ?, ?, ?)"
        );
        print_r($statement);
        $statement->execute([
            $moodLog->moodId, 
            $moodLog->energyLevel, 
            $moodLog->moodLevel, 
            $moodLog->timestamp
        ]);
        
        return $this->conn->lastInsertId();

    }

    // Update method
    public function updateMoodLog($moodLog) {
        $sql = "UPDATE moodlog SET moodId = ?, energyLevel = ?, moodLevel = ?, timestamp = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiiii", $moodLog->moodId, $moodLog->energyLevel, $moodLog->moodLevel, $moodLog->timestamp, $moodLog->id);
        return $stmt->execute();
    }


    public function getMoodsByPatientId($patientId) {
        $query = $this->conn->prepare("
            SELECT mood.description AS mood, moodlog.energyLevel, moodlog.moodLevel, moodlog.timestamp 
            FROM moodlog 
            JOIN mood ON moodlog.moodId = mood.id 
            WHERE moodlog.id = ?
        ");
        $query->execute([$patientId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
<?php

$title = "Log your mood";
$page = "addmood_view.php";

require_once 'model/patient.php';
require_once 'model/mood.php';
require_once 'model/moodLog.php';
require_once 'connection/moodLogDAL.php';
require_once 'connection/moodDAL.php';

session_start();

// Ensure user is logged in
if (!isset($_SESSION['patient'])) {
    header("Location: login.php");
    exit();
}

$patient = $_SESSION['patient'];

// Get all moods from the database
$moodDAL = new MoodDAL();
$moods = $moodDAL->getAllMoods();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $moodId = $_POST['moodId'] ?? null;
    $energy_level = $_POST['energy_level'] ?? null;
    $mood_level = $_POST['mood_level'] ?? null;

    // Validate inputs
    if (!$moodId || !$energy_level || !$mood_level) {
        $error_message = "All fields are required!";
    } else {
        // Create a Mood object
        $moodLog = new MoodLog();
        $moodLog->moodId = $moodId;
        $moodLog->energyLevel = $energy_level;
        $moodLog->moodLevel = $mood_level;
        $moodLog->timestamp = date('Y-m-d H:i:s');
        $moodLog->patientId = $patient->id;

        // Insert into database
        $moodLogDAL = new MoodLogDAL();
        $lastMoodId = $moodLogDAL->insertMoodLog($moodLog);

        if ($lastMoodId) {
            // Redirect after successful insertion
            header("Location: home.php?success=Mood logged successfully");
            exit();
        } else {
            $error_message = "Failed to log mood. Please try again.";
        }
    }
}

require_once "view/master_view.php";
?>

<?php

$title = "Log your mood";
$page = "addmood_view.php";

require_once 'model/moodLog.php';
require_once 'connection/moodLogDAL.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve data from form
$patient_id = $_SESSION['patient_id'];

if (!empty($_POST)) {
    $moodId = $_POST['moodId'] ?? null;
    $energy_level = $_POST['energy_level'] ?? null;
    $mood_level = $_POST['mood_level'] ?? null;

    // Create a Mood object
    $moodLog = new MoodLog();
    $moodLog->__set('moodId', $moodId);
    $moodLog->__set('energyLevel', $energy_level);
    $moodLog->__set('moodLevel', $mood_level);
    $moodLog->__set('timestamp', date('Y-m-d H:i:s'));

    // Insert into database
    $moodLogDAL = new MoodLogDAL();
    $lastMoodId = $moodLogDAL->insertMoodLog($moodLog);

    // Redirect after insertion
    header("Location: home.php?success=Mood logged successfully");
    exit();
}

require_once "view/master_view.php";

?>
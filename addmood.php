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
//print_r($patient);

// Get all moods from the database
$moodDAL = new MoodDAL();
$moods = $moodDAL->getAllMoods();

if (!empty($_REQUEST)) {
    $moodId = $_REQUEST['moodId'] ?? null;
    $energy_level = $_REQUEST['energy_level'] ?? null;
    $mood_level = $_REQUEST['mood_level'] ?? null;

    // Create a Mood object
    $moodLog = new MoodLog();
    $moodLog->moodId = $moodId;
    $moodLog->energyLevel = $energy_level;
    $moodLog->moodLevel = $mood_level;
    $moodLog->timestamp = date('Y-m-d H:i:s');
    $moodLog->patientId = $patient->id;

    //print_r($moodLog);

    // Insert into database
    $moodLogDAL = new MoodLogDAL();
    $lastMoodId = $moodLogDAL->insertMoodLog($moodLog);

    // Redirect after insertion
    header("Location: home.php?success=Mood logged successfully");
    exit();
}

require_once "view/master_view.php";
?>
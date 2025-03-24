<?php

require "model/patient.php";
require "model/moodLog.php";
require "model/activityLog.php";
require "model/medicationLog.php";
require "model/doctor.php";
require "model/mood.php";
require "model/activity.php";


$title = "MediTrack Home Page";
$page = "index_view.php";

session_start();

if (!isset($_SESSION["patient"])) {
    header("Location: login.php"); // Redirect if not authenticated
    exit();
}


require_once "connection/patientDAL.php";
require_once "connection/moodLogDAL.php";
require_once "connection/activityLogDAL.php"; 
require_once "connection/medicationLogDAL.php";
require_once "connection/doctorDAL.php";
require_once "connection/moodDAL.php";
require_once "connection/activityDAL.php";
require_once "connection/medicationDAL.php";


// Get selected date from URL or default to today
$selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$formatted_date = date('Y-m-d', strtotime($selected_date));


$patientDAL = new PatientDAL();
$moodLogDAL = new MoodLogDAL();
$activityLogDAL = new ActivityLogDAL();
$medicationLogDAL = new MedicationLogDAL();
$doctorDAL = new DoctorDAL();
$moodDAL = new MoodDAL();
$activityDAL = new ActivityDAL();
$medicationDAL = new MedicationDAL();

// Fetch patient details
$patient = $_SESSION["patient"];
// Fetch moods for the selected date
$selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');


// Fetch logs for selected date
$mood_result = $moodLogDAL->getMoodsByDate($formatted_date);
$activity_result = $activityLogDAL->getActivitiesByDate($formatted_date);
$medication_result = $medicationLogDAL->getMedicationsByDate($formatted_date);



// Fetch mood logs
$moodLogs = $moodLogDAL->getMoodLogsByPatientIdAndDate($patient->id, $selectedDate);
foreach ($moodLogs as $moodLog) {
    $moodLog->patient = $patient; // Add patient object to mood log
    $moodLog->mood = $moodDAL->getMoodById($moodLog->moodId); // Add mood object to mood log
}

// Fetch the activity logs
$activityLogs = $activityLogDAL->getActivityLogsByPatientIdAndDate($patient->id, $selectedDate);
foreach ($activityLogs as $activityLog) {
    $activityLog->patient = $patient; // Add patient object to activity log
    $activityLog->activity = $activityDAL->getActivityById($activityLog->activityId); // Add activity object to activity log
}

// Fetch the medication logs
$medicationLogs = $medicationLogDAL->getMedicationLogsByPatientIdAndDate($patient->id, $selectedDate);
foreach ($medicationLogs as $medicationLog) {
    $medicationLog->patient = $patient; // Add patient object to medication log
    $medicationLog->medication = $medicationDAL->getMedicationById($medicationLog->id); // Add medication object to medication log
}

$doctor = $doctorDAL->getDoctorById($patient->doctorId);
//$patient->doctor = $doctor;




require_once "view/master_view.php";


?>
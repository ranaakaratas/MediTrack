<?php

require "model/patient.php";
require "model/moodLog.php";
require "model/activityLog.php";
require "model/medicationLog.php";
require "model/doctor.php";
require "model/mood.php";
require "model/activity.php";

$title = "MediTrack Home Page";
$page = "home_view.php";

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

$patientDAL = new PatientDAL();
$moodLogDAL = new MoodLogDAL();
$activityLogDAL = new ActivityLogDAL();
$medicationLogDAL = new MedicationLogDAL();
$doctorDAL = new DoctorDAL();
$moodDAL = new MoodDAL();
$activityDAL = new ActivityDAL();

// Fetch patient details
$patient = $_SESSION["patient"];

// Fetch mood logs
$moodLogs = $moodLogDAL->getMoodLogsByPatientId($patient->id);
foreach ($moodLogs as $moodLog) {
    $moodLog->patient = $patient; // Add patient object to mood log
    $moodLog->mood = $moodDAL->getMoodById($moodLog->moodId); // Add mood object to mood log
}

// Fetch the activity logs
$activityLogs = $activityLogDAL->getActivityLogsByPatientId($patient->id);
foreach ($activityLogs as $activityLog) {
    $activityLog->patient = $patient; // Add patient object to activity log
    $activityLog->activity = $activityDAL->getActivityById($activityLog->activityId); // Add activity object to activity log
}

$doctor = $doctorDAL->getDoctorById($patient->doctorId);
//$patient->doctor = $doctor;



require_once "view/master_view.php";


?>
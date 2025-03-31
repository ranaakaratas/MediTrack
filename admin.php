<?php

require "model/doctor.php";
require "model/patient.php";
require "model/moodLog.php";
require "model/mood.php";
require "connection/patientDAL.php";
require "connection/moodLogDAL.php";
require "connection/moodDAL.php";
require "connection/activityLogDAL.php";
require "connection/activityDAL.php";
require "connection/medicationLogDAL.php";
require "connection/medicationDAL.php";
require "model/activity.php";
require "model/activityLog.php";
require "model/medicationLog.php";
require "model/medication.php";

$title = "MediTrack Admin Page";
$page = "admin_view.php";

session_start();

// Ensure doctor is logged in
if (!isset($_SESSION['doctor'])) {
    header("Location: adminlogin.php");
    exit();
}

$doctorId = $_SESSION['doctor']->id;
$patientDAL = new patientDAL();
$patients = $patientDAL->getPatientsByDoctorId($doctorId); // Get doctor’s assigned patients

$logs = [];
$selectedPatient = null;

if (isset($_GET['patient_id'])) {
    $selectedPatientId = $_GET['patient_id'];
    $selectedDate = $_GET['date'] ?? date('Y-m-d'); // Default to today

    // Find selected patient object
    foreach ($patients as $p) {
        if ($p->id == $selectedPatientId) {
            $selectedPatient = $p;
            break;
        }
    }

// Load mood logs for the patient on selected date
$moodLogDAL = new MoodLogDAL();
$logs = $moodLogDAL->getMoodLogsByPatientIdAndDate($selectedPatientId, $selectedDate);

// Attach mood description from mood table
$moodDAL = new MoodDAL();
foreach ($logs as $log) {
    $log->mood = $moodDAL->getMoodById($log->moodId); // Add full mood object to each log
}

// Load activity logs for selected date
$activityLogDAL = new ActivityLogDAL();
$activityDAL = new ActivityDAL();
$activityLogs = $activityLogDAL->getActivityLogsByPatientIdAndDate($selectedPatientId, $selectedDate);

foreach ($activityLogs as $activityLog) {
    $activityLog->activity = $activityDAL->getActivityById($activityLog->activityId);
}

// Load medication logs for selected date
$medicationLogDAL = new MedicationLogDAL();
$medicationDAL = new MedicationDAL();
$medicationLogs = $medicationLogDAL->getMedicationLogsByPatientIdAndDate($selectedPatientId, $selectedDate);

foreach ($medicationLogs as $medicationLog) {
    $medicationLog->medication = $medicationDAL->getMedicationById($medicationLog->medicationId);
}



}

require_once "view/master_view.php";
?>

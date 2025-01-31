<?php

require_once "model/patient.php";

$title = "MediTrack Home Page";
$page = "home_view.php";

session_start();

if (!isset($_SESSION["patient_id"])) {
    header("Location: login.php"); // Redirect if not authenticated
    exit();
}

require_once "connection/patientDAL.php";
require_once "connection/moodLogDAL.php";
require_once "connection/activityLogDAL.php";
require_once "connection/medicationLogDAL.php";
require_once "connection/doctorDAL.php";

$patientDAL = new PatientDAL();
$moodLogDAL = new MoodLogDAL();
$activityLogDAL = new ActivityLogDAL();
$medicationLogDAL = new MedicationLogDAL();
$doctorDAL = new DoctorDAL();

// Fetch patient details
$patient = $patientDAL->getPatientById($_SESSION["patient_id"]);
if (!$patient) {
    echo "Error retrieving patient details.";
    exit();
}

// Fetch associated data
$moods = $moodLogDAL->getMoodsByPatientId($patient->id);
$activities = $activityLogDAL->getActivitiesByPatientId($patient->id);
$medications = $medicationLogDAL->getMedicationsByPatientId($patient->id);
$doctor = $doctorDAL->getDoctorById($patient->doctorId);




require_once "view/master_view.php";


?>
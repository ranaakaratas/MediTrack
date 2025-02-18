<?php

$title = "Log your medication";
$page = "addmedication_view.php";

require_once 'model/patient.php';
require_once 'model/medication.php';
require_once 'model/medicationLog.php';
require_once 'connection/medicationLogDAL.php';
require_once 'connection/medicationDAL.php';


session_start();

// Ensure user is logged in
if (!isset($_SESSION['patient'])) {
    header("Location: login.php");
    exit();
}

$patient = $_SESSION['patient'];

// Get all medications from the database
$medicationDAL = new MedicationDAL();
$medications = $medicationDAL->getAllMedications();

if (!empty($_REQUEST)) {
    $medicationId = $_REQUEST['medicationId'] ?? null;

    // Create a MedicationLog object
    $medicationLog = new MedicationLog();
    $medicationLog->medicationId = $medicationId;
    $medicationLog->dosage = $dosage;
    $medicationLog->timestamp = date('Y-m-d H:i:s');
    $medicationLog->patientId = $patient->id;

    // Insert into database
    $medicationLogDAL = new MedicationLogDAL();
    $lastMedicationId = $medicationLogDAL->insertMedicationLog($medicationLog);

    // Redirect after insertion
    header("Location: home.php?success=Medication logged successfully");
    exit();
}

require_once "view/master_view.php";
?>

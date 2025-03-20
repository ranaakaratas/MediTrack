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

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicationId = $_POST['medicationId'] ?? null;
    $dosage = $_POST['dosage'] ?? null;

    // Validate inputs
    if (!$medicationId || !$dosage) {
        $error_message = "All fields are required!";
    } else {
        // Create a MedicationLog object
        $medicationLog = new MedicationLog();
        $medicationLog->medicationId = $medicationId;
        $medicationLog->dosage = $dosage;
        $medicationLog->timestamp = date('Y-m-d H:i:s');
        $medicationLog->patientId = $patient->id;

        // Insert into database
        $medicationLogDAL = new MedicationLogDAL();
        $lastMedicationId = $medicationLogDAL->insertMedicationLog($medicationLog);

        if ($lastMedicationId) {
            // Redirect after successful insertion
            header("Location: index.php?success=Medication logged successfully");
            exit();
        } else {
            $error_message = "Failed to log medication. Please try again.";
        }
    }
}

require_once "view/master_view.php";
?>

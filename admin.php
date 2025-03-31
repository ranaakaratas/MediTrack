<?php

require "model/doctor.php";
require 'model/patient.php';
require "connection/patientDAL.php";
require_once "model/moodLog.php";
require "connection/moodLogDAL.php"; 

$title = "MediTrack Admin Page";
$page = "admin_view.php";

session_start();

// Assuming the doctor's ID is stored in session after login
if (!isset($_SESSION['doctor'])) {
    header("Location: adminlogin.php");
    exit();
}

$doctorId = $_SESSION['doctor']->id; // Get the logged-in doctor's ID
$patientDAL = new patientDAL();
$patients = $patientDAL->getPatientsByDoctorId($doctorId); // from patientDAL.php

$logs = [];

if (isset($_GET['patient_id'])) {
    $selectedPatientId = $_GET['patient_id'];
   
    $logDAL = new MoodLogDAL();                
    $logs = $logDAL->getLogsByPatientId($selectedPatientId); 
}

require_once "view/master_view.php";
?>


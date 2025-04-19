<?php

require "connection/patientDAL.php";
require "connection/doctorDAL.php";
require "model/doctor.php";
require "model/patient.php";

$title = "MediTrack Sign Up";
$page = "signup_view.php";

// Get all moods from the database
$doctorDAL = new DoctorDAL();
$doctors = $doctorDAL->getAllDoctors();


if (
    isset($_REQUEST['name']) &&
    isset($_REQUEST['dob']) &&
    isset($_REQUEST['gender']) &&
    isset($_REQUEST['phoneNo']) &&
    isset($_REQUEST['medicalNotes']) &&
    isset($_REQUEST['doctorId']) &&
    isset($_REQUEST['email']) &&
    isset($_REQUEST['password'])
) {
    //create a new patient object and set its properties
    $patient = new Patient();
    $patient->id = null; // assuming auto-increment in DB
    $patient->name = $_REQUEST['name'];
    $patient->dob = $_REQUEST['dob'];
    $patient->gender = $_REQUEST['gender'];
    $patient->phoneNo = $_REQUEST['phoneNo'];
    $patient->medicalNotes = $_REQUEST['medicalNotes'];
    $patient->doctorId = $_REQUEST['doctorId'];
    $patient->email = $_REQUEST['email'];
    $patient->password = $_REQUEST['password'];

    // add the patient to the database
    $dal = new PatientDAL();
    $success = $dal->insertPatient($patient);
    
    // Check if the insertion was successful
    if ($success) {
        session_start(); // Start the session
        $_SESSION['patient'] = $patient;
        header("Location: index.php");
    } else {
        $error = "Signup failed. Please try again.";
        header("Location: signup.php");
    }
} 


require_once "view/master_view.php";

?>

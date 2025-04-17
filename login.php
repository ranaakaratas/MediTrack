<?php

require "model/patient.php";
require "connection/patientDAL.php";

$title = "MediTrack Login";
$page = "login_view.php";

session_start();

if (isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
{
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $patientDAL = new PatientDAL();
    
    $patient = $patientDAL->checkPatientLogin($email, $password); // Check if the patient exists
    
    if ($patient != null)
    {
        // Store the logged-in patient in the session
        $_SESSION["patient"] = $patient;
        
        //Redirect to the personalized home page
        header("Location: index.php");
        exit();
    }
    else
    {
        $error = "Invalid email or password";
    }
}
require_once "view/master_view.php";
?>
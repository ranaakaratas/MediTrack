<?php
require_once 'model/doctor.php';
require_once 'connection/doctorDAL.php';

$title = "MediTrack Clinician Login";
$page = "adminlogin_view.php";

session_start();

if (isset($_REQUEST["contactInfo"]) && isset($_REQUEST["password"]))
{
    $contactInfo = $_REQUEST["contactInfo"];
    $password = $_REQUEST["password"];
    $doctorDAL = new DoctorDAL();
    
    $doctor = $doctorDAL->checkDoctorLogin($contactInfo, $password); // Check if the patient exists
    
    if ($doctor != null)
    {
        // Store the logged-in patient in the session
        $_SESSION["doctor"] = $doctor;
        
        //Redirect to the personalized home page
        header("Location: admin.php");
        exit();
    }
    else
    {
        $error = "Invalid email or password";
        echo("Login failed");
    }
    
}

require_once 'view/master_view.php';
?>
<?php

require_once "model/patient.php";
require_once "connection/patientDAL.php";

$title = "MediTrack Login";
$page = "login_view.php";

session_start();

$patientDAL = new PatientDAL();


if (isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
{
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    
    $patient = $patientDAL->getPatientByEmail($email);
    

    if ($patient != null && $patient->password == $password)
    {
        // Store the logged-in patient in the session
        $_SESSION["patient"] = $patient;
        $_SESSION["patient_id"] = $patient->id;
        $_SESSION["patient_email"] = $patient->email;
        
        // Redirect to the personalized home page
        header("Location: home.php");
        exit();
    }

    else
    {
        $error = "Invalid email or password";
        echo("Login failed");
    }
}


require_once "view/master_view.php";

?>
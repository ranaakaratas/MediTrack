<?php

require_once "model/patient.php";
require_once "connection/patientDAL.php";

$title = "MediTrack Login";
$page = "test_view.php";

session_start();

$patientDAL = new PatientDAL();


if (isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
{
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    
    $patient = $patientDAL->getPatientByEmail($email);
    
    if ($patient != null && $patient->password == $password)
    {
        $_SESSION["patient"] = $patient;
        echo("Login successful");

        // here users need to be directed to the home page
        // add that once you have the home page

    }
    else
    {
        $error = "Invalid email or password";
        echo("Login failed");
    }
}


require_once "view/master_view.php";

?>
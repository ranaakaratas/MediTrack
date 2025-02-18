<?php
require "model/patient.php";
require "connection/patientDAL.php";


$title = "MediTrack Sign Up";
$page = "signup_view.php";

session_start();

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $patientDAL = new PatientDAL();

    if ($patientDAL->checkPatientLogin($email, $_POST["password"]) === null) {
        $patientDAL->createPatient($email, $password);
        header("Location: login_view.php?signup=success");
        exit();
    } else {
        header("Location: signup_view.php?error=email_exists");
        exit();
    }
}

require_once "view/master_view.php";

?>

<?php

$title = "Log your activity";
$page = "addactivity_view.php";

require_once 'model/patient.php';
require_once 'model/activity.php';
require_once 'model/activityLog.php';
require_once 'connection/activityLogDAL.php';
require_once 'connection/activityDAL.php';


session_start();

// Ensure user is logged in
if (!isset($_SESSION['patient'])) {
    header("Location: login.php");
    exit();
}

$patient = $_SESSION['patient'];
//print_r($patient);

// Get all activities from the database
$activityDAL = new ActivityDAL();
$activities = $activityDAL->getAllActivities();

if (!empty($_REQUEST)) {
    $activityId = $_REQUEST['activityId'] ?? null;

    // Create a Mood object
    $activityLog = new ActivityLog();
    $activityLog->activityId = $activityId;
    $activityLog->timestamp = date('Y-m-d H:i:s');
    $activityLog->patientId = $patient->id;

    //print_r($activityLog);

    // Insert into database
    $activityLogDAL = new ActivityLogDAL();
    $lastActivityId = $activityLogDAL->insertActivityLog($activityLog);

    // Redirect after insertion
    header("Location: home.php?success=Activity logged successfully");
    exit();
}

require_once "view/master_view.php";
?>
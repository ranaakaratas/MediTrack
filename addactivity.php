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

// Get all activities from the database
$activityDAL = new ActivityDAL();
$activities = $activityDAL->getAllActivities();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $activityId = $_POST['activityId'] ?? null;
    $date = $_POST['date'] ?? date("Y-m-d H:i:s");

    // Validate input
    if (!$activityId) {
        $error_message = "You must select an activity!";
    } else {
        // Create an ActivityLog object
        $activityLog = new ActivityLog();
        $activityLog->activityId = $activityId;
        $activityLog->timestamp = $date;
        $activityLog->patientId = $patient->id;

        // Insert into database
        $activityLogDAL = new ActivityLogDAL();
        $lastActivityId = $activityLogDAL->insertActivityLog($activityLog);

        if ($lastActivityId) {
            // Redirect after successful insertion
            header("Location: index.php?success=Activity logged successfully");
            exit();
        } else {
            $error_message = "Failed to log activity. Please try again.";
        }
    }
}

require_once "view/master_view.php";
?>

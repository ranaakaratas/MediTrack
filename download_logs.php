<?php
require "model/moodLog.php";
require "model/activityLog.php";
require "model/medicationLog.php";
require "connection/moodLogDAL.php";
require "connection/activityLogDAL.php";
require "connection/medicationLogDAL.php";
require "connection/activityDAL.php";
require "connection/medicationDAL.php";
require "connection/moodDAL.php";

if (!isset($_POST['patient_id'])) {
    die("Patient ID not provided.");
}

$patientId = $_POST['patient_id'];
$startDate = date('Y-m-d', strtotime('-30 days'));
$endDate = date('Y-m-d');

header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=\"patient_{$patientId}_logs.csv\"");
$output = fopen("php://output", "w");

// Add CSV headers
fputcsv($output, ['Type', 'Timestamp', 'Description', 'Details']);

// Fetch Mood Logs
$moodDAL = new MoodDAL();
$moodLogDAL = new MoodLogDAL();
$moodLogs = $moodLogDAL->getMoodLogsByPatientIdBetweenDates($patientId, $startDate, $endDate);
foreach ($moodLogs as $log) {
    $log->mood = $moodDAL->getMoodById($log->moodId);
    fputcsv($output, [
        'Mood',
        $log->timestamp,
        $log->mood->description ?? 'N/A',
        "Energy Level: {$log->energyLevel}"
    ]);
}

// Fetch Activity Logs
$activityDAL = new ActivityDAL();
$activityLogDAL = new ActivityLogDAL();
$activityLogs = $activityLogDAL->getActivityLogsByPatientIdBetweenDates($patientId, $startDate, $endDate);
foreach ($activityLogs as $log) {
    $log->activity = $activityDAL->getActivityById($log->activityId);
    fputcsv($output, [
        'Activity',
        $log->timestamp,
        $log->activity->name ?? 'N/A',
        "Duration: {$log->duration} mins"
    ]);
}

// Fetch Medication Logs
$medicationDAL = new MedicationDAL();
$medicationLogDAL = new MedicationLogDAL();
$medicationLogs = $medicationLogDAL->getMedicationLogsByPatientIdBetweenDates($patientId, $startDate, $endDate);
foreach ($medicationLogs as $log) {
    $log->medication = $medicationDAL->getMedicationById($log->medicationId);
    fputcsv($output, [
        'Medication',
        $log->timestamp,
        $log->medication->name ?? 'N/A',
        "Dosage: {$log->dosage}"
    ]);
}

fclose($output);
exit;
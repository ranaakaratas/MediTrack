<?php

require_once "dataAccess.php";

function getAllPatients()
{
    global $pdo;
    $statement = $pdo->prepare('SELECT name, dob, gender FROM patient');
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_CLASS, 'Patient');
    return $result;
}

function getPatientByEmail($email)
{
    global $pdo;
    $statement = $pdo->prepare('SELECT * FROM patient WHERE email = ?');
    $statement->execute([$email]);
    $result = $statement->fetchAll(PDO::FETCH_CLASS, 'Patient');
    return count($result) == 0 ? null : $result[0];
}

?>
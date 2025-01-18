<?php
// Accesses a relational database on the local server.

$db_user = "root";
$db_name = "k2109743";
$db_password = "";

$pdo = new PDO("mysql:host=localhost;dbname=$db_name",
                $db_user,$db_password);

?>

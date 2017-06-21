<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/event.php';

$database  = new Database();
$db        = $database->getConnection();
$jobStatus = new Event($db);
$json      = $Event->getAllStatuses();
echo($json);
?>

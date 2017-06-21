<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job.php';

$database = new Database();
$db       = $database->getConnection();
$job      = new Job($db);
$json     = $job->getAllJobs();
echo($json);
?>

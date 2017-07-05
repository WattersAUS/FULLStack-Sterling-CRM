<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job_status.php';

$database = new Database();
$db       = $database->getConnection();
$js       = new JobStatus($db);
$json     = $js->getManualJobStatuses();
echo($json);
?>

<?php
include_once '../config/database.php';
include_once '../objects/job_status.php';

$database      = new Database();
$db            = $database->getConnection();
$jobStatus     = new JobStatus($db);
$data          = json_decode(file_get_contents("php://input"));
$jobStatus->id = $data->id;
$jobStatus->readOne();

$jobStatus_arr[] = array(
    "id"          => $jobStatus->id,
    "description" => $jobStatus->description
);
print_r(json_encode($jobStatus_arr));
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job.php';

$data                 = json_decode(file_get_contents("php://input"));
$database             = new Database();
$db                   = $database->getConnection();
$job                  = new Job($db);
$job->site_id         = $data->site_id;
$job->employee_id     = $data->employee_id;
$job->status_id       = $data->status_id;
$job->customer_ref_no = $data->job_customer_ref_no;
$job->site_contact_id = $data->site_contact_id;
$job->job_description = $data->job_description;
$job->closed          = $data->closed;
$json                 = $job->insertJob();
echo($json);
?>

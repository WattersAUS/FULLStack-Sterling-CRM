<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job.php';

$data                     = json_decode(file_get_contents("php://input"));
$database                 = new Database();
$db                       = $database->getConnection();
$job                      = new Job($db);
$job->job_id              = $data->job_id;
$job->job_site_id         = $data->job_site_id;
$job->job_employee_id     = $data->job_employee_id;
$job->job_status_id       = $data->job_status_id;
$job->job_status_change   = $data->job_status_change;
$job->job_customer_ref_no = $data->job_customer_ref_no;
$job->job_site_contact_id = $data->job_site_contact_id;
$job->job_description     = $data->job_description;
$job->job_closed          = $data->job_closed;
$json                     = $job->updateJob();
echo($json);
?>

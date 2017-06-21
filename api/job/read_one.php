<?php
include_once '../config/database.php';
include_once '../objects/job.php';

$database     = new Database();
$db           = $database->getConnection();
$job          = new Job($db);
$data         = json_decode(file_get_contents("php://input"));
$job->job_id  = $data->job_id;
$job->readJob();

$job_arr[] = array(
    "job_id"                 => $job->job_id,
    "site_id"                => $job->site_id,
    "employee_id"            => $job->employee_id,
    "status_id"              => $job->status_id,
    "closed"                 => $job->closed,
    "date_updated"           => $job->date_updated,
    "site_name"              => $job->site_name,
    "customer_id"            => $job->customer_id,
    "customer_name"          => $job->customer_name,
    "employee_first_name"    => $job->employee_first_name,
    "employee_last_name"     => $job->employee_last_name,
    "job_status_description" => $job->job_status_description
);
print_r(json_encode($job_arr));
?>

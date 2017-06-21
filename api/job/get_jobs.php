<?php

include_once '../api/config/database.php';
include_once '../api/objects/job.php';

function getAllJobsRecords() {
    $database = new Database();
    $db       = $database->getConnection();
    $job      = new Job($db);
    $json     = $job->getAllJobs();
    return($json);
}
?>

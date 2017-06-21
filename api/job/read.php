<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job.php';
$database  = new Database();
$db        = $database->getConnection();
$job       = new Job($db);
$stmt      = $job->readAllJobs();
$num       = $stmt->rowCount();
$data      = "";

if ($num>0) {
    $x = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data .= '{';
        $data .= '"job_id":"'.$job_id.'",';
        $data .= '"site_id":"'.$site_id.'",';
        $data .= '"employee_id":"'.$employee_id.'",';
        $data .= '"status_id":"'.$status_id.'",';
        $data .= '"closed":"'.$closed.'",';
        $data .= '"date_updated":"'.$date_updated.'",';
        $data .= '"site_name":"'.$site_name.'",';
        $data .= '"customer_id":"'.$customer_id.'",';
        $data .= '"customer_name":"'.$customer_name.'",';
        $data .= '"employee_first_name":"'.$employee_first_name.'",';
        $data .= '"employee_last_name":"'.$employee_last_name.'",';
        $data .= '"job_status_description":"'.job_status_description.'"';
        $data .= '}';
        $data .= $x<$num ? ',' : '';
        $x++;
    }
}
echo '{"records":['.$data.']}';
?>

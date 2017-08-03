<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/quote_option.php';

$data               = json_decode(file_get_contents("php://input"));
$database           = new Database();
$db                 = $database->getConnection();
$qo                 = new QuoteOption($db);
$qo->qo_employee_id = $data->qo_employee_id;
$qo->qo_job_id      = $data->qo_job_id;
$qo->qo_description = $data->qo_description;
$json               = $qo->insertQuoteOption();
echo($json);
?>

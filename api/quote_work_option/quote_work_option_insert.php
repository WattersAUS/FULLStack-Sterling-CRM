<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/quote_work_option.php';

$data                     = json_decode(file_get_contents("php://input"));
$database                 = new Database();
$db                       = $database->getConnection();
$qwo                      = new QuoteWorkOption($db);
$qwo->qwo_quote_option_id = $data->qwo_quote_option_id;
$qwo->qwo_work_option_id  = $data->qwo_work_option_id;
$qwo->qwo_description     = $data->qwo_description;
$qwo->qwo_pricing         = $data->qwo_pricing;
$json                     = $qwo->insertQuoteWorkOption();
echo($json);
?>

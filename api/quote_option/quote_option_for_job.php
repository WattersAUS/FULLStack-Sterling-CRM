<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/quote_option.php';

$data        = json_decode(file_get_contents("php://input"));
$database    = new Database();
$db          = $database->getConnection();
$quoteOption = new QuoteOption($db);
$json        = $quoteOption->getQuoteOptionsForJob($data->job_id);
echo($json);
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/quote_work_option.php';

$data            = json_decode(file_get_contents("php://input"));
$database        = new Database();
$db              = $database->getConnection();
$quoteWorkOption = new QuoteWorkOption($db);
$json            = $quoteWorkOption->getQuoteWorkOptionByID($data->quote_work_option_id);
echo($json);
?>

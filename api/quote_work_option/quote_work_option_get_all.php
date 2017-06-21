<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/quote_work_option.php';

$database        = new Database();
$db              = $database->getConnection();
$quoteWorkOption = new QuoteWorkOption($db);
$json            = $quoteWorkOption->getAllQuoteWorkOptions();
echo($json);
?>

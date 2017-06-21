<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/quote_option.php';

$database    = new Database();
$db          = $database->getConnection();
$quoteOption = new QuoteOption($db);
$json        = $quoteOption->getAllQuoteOptions();
echo($json);
?>

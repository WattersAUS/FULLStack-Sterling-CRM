<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/work_option.php';

$database = new Database();
$db       = $database->getConnection();
$wo       = new WorkOption($db);
$json     = $wo->getAllWorkOptions();
echo($json);
?>

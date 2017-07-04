<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/division.php';

$database = new Database();
$db       = $database->getConnection();
$division = new Division($db);
$json     = $division->getAllDivisions();
echo($json);
?>

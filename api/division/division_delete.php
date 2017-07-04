<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/division.php';

$data                  = json_decode(file_get_contents("php://input"));
$database              = new Database();
$db                    = $database->getConnection();
$division              = new Division($db);
$division->division_id = $data->division_id;
$json                  = $division->deleteDivision();
echo($json);
?>

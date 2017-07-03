<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/work_option.php';

$data               = json_decode(file_get_contents("php://input"));
$database           = new Database();
$db                 = $database->getConnection();
$wo                 = new WorkOption($db);
$wo->work_option_id = $data->work_option_id;
$json               = $wo->deleteWorkOption();
echo($json);
?>

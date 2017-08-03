<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/work_option.php';

$data                             = json_decode(file_get_contents("php://input"));
$database                         = new Database();
$db                               = $database->getConnection();
$wo                               = new WorkOption($db);
$wo->work_option_id               = $data->work_option_id;
$wo->work_option_category_id      = $data->work_option_category_id;
$wo->work_option_code             = $data->work_option_code;
$wo->work_option_description      = $data->work_option_description;
$wo->work_option_default_quantity = $data->work_option_default_quantity;
$wo->work_option_default_pricing  = $data->work_option_default_pricing;
$json                             = $wo->updateWorkOption();
echo($json);
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/asset.php';

$data                               = json_decode(file_get_contents("php://input"));
$database                           = new Database();
$db                                 = $database->getConnection();
$asset                              = new Asset($db);
$asset->asset_id                    = $data->asset_id;
$asset->asset_employee_id           = $data->asset_employee_id;
$asset->asset_date_allocated        = $data->asset_date_allocated;
$asset->asset_allocated_employee_id = $data->asset_allocated_employee_id;
$json                               = $asset->allocateAsset();
echo($json);
?>

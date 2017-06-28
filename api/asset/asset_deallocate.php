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
$json                               = $asset->deallocateAsset();
echo($json);
?>

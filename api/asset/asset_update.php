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
$asset->asset_type_id               = $data->asset_type_id;
$asset->asset_employee_id           = $data->asset_employee_id;
$asset->asset_name                  = $data->asset_name;
$asset->asset_date_allocated        = $data->asset_date_allocated;
$asset->asset_date_to_service       = $data->asset_date_to_service;
$asset->asset_make                  = $data->asset_make;
$asset->asset_model                 = $data->asset_model;
$asset->asset_serial_number         = $data->asset_serial_number;
$asset->asset_internal_id           = $data->asset_internal_id;
$asset->asset_in_service_date       = $data->asset_in_service_date;
$asset->asset_purchase_date         = $data->asset_purchase_date;
$asset->asset_depreciation_years    = $data->asset_depreciation_years;
$asset->asset_depreciation_rate     = $data->asset_depreciation_rate;
$asset->asset_book_value            = $data->asset_book_value;
$asset->asset_supplier_id           = $data->asset_supplier_id;
$asset->asset_tracker_id            = $data->asset_tracker_id;
$asset->asset_allocated_employee_id = $data->asset_allocated_employee_id;
$asset->asset_allocation_status     = $data->asset_allocation_status;
$asset->asset_location              = $data->asset_location;
$asset->asset_notes                 = $data->asset_notes;
$asset->asset_condition             = $data->asset_condition;
$json                               = $asset->updateAsset();
echo($json);
?>

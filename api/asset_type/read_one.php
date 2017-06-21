<?php
include_once '../config/database.php';
include_once '../objects/asset_type.php';

$database      = new Database();
$db            = $database->getConnection();
$assetType     = new AssetType($db);
$data          = json_decode(file_get_contents("php://input"));
$assetType->id = $data->id;
$assetType->readOne();
$assetType_arr[] = array(
    "id"           => $assetType->id,
    "daysToReview" => $assetType->daysToReview,
    "type"         => $assetType->type
);
print_r(json_encode($assetType_arr));
?>

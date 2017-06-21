<?php
include_once '../config/database.php';
include_once '../objects/asset_type.php';

$database                = new Database();
$db                      = $database->getConnection();
$assetType               = new AssetType($db);
$data                    = json_decode(file_get_contents("php://input"));
$assetType->id           = $data->id;
$assetType->daysToReview = $data->daysToReview;
$assetType->type         = $data->type;
if ($assetType->update()) {
    echo "Asset Type was updated in System.";
} else {
    echo "Unable to update Asset Type in System.";
}
?>

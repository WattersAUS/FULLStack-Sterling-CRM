<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/asset_type.php';

// get database connection
$database               = new Database();
$db                     = $database->getConnection();
$assetType              = new AssetType($db);
$data                   = json_decode(file_get_contents("php://input"));
$assetType->id           = $data->id;
$assetType->daysToReview = $data->description;
$assetType->type         = $data->type;
if ($assetType->create()) {
    echo "Asset Type added to system.";
} else {
    echo "Unable to create Asset Type for system.";
}
?>

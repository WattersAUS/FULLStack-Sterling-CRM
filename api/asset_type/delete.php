<?php
include_once '../config/database.php';
include_once '../objects/asset_type.php';

$database          = new Database();
$db                = $database->getConnection();
$assetType         = new AssetType($db);
$data              = json_decode(file_get_contents("php://input"));
$assetType->id     = $data->id;
if ($assetType->delete()) {
    echo "Asset Type removed from System!";
} else {
    echo "Unable to remove Asset Type from System!";
}
?>

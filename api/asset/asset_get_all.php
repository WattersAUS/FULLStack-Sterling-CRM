<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/asset.php';

$database = new Database();
$db       = $database->getConnection();
$asset    = new Asset($db);
$json     = $asset->getAllAssets();
echo($json);
?>

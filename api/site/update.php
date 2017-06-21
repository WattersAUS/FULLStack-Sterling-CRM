<?php
include_once '../config/database.php';
include_once '../objects/site.php';

$database         = new Database();
$db               = $database->getConnection();
$site             = new Site($db);
$data             = json_decode(file_get_contents("php://input"));
$site->id         = $data->id;
$site->name       = $data->name;
$site->shortName  = $data->shortName;
$site->address1   = $data->address1;
$site->address2   = $data->address2;
$site->city       = $data->city;
$site->county     = $data->county;
$site->postcode   = $data->postcode;

if ($site->update()) {
    echo "Site was updated in System.";
} else {
    echo "Unable to update Site in System.";
}
?>

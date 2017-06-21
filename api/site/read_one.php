<?php
include_once '../config/database.php';
include_once '../objects/site.php';

$database = new Database();
$db       = $database->getConnection();
$site     = new Site($db);
$data     = json_decode(file_get_contents("php://input"));
$site->id = $data->id;
$site->readOne();

$site_arr[] = array(
    "id"          => $site->id,
    "customerId"  => $site->customerId,
    "name"        => $site->name,
    "shortName"   => $site->shortName,
    "address1"    => $site->address1,
    "address2"    => $site->address2,
    "city"        => $site->city,
    "county"      => $site->county,
    "postcode"    => $site->postcode
);
print_r(json_encode($site_arr));
?>

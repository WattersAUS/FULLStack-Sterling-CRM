<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/site.php';

// get database connection
$database         = new Database();
$db               = $database->getConnection();
$site             = new Site($db);
$data             = json_decode(file_get_contents("php://input"));
$site->customerId = $data->customerId;
$site->name       = $data->name;
$site->shortName  = $data->shortName;
$site->address1   = $data->address1;
$site->address2   = $data->address2;
$site->city       = $data->city;
$site->county     = $data->county;
$site->postcode   = $data->postcode;

$myfile = fopen("/tmp/debug.txt", "a") or die("Unable to open file!");
$txt  = "  Data: ".file_get_contents("php://input")."\n";
fwrite($myfile, $txt);
fclose($myfile);

if ($site->create()) {
    echo "Site added to System.";
} else {
    echo "Unable to create Site for System.";
}
?>

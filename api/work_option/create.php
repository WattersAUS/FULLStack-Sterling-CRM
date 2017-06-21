<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/work_option.php';

// get database connection
$database   = new Database();
$db         = $database->getConnection();
$workoption = new WorkOption($db);
$data       = json_decode(file_get_contents("php://input"));

$workoption->category_id     = $data->category_id;
$workoption->code            = $data->code;
$workoption->description     = $data->description;
$workoption->default_pricing = $data->default_pricing;

if ($workoption->create()) {
    echo "Work Option added to System.";
} else {
    echo "Unable to create Work Option for System.";
}
?>

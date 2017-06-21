<?php
include_once '../config/database.php';
include_once '../objects/work_option.php';

$database         = new Database();
$db               = $database->getConnection();
$workoption       = new WorkOption($db);
$data             = json_decode(file_get_contents("php://input"));

$workoption->id              = $data->id;
$workoption->category_id     = $data->category_id;
$workoption->code            = $data->code;
$workoption->description     = $data->description;
$workoption->default_pricing = $data->default_pricing;

if ($workoption->update()) {
    echo "Work Option was updated in System.";
} else {
    echo "Unable to update Work Option in System.";
}
?>

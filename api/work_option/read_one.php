<?php
include_once '../config/database.php';
include_once '../objects/work_option.php';

$database   = new Database();
$db         = $database->getConnection();
$workoption = new WorkOption($db);
$data       = json_decode(file_get_contents("php://input"));

$workoption->id = $data->id;
$workoption->readOne();

$workoption_arr[] = array(
    "id"              => $workoption->id,
    "category_id"     => $workoption->category_id,
    "code"            => $workoption->code,
    "description"     => $workoption->description,
    "default_pricing" => $workoption->default_pricing
);
print_r(json_encode($workoption_arr));
?>

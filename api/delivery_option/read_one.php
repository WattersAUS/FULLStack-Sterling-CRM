<?php
include_once '../config/database.php';
include_once '../objects/delivery_option.php';

$database           = new Database();
$db                 = $database->getConnection();
$deliveryOption     = new DeliveryOption($db);
$data               = json_decode(file_get_contents("php://input"));
$deliveryOption->id = $data->id;
$deliveryOption->readOne();

$delivery_arr[] = array(
    "id"          => $deliveryOption->id,
    "description" => $deliveryOption->description
);
print_r(json_encode($delivery_arr));
?>

<?php
include_once '../config/database.php';
include_once '../objects/delivery_option.php';

$database                    = new Database();
$db                          = $database->getConnection();
$deliveryOption              = new DeliveryOption($db);
$data                        = json_decode(file_get_contents("php://input"));
$deliveryOption->id          = $data->id;
$deliveryOption->description = $data->description;
if ($deliveryOption->update()) {
    echo "Delivery Option was updated in System.";
} else {
    echo "Unable to update Delivery Option in System.";
}
?>

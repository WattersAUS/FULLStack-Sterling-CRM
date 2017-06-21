<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/delivery_option.php';

// get database connection
$database                    = new Database();
$db                          = $database->getConnection();
$deliveryOption              = new DeliveryOption($db);
$data                        = json_decode(file_get_contents("php://input"));
$deliveryOption->id          = $data->id;
$deliveryOption->description = $data->description;

if ($deliveryOption->create()) {
    echo "Delivery Option added to system.";
} else {
    echo "Unable to create Delivery Option for system.";
}
?>

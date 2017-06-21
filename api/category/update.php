<?php
include_once '../config/database.php';
include_once '../objects/category.php';

$database              = new Database();
$db                    = $database->getConnection();
$category              = new Category($db);
$data                  = json_decode(file_get_contents("php://input"));
$category->id          = $data->id;
$category->description = $data->description;
$category->code        = $data->code;
if ($category->update()) {
    echo "Category was updated in System.";
} else {
    echo "Unable to update Category in System.";
}
?>

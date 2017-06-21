<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/category.php';

// get database connection
$database              = new Database();
$db                    = $database->getConnection();
$category              = new Category($db);
$data                  = json_decode(file_get_contents("php://input"));
$category->id          = $data->id;
$category->description = $data->description;
$category->code        = $data->code;
if ($category->create()) {
    echo "Category added to system.";
} else {
    echo "Unable to create Category for system.";
}
?>

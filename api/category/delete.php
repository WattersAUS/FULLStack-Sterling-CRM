<?php
include_once '../config/database.php';
include_once '../objects/category.php';

$database          = new Database();
$db                = $database->getConnection();
$category          = new Category($db);
$data              = json_decode(file_get_contents("php://input"));
$category->id      = $data->id;
if ($category->delete()) {
    echo "Category removed from System!";
} else {
    echo "Unable to remove Category from System!";
}
?>

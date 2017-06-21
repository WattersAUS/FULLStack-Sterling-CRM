<?php
include_once '../config/database.php';
include_once '../objects/category.php';

$database     = new Database();
$db           = $database->getConnection();
$category     = new Category($db);
$data         = json_decode(file_get_contents("php://input"));
$category->id = $data->id;
$category->readOne();

$category_arr[] = array(
    "id"          => $category->id,
    "description" => $category->description,
    "code"        => $category->code
);
print_r(json_encode($category_arr));
?>

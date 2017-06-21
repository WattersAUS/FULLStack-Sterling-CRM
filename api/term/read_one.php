<?php
include_once '../config/database.php';
include_once '../objects/term.php';

$database = new Database();
$db       = $database->getConnection();
$term     = new Term($db);
$data     = json_decode(file_get_contents("php://input"));
$term->id = $data->id;
$term->readOne();

$term_arr[] = array(
    "id"          => $term->id,
    "description" => $term->description,
    "days"        => $term->days
);
print_r(json_encode($term_arr));
?>

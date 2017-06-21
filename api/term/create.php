<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/term.php';

// get database connection
$database          = new Database();
$db                = $database->getConnection();
$term              = new Term($db);
$data              = json_decode(file_get_contents("php://input"));
$term->id          = $data->id;
$term->description = $data->description;
$term->days        = $data->days;

if ($term->create()) {
    echo "Term added to system.";
} else {
    echo "Unable to create Term for system.";
}
?>

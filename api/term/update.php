<?php
include_once '../config/database.php';
include_once '../objects/term.php';

$database          = new Database();
$db                = $database->getConnection();
$term              = new Term($db);
$data              = json_decode(file_get_contents("php://input"));
$term->id          = $data->id;
$term->description = $data->description;
$term->days        = $data->days;
if ($term->update()) {
    echo "Term was updated in System.";
} else {
    echo "Unable to update Term in System.";
}
?>

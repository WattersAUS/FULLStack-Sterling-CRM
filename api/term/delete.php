<?php
include_once '../config/database.php';
include_once '../objects/term.php';

$database          = new Database();
$db                = $database->getConnection();
$term              = new Term($db);
$data              = json_decode(file_get_contents("php://input"));
$term->id          = $data->id;
if ($term->delete()) {
    echo "Term removed from System!";
} else {
    echo "Unable to remove Term from System!";
}
?>

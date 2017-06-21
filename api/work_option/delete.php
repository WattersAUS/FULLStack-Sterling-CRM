<?php
include_once '../config/database.php';
include_once '../objects/work_option.php';

$database       = new Database();
$db             = $database->getConnection();
$workoption     = new WorkOption($db);
$data           = json_decode(file_get_contents("php://input"));
$workoption->id = $data->id;
if ($workoption->delete()) {
    echo "Work Option removed from System!";
} else {
    echo "Unable to remove Work Option from System!";
}
?>

<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$customers = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->title = $data->title;
$user->first_name = $data->first_name;
$user->last_name = $data->last_name;
$user->email_address = $data->email_address;
$user->start_date = $data->start_date;
$user->end_date = $data->end_date;
$user->password = $data->password;
$user->userGUID = $data->userGUID;
$user->user_level = $data->user_level;

// create the product
if($user->create()){
    echo "user was created.";
}
 
// if unable to create the product, tell the user
else{
    echo "Unable to create user.";
}
?>
<?php

include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../config/cors.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die("user id is required");

if($user->verifyUser()){

    header("Location: https://www.google.com/");

}
else{
    print_r(json_encode(array(
        "status" => false,
        "message" => "user doesn't exists!",
    )));
}

?>

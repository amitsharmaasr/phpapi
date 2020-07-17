<?php

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);

$user->email = isset($_GET['email']) ? $_GET['email'] : die("Email is Required");

$stmt = $user->forgotPassword();

print_r($stmt);

?>
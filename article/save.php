<?php

include_once '../config/database.php';
include_once '../objects/article.php';
include_once '../config/cors.php';
include_once '../config/uploadfile.php';

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);
$upload = new UploadFile();

$article->patientname = isset($_POST['articlename']) ? $_POST['articlename'] : die("articlename is required");
$article->fathername = isset($_POST['fullname']) ? $_POST['fullname'] : die("fullname is required");
$article->residence = isset($_POST['email']) ? $_POST['email'] : die("email is required");
$article->age = isset($_POST['password']) ? $_POST['password'] : die("password is required");
//$article->article = isset($_POST['isadmin']) ? $_POST['isadmin'] : 0;
$article->userid = isset($_POST['designation']) ? $_POST['designation'] : die("designation is required");
$upload->file = isset($_FILES['article']) ? $_FILES['article'] : die("article is required");


$uploadFile = $upload->uploadFile();

if($uploadFile['status']){

    $article->article = $uploadFile['url'];

    if($article->store()){
        return json_encode(array(
            "status" => true,
            "message" => "uploaded successful",
            "article_id" => $article->id
        ));
    }else{
        return json_encode(array(
            "status" => false,
            "message" => "error while uploading article information!"
        ));
    }
    
}
else{
    return json_encode(array(
        "status" => false,
        "message" => "failed to upload article, please try later!"
    ));
}

?>

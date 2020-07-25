<?php

include_once '../config/database.php';
include_once '../objects/article.php';
include_once '../config/cors.php';
include_once '../config/uploadfile.php';

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);
$upload = new UploadFile();

//$_POST = json_decode(file_get_contents('php://input'), true);

$article->patientname = isset($_POST['patientname']) ? $_POST['patientname'] : die("patient name is required");
$article->fathername = isset($_POST['fathername']) ? $_POST['fathername'] : die("father name is required");
$article->residence = isset($_POST['residence']) ? $_POST['residence'] : die("residence is required");
$article->age = isset($_POST['age']) ? $_POST['age'] : die("age is required");
$article->title = isset($_POST['title']) ? $_POST['title'] : die("title is required");
$article->description = isset($_POST['description']) ? $_POST['description'] : die("description is required");
$article->userid = isset($_POST['userid']) ? $_POST['userid'] : die("userid is required");

$upload->file = isset($_FILES['article']) ? $_FILES['article'] : die("article is required");
$uploadFile = $upload->uploadFile();
if($uploadFile['success'] ){
    $article->article = str_replace('article/save.php', 'article', $uploadFile['url']);
}else{
    die($uploadFile['msg']);
}

$upload->file = isset($_FILES['coverletter']) ? $_FILES['coverletter'] : die("title is required");
$uploadFile = $upload->uploadFile();
if($uploadFile['success']){

    $article->coverletter = str_replace('article/save.php', 'article', $uploadFile['url']);

}else{
    die($uploadFile['msg']);
}

if($article->store()){
        print_r(json_encode(array(
            "status" => true,
            "message" => "uploaded successful",
            "article_id" => $article->id
        )));
}else{
        print_r(json_encode(array(
            "status" => false,
            "message" => "error while uploading article information!"
        )));
}

?>

<?php

include_once '../config/database.php';
include_once '../objects/article.php';
include_once '../objects/user.php';
include_once '../config/cors.php'; 

$database = new Database();
$db = $database->getConnection();
 
$article = new Article($db);
$user = new User($db);

$article->userid = isset($_GET['userid']) ? $_GET['userid'] : die("user id is required");
$user->id = isset($_GET['userid']) ? $_GET['userid'] : die("user id is required");

if($user->verifyUserID()){
    
    $stmt = $article->getArticleCount();

    if($stmt->rowCount() > 0){

        $artInfo = array();
        $artInfo["body"] = array();
        $artInfo["itemCount"] = $stmt->rowCount();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $e = array(
                "id" => $id,
                "patientname" => $patientname,
                "fathername" => $fathername,
                "residence" => $residence,
                "age" => $age,
                "article" => $article,
                "status" => $status,
                "title" => $title,
                "description" => $description,
                "coverletter" => $coverletter,
                "publish" => $publish,
                "userid" => $userid
            );

            array_push($userInfo["body"], $e);
        }

        $user_arr=array(
            "status" => true,
            "message" => "User Details!",
            "data" => $userInfo
        );
    }
    else{
        $user_arr=array(
            "status" => false,
            "message" => "failed to get count of user!",
        );
    }

}else{
    $user_arr=array(
        "status" => false,
        "message" => "user not exists",
    );
}


print_r(json_encode($user_arr));

?>

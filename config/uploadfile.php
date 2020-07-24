<?php
class UploadFile{
 
    private $target_dir = "../uploads";
    public $file;
   
    public function __construct(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
 
    public function uploadFile(){
        
            $originalname = $this->file["name"];
            $tempname = $this->file["tmp_name"];
            $error = $this->file["error"];

            if($error > 0){
                return array("status" => false);
            }else {

                $fileName = date('Y-m-d H:i:s')."-".$originalname;
                $upload_name = $this->target_dir.strtolower($fileName);
                $upload_name = preg_replace('/\s+/', '-', $upload_name);
        
                if(move_uploaded_file($tempname , $upload_name)) {
                    return array(
                        "status" => true,
                        "url" => $_SERVER['HTTP_HOST']."/".$upload_name
                    );
                }else{
                        return array(
                            "status" => "false",
                        
                        );
                }

            }
   
    }

}
?>

<?php
class UploadFile{
 
    private $target_dir = "..\\uploads";
    public $file;
   
    public function __construct(){
        date_default_timezone_set('Asia/Kolkata');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
 
    public function uploadFile(){

        if (!file_exists($this->target_dir)) {
            mkdir($this->target_dir, 0777, true);
        }
        
            $originalname = $this->file["name"];
            $tempname = $this->file["tmp_name"];
            $error = $this->file["error"];

            if($error > 0){
                return array("status" => false);
            }else {

                $fileName = '/'.date('Y-m-d H:i:s')."-".$originalname;
                $upload_name = $this->target_dir.strtolower($fileName);
                $upload_name = preg_replace('/\s+/', '-', $upload_name);
        
                $upload_name = str_replace(["config..\\", "/"], ["", "\\"], dirname(__FILE__).$upload_name);

                if(move_uploaded_file($tempname , $upload_name)) {

                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    return array(
                        "status" => true,
                        "url" => $actual_link.'/'.$upload_name
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

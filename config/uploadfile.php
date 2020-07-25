<?php
class UploadFile{
 
    private $target_dir = "uploads/";
    public $file;
   
    public function __construct(){
        date_default_timezone_set('Asia/Kolkata');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }
 
    public function uploadFile(){
         
        if(!is_dir($this->target_dir)){
            mkdir($this->target_dir, 0755);
        }

        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "GIF", "JPG", "PNG", "doc", "txt", "docx", "pdf", "xls", "xlsx"); 

        $name = date('Y_m_d_H_i_s').'_'.$this->file['name']; 
    
        $size = $this->file['size']; 

        if (strlen($name)) {
            list($txt, $ext) = explode(".", $name); 
            if (in_array($ext, $valid_formats)) {
                if ($size < 2098888) { 
                    $tmp = $this->file['tmp_name'];
                    if (move_uploaded_file($tmp, $this->target_dir . $name)) { 
                        return array(
                            "success" => true,
                            "url" => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."/".$this->target_dir . $name
                        );
                    } else {
                        return array(
                            "success" => false,
                            "msg" => "failed to upload file"
                        );
                    }
                } else {
                    return array(
                        "success" => false,
                        "msg" => "File size max 2 MB"
                    );
                }
            } else {
                return array(
                    "success" => false,
                    "msg" => "Invalid file format.."
                );
            }
        } else {
            return array(
                "success" => false,
                "msg" => "Please select a file..!"
            );
        }

    }
        
        


}
?>
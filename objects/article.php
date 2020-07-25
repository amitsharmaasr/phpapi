<?php
class Article{
 
    private $conn;
    private $table_name = "articles";
 
    public $id;
    public $patientname;
    public $fathername;
    public $residence;
    public $age;
    public $article;
    public $status;
    public $userid;
    public $title;
    public $description;
    public $coverletter;
    public $publish;
   
    public function __construct($db){
        $this->conn = $db;
        ini_set('display_errors', 1);
    }
    
    public function store(){

        if(!$this->isTableExists() || $this->isTableExists() == false){
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (patientname, fathername, residence, age, article, userid, title, description, coverletter) values (:patientname, :fathername, :residence, :age, :article, :userid, :title, :description, :coverletter)";
    
        $stmt = $this->conn->prepare($query);
    
        $this->patientname=htmlspecialchars(strip_tags($this->patientname));
        $this->fathername=htmlspecialchars(strip_tags($this->fathername));
        $this->residence=htmlspecialchars(strip_tags($this->residence));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->article=htmlspecialchars(strip_tags($this->article));
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->coverletter=htmlspecialchars(strip_tags($this->coverletter));
        
        $stmt->bindParam(":patientname", $this->patientname);
        $stmt->bindParam(":fathername", $this->fathername);
        $stmt->bindParam(":residence", $this->residence);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":article", $this->article);
        $stmt->bindParam(":userid", $this->userid);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":coverletter", $this->coverletter);
    
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;

    }

    public function getArticleCount(){

        $query = "SELECT * FROM " . $this->table_name . " where publish = 1 and status = true and userid != ".$this->userid;

        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }
    
    public function isTableExists(){

        $query = "SELECT table_name FROM information_schema.tables WHERE table_schema='public' AND table_type='BASE TABLE'";

        $flag = 1;
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->execute();

        $tables = $stmt->fetchAll(PDO::FETCH_NUM);
 
        foreach($tables as $table){
            if($table[0] == $this->table_name){
                $flag = 0;
                break; 
            }
        }

        if($flag == 0){
            return true;
        }else{
            if($this->createTableUser()){
                return true;
            }
            return false;
        }

    }

    public function createTableUser(){

        try{
            $query = "CREATE TABLE $this->table_name (
                id serial PRIMARY KEY,
                patientname VARCHAR(60),
                fathername VARCHAR(60),
                residence VARCHAR(50),
                age integer,
                article VARCHAR(150),
                userid integer,
                status boolean default true,
                title VARCHAR(150),
                description VARCHAR(150),
                coverletter VARCHAR(150),
                publish integer default 0,
                createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                );";
              
                $stmt = $this->conn->prepare($query);
                
                if($stmt->execute()){
                    return true;
                }
                return false;

        }catch(PDOException $e) {
            return false;
        }
        
    }

    //file_uploads = On

}


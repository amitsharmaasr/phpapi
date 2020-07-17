<?php
class User{
 
    private $conn;
    private $table_name = "users_modal";
 
    public $id;
    public $username;
    public $fullname;
    public $email;
    public $password;
    public $isadmin;
    public $designation;
    public $hospital;
    public $mobile;
    public $address;
    public $city;
    public $state;
    public $country;
    public $isactive;
    public $createdat;
    public $isverify;

    public function __construct($db){
        $this->conn = $db;
        ini_set('display_errors', 1);
    }
    
    function signup(){

        if(!$this->isTableExists() || $this->isTableExists() == false){
            return false;
        }

        if($this->isUserAlreadyExist()){
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (username, fullname, email, password, isadmin, designation, hospital, mobile, address, city, state, country) values (:username, :fullname, :email, :password, :isadmin, :designation, :hospital, :mobile, :address, :city, :state, :country)";
        
        $stmt = $this->conn->prepare($query);
    
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->fullname=htmlspecialchars(strip_tags($this->fullname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->isadmin=htmlspecialchars(strip_tags($this->isadmin));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->hospital=htmlspecialchars(strip_tags($this->hospital));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->state=htmlspecialchars(strip_tags($this->state));
        $this->country=htmlspecialchars(strip_tags($this->country));
        // $this->isactive=htmlspecialchars(strip_tags($this->isactive));
        // $this->createdat=htmlspecialchars(strip_tags($this->createdat));
        // $this->isverify=htmlspecialchars(strip_tags($this->isverify));
    
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":isadmin", $this->isadmin);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":hospital", $this->hospital);
        $stmt->bindParam(":mobile", $this->mobile);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":country", $this->country);
        // $stmt->bindParam(":isactive", $this->isactive);
        // $stmt->bindParam(":createdat", $this->createdat);
        // $stmt->bindParam(":isverify", $this->isverify);
    
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;

    }
    
    function login(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE email='".$this->email."' AND password='".$this->password."'";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        
        return $stmt;

    }
    
    function isUserAlreadyExist(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE email = '$this->email' or mobile = '$this->mobile'";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function getUserList(){

            $query = "SELECT * FROM " . $this->table_name . "";
           
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute();
            
            return $stmt;

    }

    public function getSingleUserDetail(){

        $sqlQuery = "SELECT * FROM ". $this->table_name ." WHERE id = ? AND LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $dataRow;

    }

    public function updateUser(){
        
        $query = "UPDATE ". $this->table_name ." SET username=:username, fullname=:fullname, email=:email, password=:password, isadmin=:isadmin, designation=:designation, hospital=:hospital, mobile=:mobile, address=:address, city=:city, state=:state, country=:country WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->fullname=htmlspecialchars(strip_tags($this->fullname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->isadmin=htmlspecialchars(strip_tags($this->isadmin));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->hospital=htmlspecialchars(strip_tags($this->hospital));
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->state=htmlspecialchars(strip_tags($this->state));
        $this->country=htmlspecialchars(strip_tags($this->country));
        $this->isactive=htmlspecialchars(strip_tags($this->isactive));
        $this->isverify=htmlspecialchars(strip_tags($this->isverify));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":isadmin", $this->isadmin);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":hospital", $this->hospital);
        $stmt->bindParam(":mobile", $this->mobile);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":country", $this->country);
        // $stmt->bindParam(":isactive", $this->isactive);
        // $stmt->bindParam(":isverify", $this->isverify);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()){
           return true;
        }
        return false;
    }

    public function deleteUser(){

            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            
            $stmt = $this->conn->prepare($query);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
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
                username VARCHAR(60),
                fullname VARCHAR(60),
                email VARCHAR(50),
                password VARCHAR(60),
                isadmin integer default 0,
                designation VARCHAR(50),
                hospital VARCHAR(60),
                mobile VARCHAR(60),
                address VARCHAR(50),
                city VARCHAR(60),
                state VARCHAR(60),
                country VARCHAR(50),
                isactive integer default 1,
                isverify integer default 0,
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

    public function forgotPassword(){

        $this->email=htmlspecialchars(strip_tags($this->email));

        $query = "SELECT * FROM " . $this->table_name . " WHERE email = '$this->email'";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();

        if($stmt->rowCount() > 0){

            $query = "UPDATE ". $this->table_name ." SET password = 'Smart@1234' WHERE email = '$this->email'";

            $stmt = $this->conn->prepare($query);

            if($stmt->execute()){
                return json_encode(array(
                    "status" => true,
                    "message" => "password successfully updated!",
                    "password" => "Smart@1234"
                ));
            }

            return json_encode(array(
                "status" => false,
                "message" => "password could not be updated!",
            ));;

        }else{
            return json_encode(array(
                "status" => false,
                "message" => "email doesn't exists!",
            ));
        }


    }
}


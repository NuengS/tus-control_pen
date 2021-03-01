<?php
require_once 'database.php';
class Emp{
    private $conn;
    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }
    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }
    // Redirect URL method
    public function redirect($url){
      header("Location: $url");
    }
    
    // Insert employee
    public function insert($emp_type_id, $emp_type){
      try{
        $stmt = $this->conn->prepare("INSERT INTO emp_type (emp_type_id,emp_type) 
        VALUES(emp_type_id,:emp_type)");
        $stmt->bindparam(":emp_type_id", $emp_type_id);
        $stmt->bindparam(":emp_type", $emp_type);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }

  }
?>

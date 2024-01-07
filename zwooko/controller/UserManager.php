<?php

class UserManager {
    private $name = array();
    private $dbObject;

    public function __construct($dbo){
      $this->dbObject = $dbo;
    }

    function getAllUsers(){
      $sql = "select * from user";
      $dbo = $this->dbObject;
      $query_result = $dbo->prepare($sql);
      $query_result->execute();
      return $query_result->fetchAll();
    }
}

?>

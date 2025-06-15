<?php

class Asset {
    private $name = array();
    private $dbObject;

    public function __construct($dbo){
      $this->dbObject = $dbo;
    }

    function getAssetName(){
      $sql = "select * from asset";
      $dbo = $this->dbObject;
      $query_result = $dbo->prepare($sql);
      $query_result->execute();
      return $query_result->fetchAll();
    }
}

?>

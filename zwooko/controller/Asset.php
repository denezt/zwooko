<?php

class Asset {
    private $name = array();
    private $dbObject;

    public function __construct($dbo){
      $this->dbObject = $dbo;
    }

    function getAssetName(){
        $task_name = "";
        $sql = "select * from asset";
        $i = 0;
        foreach ($this->dbObject->query($sql) as $rs){
            $name[$i++] = $rs["name"];
        }
       return $name;
    }
}

?>

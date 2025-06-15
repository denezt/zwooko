<?php 

class UuidManager {
    private $uuid;

    public function __construct(){ }

    function generateUUID(){
        exec("uuidgen", $_result);
        $this->uuid = $_result[0];
    }

    function getUUID(){
        return $this->uuid;
    }
}

?>
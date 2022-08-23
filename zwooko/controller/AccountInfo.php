<?php
session_start();

class AccountInfo {
    private $id;
    private $name;
    private $uuid;
    private $status_id;

    public function __construct(){}

    function getId(){
        return $_SESSION["id"];
    }

    function getUuid(){
        return $_SESSION["uuid"];
    }

    function getName(){
        return $_SESSION["name"];
    }

    function getUser(){
        return $_SESSION["name"];
    }

    function getStatusId(){
        return $_SESSION["status_id"];
    }

    function setSessionVariables($id, $name, $uuid, $status_id){
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $name;
        $_SESSION["uuid"] = $uuid;
        $_SESSION["status_id"] = $status_id;
    }
}
?>

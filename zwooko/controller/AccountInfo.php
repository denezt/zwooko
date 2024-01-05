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

    function getUsername(){
        return $_SESSION["username"];
    }

    function getFirstname(){
        return $_SESSION["fname"];
    }

    function getLastname(){
        return $_SESSION["lname"];
    }

    function getStatusId(){
        return $_SESSION["status_id"];
    }

    function getSessionState(){
        $session_state = ($_SESSION["logged_in"] == true) ? true : false;
        return $session_state;
    }

    function setSessionVariables($id, $name, $uuid, $status_id){
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $name;
        $_SESSION["uuid"] = $uuid;
        $_SESSION["status_id"] = $status_id;
        $_SESSION["logged_in"] = true;
    }
}
?>

<?php 

class TaskInfo {
    private $name;
    private $type_id;
    private $uuid;
    private $description;
    private $status_id;
    private $asset_id;
    private $user_id;
    
    /**
     * All Task Info is extracted using Unique Identification Number
     */
    public function __construct($uuid){
        // echo "Setting Task UUID: " . $uuid . "<br/>";
        $this->uuid = $uuid;
    }
    
    // Here we set all of the class variables
    function setTaskInfo($name,$type_id, $description,$status_id,$asset_id,$user_id){
        $this->name = $name;
        $this->type_id = $type_id;
        $this->description = $description;
        $this->status_id = $status_id;
        $this->asset_id = $asset_id;
        $this->user_id = $user_id;
    }
    
    // Extract the task types
    function getTaskType($dbObject, $type_id){        
        $sql = "select * from task_type where id = '". $type_id."' ";
        
        foreach ($dbObject->query($sql) as $rs){
            $task_name = $rs["name"];
       }
    }

    // Extract the task name
    function getTaskName(){
        $task_name = "";
        $sql = "select * from task_type where id = '". $this->type_id."' ";       
        foreach ($dbObject->query($sql) as $rs){
            $task_name = $rs["name"];
        }
       return $task_name;
    }

    // Extract all task information from database
    function extractTaskTableData($dbObject){ 
        $sql = "select * from task where uuid = '". $this->uuid."' ";
        foreach ($dbObject->query($sql) as $rs){
            $task_name = $rs["name"];
            $description = $rs["description"];
            $type_id = $rs["type_id"];
            $status_id = $rs["status_id"];
            $asset_id = $rs["asset_id"];
            $user_id = $rs["user_id"];        
        }
        $this->setTaskInfo($task_name, $type_id, $description, $status_id, $asset_id, $user_id);
    }

    function getTaskTableData(){
        $task_name = $this->name;
        $type_id = $this->type_id;
        $uuid = $this->uuid;
        $description = $this->description;
        $status_id =  $this->status_id;
        $asset_id = $this->asset_id;
        $user_id = $this->user_id;
        $tableData = array(
            "task_name" => $task_name,
            "type_id" => $type_id,
            "uuid" => $uuid,
            "description" => $description,
            "status_id" =>  $status_id,
            "asset_id" => $asset_id,
            "user_id" => $user_id
        );
        return $tableData;
    }

    // Extract all task information from database
    function deleteTaskFromTable($dbObject){
        try {
            $sql = "delete from task where uuid = '". $this->uuid."' ";
            $dbObject->exec($sql);
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }


    
}



?>
<?php

class TaskInfo {
    private $uuid;
    private $name;
    private $type_id;
    private $description;
    private $status_id;
    private $asset_id;
    private $user_id;
    private $priority_id;

    /**
     * All Task Info is extracted using Unique Identification Number
     */
    public function __construct($uuid){
        // echo "Setting Task UUID: " . $uuid . "<br/>";
        $this->uuid = $uuid;
    }

    // Here we set all of the class variables
    function setTaskInfo($name, $type_id, $description, $status_id, $asset_id, $user_id, $priority_id){
        $this->name = $name;
        $this->type_id = $type_id;
        $this->description = $description;
        $this->status_id = $status_id;
        $this->asset_id = $asset_id;
        $this->user_id = $user_id;
        $this->priority_id = $priority_id;
    }

    function getTaskName(){
        return "$this->name";
    }

    function getTaskTypeId(){
        return $this->type_id;
    }


    function getTaskDescription(){
        return "$this->description";
    }

    function getTaskStatusId(){
        return "$this->status_id";
    }

    function getTaskAssetId(){
        return "$this->asset_id";
    }

    function getTaskUserId(){
        return "$this->user_id";
    }

    function getTaskPriority(){
        return "$this->priority";
    }

    // Extract all task information and store
    function extractTaskTableData($dbo){
        $sql = "select * from task where uuid = ? ";
        $query = $dbo->prepare($sql);
        $query->execute([$this->uuid]);
        $query_result = $query->fetchAll();
        foreach ($query_result as &$rs){
            $task_name = $rs["name"];           // Name
            $description = $rs["description"];  // Description
            $type_id = $rs["type_id"];          // Type ID
            $status_id = $rs["status_id"];      // Status ID
            $asset_id = $rs["asset_id"];        // Asset ID
            $user_id = $rs["user_id"];          // User ID
            $priority_id = $rs["priority_id"];  // Priority ID
        }
        $this->setTaskInfo($task_name, $type_id, $description, $status_id, $asset_id, $user_id, $priority_id);
    }

    function getTaskTableData(){
        $task_name = $this->name;
        $type_id = $this->type_id;
        $uuid = $this->uuid;
        $description = $this->description;
        $status_id =  $this->status_id;
        $asset_id = $this->asset_id;
        $user_id = $this->user_id;
        $priority_id = $this->priority_id;
        $tableData = array(
            "task_name" => $task_name,
            "type_id" => $type_id,
            "uuid" => $uuid,
            "description" => $description,
            "status_id" =>  $status_id,
            "asset_id" => $asset_id,
            "user_id" => $user_id,
            "priority_id" => $priority_id
        );
        return $tableData;
    }

    // Extract all task information from database
    function deleteTaskFromTable($dbo){
        try {
            $sql = "delete from task where uuid = '". $this->uuid."' ";
            $dbo->exec($sql);
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}



?>

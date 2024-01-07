<?php 

class LogManager {
    private $logged_in;
	function __construct($logged_in){
		$this->logged_in = $logged_in;
	}

	function addLogEntry($dbo, $entry){	
		$query_result->execute(array('search_term' => "%$term%"));
	}    

}

?>

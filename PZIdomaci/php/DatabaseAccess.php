<?php
function getDbAccess(){
    return new DatabaseAccess("BlekacicMarijeta", "BlekacicMarijeta", "BlekacicMarijeta1");
}

class DatabaseAccess {
	private $_username;
	private $_password;
	private $_db;
	private $_connection;

	public function DatabaseAccess($db, $username, $password){
		$this->_db = $db;
		$this->_username = $username;
		$this->_password = $password;
	}

	public function executeQuery($query){
		$connection = mysql_connect("localhost", $this->_username, $this->_password);

		if ($connection) {
			$database = mysql_select_db($this->_db, $connection);

			if($database){
				mysql_query('SET character_set_results=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET names utf8');

				$queryResponse = mysql_query($query);

				if(!$queryResponse){
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $query;
					die($message);
				}

				$resultItems = array();

		   		while(is_resource($queryResponse) && $item = mysql_fetch_row($queryResponse)){
		   			$resultItems[] = $item;
		   		}

			   	return $resultItems;
			}
			else{
				die("Connection to DB could not be established");
			}
		}
		else {
			die("Connection could not be established");
		}
	}

	public function executeInsertQuery($query){
		$connection = mysql_connect("localhost", $this->_username, $this->_password);

		if ($connection) {
			$database = mysql_select_db($this->_db, $connection);

			if($database){
				mysql_query('SET character_set_results=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET names utf8');

				$queryResponse = mysql_query($query);

				if(!$queryResponse){
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $query;
					die($message);
				}

				return mysql_insert_id($connection);
			}
			else{
				die("Connection to DB could not be established");
			}
		}
		else {
			die("Connection could not be established");
		}
	}
}

<?php
class Database {
	private $mysqli;
	
	function __construct($host, $user, $pass, $database) {
		// Connect to the database
		$this->mysqli = new mysqli($host,$user,$pass,$database);
		
		if(mysqli_connect_errno()) {
			die("Could not connect to database!");
		}
	}
	
	function query($query) {
		$result = $this->mysqli->query($query);
		if(mysqli_errno($this->mysqli)) {
			$num = mysqli_errno($this->mysqli);
			switch($num) {
				case 1062:
					$warning="Duplicate entry detected";
				break;
				default:
					$warning = $this->mysqli->error;
				break;
			}
		}
		
		return $result;
	}
}
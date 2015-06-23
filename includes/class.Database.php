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
	function delete_event($delete, $by="table_name") {
		if ($by=="id") {
			$result = $this->query("SELECT * FROM `events` WHERE ".$by."='".$delete."'");
			while ($row = $result->fetch_object()):
				$table_name = $row->table_name;
			endwhile;
		} else {
			$table_name = $delete;
		}
		$result = $this->query("DELETE FROM `events` WHERE ".$by."='".$delete."'");
		
		$result = $this->query("DROP TABLE IF EXISTS `".$table_name."`");
	}
	function add_event($name, $table_name) {
		$name = $this->mysqli->real_escape_string($name);
		$table_name = $this->mysqli->real_escape_string($table_name);

		$query = "INSERT INTO `events` (`name`, `table_name`) VALUES ('".$name."', '".$table_name."')";
		$this->query($query);
		$query = "CREATE TABLE IF NOT EXISTS `".$table_name."` (
			`id` int(6) NOT NULL AUTO_INCREMENT,
			`first_name` varchar(255) NOT NULL,
			`surname` varchar(255) NOT NULL,
			`jobtitle` varchar(255) NOT NULL,
			`company` varchar(255) NOT NULL,
			`table_number` varchar(255) NOT NULL,
			`checked_in` tinyint(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

		$result = $this->query($query);
		if ($this->mysqli->error) {
			return $this->mysqli->error;
		} else {
			return true;
		}
	}
	
	function add_guest($guestlist, $user) {
		extract($user);
		$query = "INSERT INTO `".$guestlist."` (`first_name`, `surname`, `jobtitle`, `company`, `table_number`) VALUES ('".$first_name."', '".$surname."', '".$jobtitle."', '".$company."', '".$table_number."')";
		$this->query($query);
		
		
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
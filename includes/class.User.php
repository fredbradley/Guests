<?php
	class User extends QuickDeploy {
		public $user_status = false;
		public $user_logged_in = false;
		
		function __construct() {
			parent::__construct();
			if (isset($_GET['logout'])) {
				$this->logout('/quick-deploy');
			}
			
			
			if (isset($_SESSION['user'])) {
				$this->user_logged_in = true;
				$this->user_status = "loggedin";
			}
			if ($_POST) {
				$this->post_functions();
			}
		}
		
		function post_functions() {
			if (isset($_POST['user-email']) && isset($_POST['user-pass'])) {
				$this->login($_POST['user-email'], $_POST['user-pass']);
			}
			if (isset($_POST['add_guest']) && $_POST['add_guest']==1) {
				$user = array(
					"first_name" => $_POST['first_name'],
					"surname" => $_POST['surname'],
					"jobtitle" => $_POST['jobtitle'],
					"company" => $_POST['company'],
					"table_number" => $_POST['table_number']
				);
				$this->db->add_guest($_POST['guestlist'], $user);
			}
			if (isset($_POST['event_name']) && isset($_POST['table_name'])) {
				if ($this->db->add_event($_POST['event_name'], $_POST['table_name'])===true) {
					$this->db->create_event_table($_POST['table_name']);
					$this->create_alert("success", "Event Added");
				} else {
					$this->create_alert("warning", "Something went wrong!");
				}	
			}	
		}
		
		function login($user, $pass) {
			if ($this->user_status == "loggedin")
				return true;
			
			$query = "SELECT * FROM users WHERE email='".$user."'";
			$result = $this->db->query($query);

			if ($result->num_rows == 1):
				$row = $result->fetch_assoc();
				$salt = $row['salt'];
				if ($row['password'] == md5($pass.$salt)): 
					$_SESSION["user"]["user_id"] = $row['id'];
					$_SESSION["user"]['email'] = $row['email'];
					$this->user_status="loggedin";
					$this->user_logged_in = true;
					$this->create_alert("success", "Logged in");
					return true;
				else:
					$this->create_alert("warning", "Wrong!");
				endif;
			else:
				$this->create_alert("warning", "Wrong!");
			endif;
			return false;
		
		}
		
		function add_user($email, $password) {
			$salt = $this->generate_salt();
			$saved_password = md5($password.$salt);
			$meta = $_POST;
			$add_user = "INSERT INTO users (email, salt, password) VALUES ('".$email."', '".$salt."', '".$saved_password."')";
			$this->db->query($add_user);
			$this->create_alert("success", "All Good!");
		}

		function change_password($id, $password) {
			$salt = $this->generate_salt();
			$saved_password = md5($password.$salt);
			
			$db = $this->mysqli->prepare("UPDATE users SET salt = ?, 
				password = ? 
				WHERE id = ?");
				
			$db->bind_param('ssi',
				$salt,
				$saved_password,
				$id);
	
			if ($db->execute()) {
				$this->create_alert("success", "Password changed! Changes will take affect the next time you log in!");
			} else {
				$this->create_alert("danger", "Something went wrong!");
			}
		}
		/* random string */
		function generate_salt( $length=16 ) {
			$bytes = openssl_random_pseudo_bytes($length);
			return bin2hex($bytes);
		}
		
		function redirect($url) {
			if (empty($url)) $url = "/";
			header("Location:".$this->uri.$url);
			exit();
		}
	
		function logout($url=null) {
			session_destroy();
			$this->redirect($url);
		}
	}
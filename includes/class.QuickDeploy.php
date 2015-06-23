<?php
	class QuickDeploy extends Alert {
		public $twig = false;
		public $uri = false;
		public $db = false;
		function __construct() {
			// Load TWIG
			require_once dirname(__FILE__).'/libraries/Twig/Autoloader.php';
			Twig_Autoloader::register();
			$loader = new Twig_Loader_Filesystem(dirname(dirname(__FILE__)).'/template');
			$this->twig = new Twig_Environment($loader, array(
			//	'cache' => dirname(dirname(__FILE__)).'/cache',
			));
			require_once dirname(dirname(dirname(__FILE__)))."/dbconnect.php";
			$this->db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		}
		
		function get_template($template, array $parse_settings=array()) {
			$default_settings = array(
				"footer_scripts" => $this->push_alerts_to_footer()
			);
			if (isset($parse_settings['footer_scripts'])) {
				$default_settings['footer_scripts'] .= $parse_settings['footer_scripts'];
			}
			
			$settings = array_merge($default_settings, $parse_settings);
			return $this->twig->render($template, $settings);
		}
		
		function guest_table_headers() {
			return array(
				"first_name" => "First Name",
				"surname" => "Surname", 
				"jobtitle" => "Job Title", 
				"company" => "Company", 
				"id" => "ID",
				"edit" => "Blah"
			);
		}
		function get_guests($event) {
			$query = $this->db->query("SELECT * FROM `".$event."`");
			$output = array();
			while($guest = $query->fetch_object()):
				$output[] = $guest;
			endwhile;
			return $output;
		}
		
	
	}
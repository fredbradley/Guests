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
			return $this->twig->render($template, $parse_settings);
		}
		
		
	
	}
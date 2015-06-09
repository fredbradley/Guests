<?php include dirname(__FILE__).'/includes/appstrap.php';
	echo $engine->show_alerts();
	var_dump($_SESSION);
	$site_config = array(
		"user_logged_in" => $engine->user_logged_in
	);
	
	
	echo $engine->get_template("content.twig", array("config"=>$site_config, "title" => "Fred Bradley"));

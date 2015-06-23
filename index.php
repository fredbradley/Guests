<?php include dirname(__FILE__).'/includes/appstrap.php';
	$alerts = $engine->show_alerts();
	var_dump($_SESSION);
	$site_config = array(
		"user_logged_in" => $engine->user_logged_in
	);
//echo $engine->db->delete_event(4, "id");	
//	echo $engine->db->add_event("Fred and Louise's Wedding", "ourwedding");
	echo $engine->get_template("content.twig", array("config"=>$site_config, "title" => "Fred Bradley", "footer_scripts" => $engine->push_alerts_to_footer()));

	
<?php 
	include dirname(__FILE__).'/includes/appstrap.php';
	$alerts = $engine->show_alerts();
	$site_config = array(
		"user_logged_in" => $engine->user_logged_in
	);
	if (isset($_GET['page_slug'])) {
		$page = $_GET['page_slug'];
	} else {
		$page = "";
	}
	var_dump($page);
	switch($page):
		case "guestlist":
			echo $engine->get_template(
				"guest_table.twig", 
				array(
					"table_headers" => $engine->guest_table_headers(), 
					"all_guests" => $engine->get_guests('ourwedding')
				)
			);
		break;
		default:
//echo $engine->db->delete_event(4, "id");	
//	echo $engine->db->add_event("Fred and Louise's Wedding", "ourwedding");
			echo $engine->get_template("content.twig", array("config"=>$site_config, "title" => "Fred Bradley"));
		break;
	endswitch;

	
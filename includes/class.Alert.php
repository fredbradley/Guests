<?php
class Alert {
	public $alerts = array();

	function show_alerts() {
		$output = "";
		if (!empty($this->alerts)) {
			foreach ($this->alerts as $alert) {
				$output .= $alert;
			}
		}
		return $output;
	}
	
	function create_alert($type, $message) {
		$alert = "<div class=\"alert alert-".$type." alert-dismissable\">";
		if ($type == "danger") $type="error";
		$alert .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><h4><i class=\"fa fa-help\"></i><strong>".ucfirst($type)."</strong></h4><p>".$message."</p></div>";
		array_push($this->alerts, $alert);
	}
	
	function push_alerts_to_footer() {
		return '<script>
			
			$.fn.exists = function () {
				return this.length !== 0;
			}
			if (jQuery("#alert_container").exists()) {
				alert_container = "#alert_container";
			} else {
				alert_container = "#page-content";
			}
			response = \''.$this->show_alerts().'\';
			
			$(response).hide().prependTo(alert_container).fadeIn("fast");
		
		</script>';
	}
}
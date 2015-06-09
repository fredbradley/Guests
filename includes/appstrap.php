<?php

ini_set('error_reporting', E_ALL);
ini_set("display_errors", 1);

date_default_timezone_set("Europe/London");

session_name("GUESTS");
session_start();

spl_autoload_register(function ($class) {
	if (substr($class, 0,5)!="Twig_") {
		$filename = dirname(__FILE__)."/class." . $class . ".php";
		require_once($filename);
	}
});
$engine = new User();

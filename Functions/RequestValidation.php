<?php
	define("R_PHP", "PHP");
	define("R_COMMON", "COMMON");
	define("R_CONTROLLERS", "CONTROLLERS");
	define("R_ENTITIES", "ENTITIES");
	define("R_FUNCTIONS", "FUNCTIONS");
	define("R_LIB", "LIB");
	define("R_LOADERS", "LOADERS");
	define("R_MODEL", "MODEL");
	define("R_RESOURCES", "RESOURCES");
	define("R_SCRIPT", "SCRIPT");
	define("R_UTILS", "UTILS");
	define("R_VIEWS", "VIEWS");

	function validateUri(){
		$uri = strtoupper($_SERVER["REQUEST_URI"]);
		
		$restricted = array(
			R_PHP, 
			R_COMMON, 
			R_CONTROLLERS, 
			R_ENTITIES, 
			R_FUNCTIONS, 
			R_LIB, 
			R_LOADERS, 
			R_MODEL, 
			R_RESOURCES, 
			R_SCRIPT, 
			R_UTILS, 
			R_VIEWS
		);
		
		foreach($restricted as $f){
			if(strpos($uri, $f) !== false)
				return false;
		}
		return true;
	}
	
	if(!validateUri())
	{
		header("Location: /");
		die();
	}
?>
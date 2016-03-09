<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	
	define("ENV_DEV", "dev");
	define("ENV_TST", "tst");
	define("ENV_PRD", "prd");
	
	class ConfigLoader{
		static function Load(){
			include('Config/'.self::getCurrentEnvironment().'.config.php');
		}
		
		static function getCurrentEnvironment(){
			if(self::isServer(ENV_DEV))
				return ENV_DEV;
			else if((self::isServer(ENV_TST))) 
				return ENV_TST;
			else 
				return ENV_PRD;
		}
		
		private static function isServer($s){
			
			$server = $_SERVER['HTTP_HOST'];
			$pos = substr($server, 0, 3) == $s;
			$result = $pos == 1;
			
			return $result;
		}
	}
?>
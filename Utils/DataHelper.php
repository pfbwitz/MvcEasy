<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	class DataHelper {
		static function get($variable){
			return $_POST[$variable];
		}
		
		static function variableIsSet($variable){
			return isset($_POST[$variable]);
		}
	}
?>
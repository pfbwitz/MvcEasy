<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	class BaseModel {
		protected static function database(){
			return new Data_DatabaseEngine();
		}

	}
?>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	class ConnectionHelper {
		static function getConnection(){
			$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
			if ($mysqli->connect_errno) {
				printf("Connect failed: %s\n", $mysqli->connect_error);
				exit();
			}
			return $mysqli;
		}
	}
?>
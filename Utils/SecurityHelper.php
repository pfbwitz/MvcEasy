<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	class SecurityHelper {
		static function authenticate(){
			if(!Model_UserModel::isLoggedIn()) {
				if(isset($_SERVER["REQUEST_URI"]))
					Redirect('/Security/Index' . $_SERVER["REQUEST_URI"]);
				else
					Redirect('/Security/');
			}
		}

	}
?>
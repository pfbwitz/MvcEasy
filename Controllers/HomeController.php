<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	class HomeController extends BaseController {
		function IndexAction(){
			$this->message = "Hello World!!!";
		}
	}
?>
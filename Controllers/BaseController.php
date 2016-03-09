<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	abstract class BaseController {
		public $user;
		public $view;
		
		protected $parameter;
		
		function __construct($param = null){
			$this->parameter = $param;
			$this->user = new Entities_UserEntity();
		}

		function LoadView(){
			include_once($this->view);
		}

		function isLoggedIn(){
			return Model_UserModel::isLoggedIn();
		}

		function log($message) {
			//TODO: not. implemented.
		}

		function handleException(Exception $exception = null) {
			if(isset($exception)){
				log("todo");
			}
		}

		function returnResultString($s){
			echo $s;
		}
		
		function loadPage(){
			include(MASTER_PAGE . BASE_EXTENSION);
		}
	}

?>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	class Router{
		static function direct()
		{
			$_controller = ROOT_PAGE;
			$_view = ROOT_VIEW;
			$_param = "";
			$routes = self::getRoutes();
			
			if(sizeof($routes) > 0) 
				$_controller = $routes[0];
			if(sizeof($routes) > 1) 
				$_view = $routes[1];
			if(sizeof($routes) > 2) 
				for($i=2;$i<sizeof($routes);$i++)
					$_param = $_param . ($i > 2 ? "/" : "") . $routes[$i];
			
			$action = $_view . ACTION;
			$c = $_controller . CONTROLLER;
			$view = VIEW_FOLDER . $_controller . "/_" . $_view . BASE_EXTENSION;
			
			if(!class_exists($c) || !method_exists($c, $action)) {
				Redirect("/". ROOT_PAGE . "/");
				return;
			}
			
			$controller = new $c($_param);
			$controller->user = Utils_SessionHelper::getUser();
			$controller->$action();
			
			if(!file_exists($view))
				return;
	
			$controller->view = $view;
			$controller->loadPage();
		}

		private static function getRoutes(){
			$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
			$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
			if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
				$uri = '/'.trim($uri, '/');
			
			$routes = explode('/', $uri);

			$r = array();
			foreach($routes as $route)
			{
				if(trim($route) != "")
					array_push($r, $route);
			}

			return $r;
		}
	}
?>
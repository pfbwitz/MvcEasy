<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	require_once("AutoLoader.php");

	AutoLoader::Load();
	Loaders_ConfigLoader::Load();
	Router::direct();
?>
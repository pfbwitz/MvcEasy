<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");

	function startsWith($haystack, $needle) {
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}
	
	function endsWith($haystack, $needle) {
		return $needle === "" || 
		(
			($temp = strlen($haystack) - strlen($needle)) >= 0 && 
			strpos($haystack, $needle, $temp) !== false
		);
	}
	
	function contains($haystack, $needle) {
		return strpos($haystack, $needle) !== false;
	}
?>
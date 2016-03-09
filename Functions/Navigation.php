<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	function Redirect($url){
		echo "<script>window.location = '" . $url . "'</script>";
	}
?>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
class SQLException extends RuntimeException{
}

abstract class BaseEntity {
	protected $_id;
    protected static $_tablename;
    
	public function __get($name){
		$property = '_' . strtolower($name);
		if(!property_exists($this, $property))
			throw new InvalidArgumentException(
			"Het veld '$name' is invalid"		
		);
		return $this->$property;
	}
}
?>

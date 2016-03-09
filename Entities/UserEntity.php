<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
class UserEntity extends Entities_BaseEntity {
	
	private $_username;
	private $_password;
    private $_google_account;
	
    function __construct(){
        Utils_SessionHelper::initSession();
        $this->_tablename = USER_TABLE;
	}
	
    public function __get($name){
		$property = '_' . strtolower($name);
		if(!property_exists($this, $property))
			throw new InvalidArgumentException(
			"Het veld '$name' is invalid"		
		);
		return $this->$property;
	}
    
    function logout(){
        Utils_SessionHelper::endSession();
    }
    
    function login(){
		Utils_SessionHelper::set('id', $this->id);
    }
    
    function map($obj){
    	$ent = new UserEntity();
    	$ent->id = $obj->id;
		$ent->username = $obj->naam;	
		$ent->password = $obj->pass;
		$ent->google_account = $obj->google_account;
		return $ent;
    } 
}

?>

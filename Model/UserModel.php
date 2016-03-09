<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	class UserModel extends Model_BaseModel{
		static function getOneById($id){
			try {
				
				if($obj = self::database()->table(USER_TABLE)->select()->where("id = " . $id)->fetch()->single()){ 
					return Entities_UserEntity::map($obj);
				} 
		    }
		    catch(Exception $e){
			    die($e->getMessage());
		    }
		}
		
		static function getOneByGoogleEmail($token){
			try {
				$q = self::database()->table(USER_TABLE)->select()
					->where("google_account = '" . $token . "'")->fetch();
				
				$o = $q->singleOrDefault();
				
				if($o == null)
					return;
				
				return Entities_UserEntity::map($o);			
		    }
		    catch(Exception $e){
			    die($e->getMessage());
		    }
		}
		
		static function getUserId($username, $password){
			try {
				$hash = md5($password);
				if($obj = self::database()->table(USER_TABLE)->select()->where("naam = '" . $username . "'")
					->where("pass='" . $hash . "'")->fetch()->singleOrDefault()){ 
				
					if($hash != $obj->pass)
						return false;

					return $obj->id;
				} 
				return false;
		    }
		    catch(Exception $e){
			    die($e->getMessage());
		    }
		}
		
		static function IsLoggedIn(){
			return Utils_SessionHelper::variableIsSet('id');
		} 
	}
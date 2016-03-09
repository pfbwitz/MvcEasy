<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php");
	
	class DatabaseEngine {
		private $_query;

		private $_parameters;

		private $_where;
		private $_joins;
		private $_tablename;
		private $_result;
		private $_limit;
		private $_columns;

		function __construct(){
			$this->_where = array();
			$this->_joins = array();
			$this->_parameters = array();
			$this->_result = array();
			$this->_columns = array();
			return $this;
		}

		function table($tablename){
			$this->_tablename = $tablename;
			return $this;
		}

		function select(){
			$this->_query = _SELECT . $this->_tablename;
			return $this;
		}

		function where($where){
			$concat = _WHERE;
			if(sizeof($this->_where) > 0)
				$concat = _AND;
			
			$this->_where[] = $concat . " " . $where;
			return $this;
		}

		function OrWhere($where){
			$this->_where[] = _OR . $where;
			return $this;
		}

		function join($type, $leftTable, $leftColumn, $rightTable, $rightColumn){
			$this->_joins[] = $type . " " . $leftTable . _ON . $leftTable . "." . $leftColumn . 
			" = " . $rightTable . "." . $rightColumn;
			return $this;
		}

		function limit($limit){
			$this->_limit = _LIMIT . $limit;
			return $this;
		}

		function getQueryString(){
			$q = $this->_query;
			foreach($this->_joins as $j)
			{
				$q = $q . " " . $j;
			}
			
			foreach($this->_where as $w)
			{
				$q = $q . " " . $w;
			}
			
			foreach($this->_parameters as $p)
			{
				$q = $q . " " . $p;
			}
			
			$q = $q . $this->_limit;
			
			return $q;
		}

		function fetch(){
			if(!isset($this->_tablename))
				throw new Exception("Table not set");

			if(strpos(_SELECT, $this->_query) != 0)
				throw new Exception("No fetch query defined"); 

			$fields = "*";
			if(sizeof($this->_columns) == 0){
				
			}
			$mysqli = Data_ConnectionHelper::getConnection();

			$query = $this->getQueryString();

			if ($result = $mysqli->query($query)) {
				while($obj = $result->fetch_object()){ 
					$this->_result[] = $obj;
				} 
				$result->close();
				$mysqli->close();
				unset($mysqli); 
			}
			
			return $this;
		}

		function single(){
			return $this->_result[0];
		}

		function singleOrDefault(){
			if(count($this->_result) > 0)
				return $this->_result[0];
			return null;
		}

		function all(){
			return $this->_result;
		}

		function update($parameters, $id){
			$this->_query = _UPDATE . $this->_tablename . _SET . $parameters . _WHERE . 
			"id='" . $id . "'";
			
			return $this;
		}

		function delete($id=null){
			if(isset($id))
				$this->where("id = '" . $id  . "'");	
			
			$this->_query = _DELETE . $this->_tablename;
			return $this;
		}

		function insert(){
			$param = "";
			$parameters = func_get_args();
			foreach($parameters as $p){
				$param = $param . "'" . $p . "'" . ", ";
			}
			$param = substr($param, 0, strlen($param) - 2);
			$this->_query = _INSERT . $this->_tablename . " VALUES(" . $param . ")";
			return $this;
		}

		function getPkForNewRow(){
			$id = 0;
			$mysqli = Data_ConnectionHelper::getConnection();
			if ($result = $mysqli->query("SELECT MAX(id) AS id FROM " . $this->_tablename)) {
				if($obj = $result->fetch_object()){ 
					$id = $obj->id + 10;
				}
			}
			$result->close();
			$mysqli->close();
			unset($mysqli); 
			return $id;
		}
		
		function execute(){
			if(!isset($this->_tablename))
				throw new Exception("Table not set");
			
			$mysqli = Data_ConnectionHelper::getConnection();
	
			$query = $this->getQueryString();
			
			$mysqli->query($query);
			$mysqli->close();
			unset($mysqli); 
		}
	}
?>
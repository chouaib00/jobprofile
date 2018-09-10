<?php
namespace Sys\Mapper;

use Sys\Drv\PdoAdapter;
class Mapper extends PdoAdapter{

	//protected $db;
	protected $_table = '';
	function __construct(){
		$ci =& get_instance();

		parent::__construct($ci->db->dsn, $ci->db->username, $ci->db->password);
		//$db = new PDO ();


		//$db = new PDO($ci->db->dsn);
		//$this->db = $ci->load->database('pdo', true);
		//$this->db = $ci->db;
	}

	public function getByFilter($filter, $isReturnSingle = false){
		$where_statement = 'WHERE ';
		$params = array();
		if(is_array($filter)){
			foreach($filter as $_filter){
				$parameterized_column = ':'.$_filter['column'];
				$where_statement .= $_filter['column'] ." = ". $parameterized_column;
				$params[$parameterized_column] = $_filter['value'];
				if(next($filter)){
					$where_statement .= " AND ";
				}
			}
		}
		else{
			$where_statement .= $filter;
		}
		$sql_statement = "SELECT *
									FROM ".$this->_table."
									".$where_statement;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);

		$result = ($isReturnSingle)? $stmt->fetch(\PDO::FETCH_ASSOC) : $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	public function getAllCount(){
		$sql_statement = "SELECT COUNT(1) as 'num'
									FROM ".$this->_table."";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute();
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $result['num'];
	}

	public function getAll(){
		$sql_statement = "SELECT * FROM ".$this->_table."";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	public function get($columns, $filter, $order){
		$column_statement = '';
		$where_statement = '';
		$order_statement = '';

		$column_statement = (is_array($columns))? implode(', ',$columns) : $columns;
		$params = array();
		if(is_array($filter)){
			foreach($filter as $_filter){
				$parameterized_column = ':'.$_filter['column'];
				$where_statement .= $_filter['column'] ." = ". $parameterized_column;
				$params[$parameterized_column] = $_filter['value'];
				if(next($filter)){
					$where_statement .= " AND ";
				}
			}
		}
		else{
			$where_statement = $filter;
		}

		if(is_array($order)){
			foreach($order as $_order){
				$order_statement .= $_order['column'] ." ". $_order['order'];
				if(next($order)){
					$order_statement .= ", ";
				}
			}
		}
		else{
			$order_statement = $order;
		}

		if(empty($column_statement)){
			$column_statement = '*';
		}
		if(!empty($where_statement)){
			$where_statement = 'WHERE '. $where_statement;
		}
		if(!empty($order_statement)){
			$order_statement = 'ORDER BY '.$order_statement;
		}

		$sql_statement = "SELECT ".$column_statement." FROM ".$this->_table." ".$where_statement." ".$order_statement;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}


	public function insert($data){
		$columns = '';
		$columns_params = '';
		$params = array();
		foreach($data as $col=>$val){
			$parameterized_column = ':'.$col;
			$columns .=$col;
			$columns_params .=$parameterized_column;
			$params[$parameterized_column] = $val;
			$columns .=', ';
			$columns_params .=', ';
		}
		$columns = substr($columns, 0, -2);
		$columns_params = substr($columns_params, 0, -2);

		$sql_statement = "INSERT INTO ".$this->_table."(".$columns.") VALUES (".$columns_params.")";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		return $this->lastInsertId();
	}

	public function update($data, $filter){
		$where_statement = 'WHERE ';

		$columns = '';
		$params = array();
		foreach($data as $col=>$val){
			$parameterized_column = ':'.$col;
			$columns .= $col.' = '.$parameterized_column;
			$params[$parameterized_column] = $val;
			$columns .=', ';
		}
		$columns = substr($columns, 0, -2);

		if(is_array($filter)){
			foreach($filter as $_filter){
				$parameterized_column = ':'.$_filter['column'];
				$where_statement .= $_filter['column'] ." = ". $parameterized_column;
				$params[$parameterized_column] = $_filter['value'];
				$where_statement .= " AND ";
			}
			$where_statement = substr($where_statement, 0, -5);
		}
		else{
			$where_statement .= $filter;
		}

		$sql_statement = "UPDATE ".$this->_table." SET ".$columns." ".$where_statement;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		return true;
	}


	public function delete($filter){
		$where_statement = 'WHERE ';
		$params = array();
		if(is_array($filter)){
			foreach($filter as $_filter){
				$parameterized_column = ':'.$_filter['column'];
				$where_statement .= $_filter['column'] ." = ". $parameterized_column;
				$params[$parameterized_column] = $_filter['value'];
				if(next($filter)){
					$where_statement .= " AND ";
				}
			}
		}
		else{
			$where_statement .= $filter;
		}
		$sql_statement = "DELETE FROM ".$this->_table."
									".$where_statement;
		$stmt = $this->prepare($sql_statement);
		$result = $stmt->execute($params);

		return $result;
	}
}

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

	public function getAll(){
		$sql_statement = "SELECT * FROM ".$this->_table."";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}
}

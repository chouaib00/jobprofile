<?php
namespace Sys\Drv;
use PDO;
class PdoAdapter {
    protected $_config = array();
    protected $_connection;  
    public function __construct($dsn, $username = null, $password = null, array $driverOptions = array()){
        if (!is_string($dsn) || empty($dsn)) {
            throw new InvalidArgumentException("The DSN must be a non-empty string.");
        }
        // save connection parameters in the $_config field
        $this->_config = compact("dsn", "username", "password", "driverOptions");	}
	public function connect(){
        // if there is a PDO object already, return early
        if ($this->_connection) {
            return;
        }
        // otherwise try to create a PDO object
        try {
            $this->_connection = new \PDO(
                $this->_config["dsn"], 
                $this->_config["username"], 
                $this->_config["password"], 
                $this->_config["driverOptions"]);
            $this->_connection->setAttribute( \PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_connection->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false);
            $this->_connection->setAttribute( \PDO::ATTR_CASE, PDO::CASE_NATURAL); 
        }
        catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }    
    public function disconnect() {
        $this->_connection = null;
    }   
    public function query($sql, $fetchStyle = \PDO::FETCH_ASSOC) {
        $this->connect();
        try {
            return $this->_connection->query($sql, $fetchStyle);  
        }
        catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }
	public function prepare($sql, $fetchStyle = \PDO::FETCH_ASSOC) {
        $this->connect();
        try {
            return $this->_connection->prepare($sql);     
        }
        catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }
	public function lastInsertId(){
		$this->connect();
        try {
            return $this->_connection->lastInsertId();
        }
        catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
	}	
	public function pgLastInsertId($column){
		 $this->connect();
        try {
            return $this->_connection->lastInsertId($column); 
        }
        catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
	}
}
<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class BasicContactMapper extends Mapper{

  protected $_table = 'tbl_basic_contact';

  public function getByID($bc_id){
    $sql_statement = "SELECT *
                      FROM tbl_basic_contact
                      WHERE bc_id = :bc_id";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute(array(
      ':bc_id'   => $bc_id
    ));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $result;
  }
}

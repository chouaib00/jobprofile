<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class FileManagerMapper extends Mapper{

  protected $_table = 'tbl_file_manager';

  public function getByID($id){
    $sql_statement = "SELECT *
                      FROM tbl_file_manager
                      WHERE fm_id = :fm_id";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute(array(
      ':fm_id'   => $id
    ));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $result;
  }
}

<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class ApplicantMapper extends Mapper{

  protected $_table = 'tbl_applicant';

  public function getByID($id){
    $sql_statement = "SELECT *
                      FROM tbl_applicant
                      WHERE applicant_id = :applicant_id";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute(array(
      ':applicant_id'   => $id
    ));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $result;
  }
}

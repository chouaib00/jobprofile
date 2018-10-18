<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class ApplicantApplicationMapper extends Mapper{

  protected $_table = 'tbl_applicant_application';

  public function getMyApplication($applicant_id){
    $sql_statement = "SELECT *
                      FROM `tbl_applicant_application`
                      INNER JOIN `tbl_job_posting`
                      ON `jp_id` = `aa_jp_id`
                      WHERE `aa_applicant_id` = :aa_applicant_id ";
    $params = array(
      ':aa_applicant_id'=>$applicant_id
    );
    $stmt = $this->prepare($sql_statement);
    $stmt->execute($params);
    $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}

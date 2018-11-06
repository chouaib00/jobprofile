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

  public function getApplicantApplicationByJPID($jp_id){
    $sql_statement = "SELECT *
                      FROM `tbl_applicant_application`
                      INNER JOIN `tbl_applicant`
                      ON `applicant_id` = `aa_applicant_id`
                      INNER JOIN `tbl_user`
                      ON `applicant_user_id` = `user_id`
                      LEFT JOIN `tbl_file_manager`
                      ON `fm_id` = `user_fm_id`
                      INNER JOIN `tbl_basic_contact`
                      ON `applicant_bc_id` = `bc_id`
                      INNER JOIN `tbl_address` present
                      ON `applicant_present_id` = present.`address_id`
                      INNER JOIN `tbl_city`
                      ON present.`address_city_id` = city_id
                      INNER JOIN `tbl_province`
                      ON present.`address_province_id` = province_id
                      WHERE `aa_jp_id` = :aa_jp_id ";
    $params = array(
      ':aa_jp_id'=>$jp_id
    );
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}

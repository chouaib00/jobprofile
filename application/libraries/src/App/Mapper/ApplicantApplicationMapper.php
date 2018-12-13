<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class ApplicantApplicationMapper extends Mapper{

  protected $_table = 'tbl_applicant_application';

  public function getMyApplication($applicant_id, $jf_id){
    $sql_statement = "SELECT *
                      FROM `tbl_applicant_application`
                      INNER JOIN `tbl_job_posting`
                      ON `jp_id` = `aa_jp_id`
                      WHERE `aa_applicant_id` = :aa_applicant_id AND jp_jf_id = :jp_jf_id";
    $params = array(
      ':aa_applicant_id'=>$applicant_id,
      ':jp_jf_id'=>$jf_id
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

  public function getFrequencyOfApplication(){
    $sql_statement = "SELECT YEAR(aa_action_date) year_rec, MONTH(aa_action_date) month_rec,
                      SUM(CASE
                      	WHEN aa_applicantion_status = 2 THEN 1
                          ELSE 0
                      END) as 'rejected',
                      SUM(CASE
                      	WHEN aa_applicantion_status = 3 THEN 1
                          ELSE 0
                      END) as 'reviewing',
                      SUM(CASE
                      	WHEN aa_applicantion_status = 4 THEN 1
                          ELSE 0
                      END) as 'hired'
                      FROM tbl_applicant_application
                      WHERE aa_applicantion_status != 1
                      GROUP BY year_rec, month_rec
                      LIMIT 10";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $output = array(
      'month'=> array(),
      'data'=>array(
        'rejected'=>array(),
        'reviewing'=>array(),
        'hired'=>array()
      )
    );
    for($i=0;$i<10&&$i<count($result);$i++){
      $month = date( 'M', strtotime($result[$i]['year_rec'].'-'.$result[$i]['month_rec'].'-01'));
      $output['month'][] = $month;
      $output['data']['rejected'][] = $result[$i]['rejected'];
      $output['data']['reviewing'][] = $result[$i]['reviewing'];
      $output['data']['hired'][] = $result[$i]['hired'];
    }

    return $output;
  }
}

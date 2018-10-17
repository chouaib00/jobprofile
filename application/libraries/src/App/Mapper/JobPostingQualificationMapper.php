<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class JobPostingQualificationMapper extends Mapper{

  protected $_table = 'tbl_job_posting_qualification';

  public function getQualificationOfJob($jp_id, $key){

    $sql_statement = '';
    switch($key){
      case 'EDUC_ATTAINMENT':
        $sql_statement  = 'SELECT *
                          FROM tbl_job_posting_qualification
                          INNER JOIN tbl_educ_attainment
                          ON ea_id = jpq_value
                          WHERE jpq_jp_id = :jpq_jp_id AND jpq_key = :jpq_key';
      break;
      case 'SKILLS':
        $sql_statement  = 'SELECT *
                          FROM tbl_job_posting_qualification
                          INNER JOIN tbl_skill_tag
                          ON st_id = jpq_value
                          WHERE jpq_jp_id = :jpq_jp_id AND jpq_key = :jpq_key';
      break;
      case 'CITY':
        $sql_statement  = 'SELECT *
                          FROM tbl_job_posting_qualification
                          INNER JOIN tbl_city
                          ON city_id = jpq_value
                          WHERE jpq_jp_id = :jpq_jp_id AND jpq_key = :jpq_key';
      break;
      case 'PROVINCE':
        $sql_statement  = 'SELECT *
                          FROM tbl_job_posting_qualification
                          INNER JOIN tbl_province
                          ON province_id = jpq_value
                          WHERE jpq_jp_id = :jpq_jp_id AND jpq_key = :jpq_key';
      break;
      case 'REGION':
        $sql_statement  = 'SELECT *
                          FROM tbl_job_posting_qualification
                          INNER JOIN tbl_region
                          ON region_id = jpq_value
                          WHERE jpq_jp_id = :jpq_jp_id AND jpq_key = :jpq_key';
      break;
      default:
        $sql_statement = "SELECT *
                          FROM tbl_job_posting_qualification
                          WHERE jpq_jp_id = :jpq_jp_id AND jpq_key = :jpq_key ";
    }
    if($key == 'EDUC_ATTAINMENT'){

    }
    else{

    }


		$stmt = $this->prepare($sql_statement);
		$stmt->execute(array(
      ':jpq_jp_id'   => $jp_id
    , ':jpq_key'  => $key
    ));
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
  }

}

<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class ApplicantSkillMapper extends Mapper{

  protected $_table = 'tbl_applicant_skill';

  public function getSkill($id){
    $sql_statement = "SELECT *
                      FROM tbl_applicant_skill
                      INNER JOIN `tbl_skill_tag`
                      ON tbl_applicant_skill.`st_id` = tbl_skill_tag.`st_id`
                      WHERE askill_applicant_id = :askill_applicant_id";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
      ':askill_applicant_id'   => $id
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}

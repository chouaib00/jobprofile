<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class WorkExperienceMapper extends Mapper{

  protected $_table = 'tbl_work_experience';

  public function getWorkTable($id){
    $sql_statement = "SELECT *
                      FROM tbl_work_experience
                      LEFT JOIN `tbl_field_of_study`
                      ON `we_fos_id` = `fos_id`
                      WHERE we_applicant_id = :we_applicant_id";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
      ':we_applicant_id'   => $id
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $this->formatWorkTable($result);
  }

  private function formatWorkTable($data){
    $formated_data = array();
    foreach($data as $work){
      $row = array(
          'company_name' => $work['we_company_name']
      ,   'field_of_study'=>$work['we_fos_id']
      ,   'field_of_study_desc'=>$work['fos_name']
      ,   'start_date'=>$work['we_start_date']
      ,   'end_date'=>$work['we_end_date']
      ,   'end_date_current'=>($work['we_end_date'])? true : false
      ,   'add_info'=>$work['we_additional_info']
      ,   'action'=>'none'
      ,   'no'=>$work['we_id']
      );
      $row['data'] = rawurlencode(json_encode($row));
      array_push($formated_data, $row);

    }
    return $formated_data;
  }


}

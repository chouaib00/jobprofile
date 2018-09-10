<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class EducationMapper extends Mapper{

  protected $_table = 'tbl_education';
  private $educ_type = array(
    'Primary'
  , 'Secondary'
  , 'Tertiary'
  , 'Diploma'
  , 'Vocational / Trade Course'
  , 'Master\'s Degree'
  , 'Doctorate Degree'
  , 'Training Seminar'
  );
  public function getEducationTable($id){
    $sql_statement = "SELECT *
                      FROM tbl_education
                      LEFT JOIN tbl_school
                      ON `educ_school_id` = `school_id`
                      LEFT JOIN `tbl_address`
                      ON `school_address_id` = `address_id`
                      LEFT JOIN `tbl_province`
                      ON  `address_province_id` = `province_id`
                      LEFT JOIN `tbl_field_of_study`
                      ON `educ_fos_id` = `fos_id`
                      WHERE educ_applicant_id = :educ_applicant_id";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
      ':educ_applicant_id'   => $id
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $this->formatEducationTable($result);
  }

  private function formatEducationTable($data){
    $formated_data = array();
    foreach($data as $educ){
      $row = array(
        'action' => 'none'
      , 'school' => $educ['school_id']
      , 'school_desc' => $educ['school_name'].' - '.$educ['province_name']
      , 'field_of_study' => $educ['fos_id']
      , 'field_of_study_desc' => $educ['fos_name']
      , 'educ_type' => $educ['educ_type']
      , 'educ_type_desc' => $this->educ_type[$educ['educ_type']-1]
      , 'start_date' => $educ['educ_start_from']
      , 'end_date' => $educ['educ_start_to']
      , 'end_date_current' => false
      , 'course' => $educ['educ_degree']
      , 'add_info' => $educ['educ_additional']
      , 'no' => $educ['educ_id']
      );
      $row['data'] = rawurlencode(json_encode($row));
      array_push($formated_data, $row);

    }
    return $formated_data;
  }

}

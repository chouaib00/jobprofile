<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class JobFairAttendanceMapper extends Mapper{

  protected $_table = 'tbl_job_fair_attendance';

  public function getList(){
    $sql_statement = "SELECT *
                    FROM `tbl_job_fair_attendance`
                    ORDER BY `jf_id` DESC";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function selectDataTableApplicant($filter, $columns, $limit, $offset, $order, $jf_id){
    $result = array(
      'data'  => array()
    , 'total_count'=>0
    , 'count'=>0
    );

    $order_str_query = "ORDER BY ";
    $limit_str_query = "LIMIT :limit OFFSET :offset";
    $column_str_query = "";
    $where_str_query = "WHERE user_type = '2' ";
    $params = array();

    $column_str_query = ' applicant_id, CONCAT(bc_first_name, \' \', bc_middle_name, \' \', bc_last_name, \' \', bc_name_ext) as applicant,
                          user_name, bc_phone_num1, bc_phone_num2, bc_phone_num3, bc_gender,
                          bc_email_address, TIMESTAMPDIFF(YEAR, applicant_birthday, CURDATE()) AS age,
                          applicant_civil_status, applicant_nationality,
                          CONCAT(present.address_desc, \' \', city_name, \' City \', province_name) as address, jfa.jfa_id, jfa.jfa_time_in, jfa.jfa_time_out ';
    if(!empty($filter)){
        $where_str_query .= " AND ( bc_first_name LIKE :bc_first_name OR bc_middle_name LIKE :bc_middle_name
                            OR bc_last_name LIKE :bc_last_name OR bc_name_ext LIKE :bc_name_ext OR
                            bc_phone_num1 LIKE :bc_phone_num1 OR bc_phone_num2 LIKE :bc_phone_num2 OR
                            bc_phone_num3 LIKE :bc_phone_num3 OR bc_gender LIKE :bc_gender OR
                            bc_email_address LIKE :bc_email_address OR applicant_civil_status LIKE :applicant_civil_status OR
                            applicant_nationality LIKE :applicant_nationality)";
        $params[':bc_first_name'] = '%'.$filter.'%';
        $params[':bc_middle_name'] = '%'.$filter.'%';
        $params[':bc_last_name'] = '%'.$filter.'%';
        $params[':bc_name_ext'] = '%'.$filter.'%';
        $params[':bc_phone_num1'] = '%'.$filter.'%';
        $params[':bc_phone_num2'] = '%'.$filter.'%';
        $params[':bc_phone_num3'] = '%'.$filter.'%';
        $params[':bc_gender'] = '%'.$filter.'%';
        $params[':bc_email_address'] = '%'.$filter.'%';
        $params[':applicant_civil_status'] = '%'.$filter.'%';
        $params[':applicant_nationality'] = '%'.$filter.'%';
    }

    foreach($order as $i=>$_order){
      $order_str_query .= $_order['col']." ".$_order['type'];
      if(next($order)){
        $order_str_query .= ", ";
      }
    }

    $sql_statement = "SELECT COUNT(1) as 'num'
                      FROM `tbl_applicant`
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
                      LEFT JOIN (SELECT jfa.*
                                 FROM (SELECT max(jfa_id) as jfa_id, jfa_jf_id, jfa_attendee_id, jfa_type
                                       FROM `tbl_job_fair_attendance`
                                       GROUP BY jfa_jf_id, jfa_attendee_id, jfa_type) max_jfa
                                 INNER JOIN `tbl_job_fair_attendance` jfa
                                 ON jfa.jfa_id = max_jfa.jfa_id) jfa
                      ON `applicant_id` = jfa.`jfa_attendee_id` AND jfa.`jfa_type` = '2' AND `jfa_jf_id` = '".$jf_id."'
                      " . $where_str_query;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result['count'] = $stmt->fetch(\PDO::FETCH_ASSOC)['num'];

    $sql_statement = "SELECT ".$column_str_query."
                      FROM `tbl_applicant`
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
                      LEFT JOIN (SELECT jfa.*
                                 FROM (SELECT max(jfa_id) as jfa_id, jfa_jf_id, jfa_attendee_id, jfa_type
                                       FROM `tbl_job_fair_attendance`
                                       GROUP BY jfa_jf_id, jfa_attendee_id, jfa_type) max_jfa
                                 INNER JOIN `tbl_job_fair_attendance` jfa
                                 ON jfa.jfa_id = max_jfa.jfa_id) jfa
                      ON `applicant_id` = jfa.`jfa_attendee_id` AND jfa.`jfa_type` = '2' AND `jfa_jf_id` = '".$jf_id."'
                      " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    $result['total_count'] = $this->getAllCount();

		return $result;
  }



  public function selectDataTableEmployer($filter, $columns, $limit, $offset, $order, $jf_id){
    $result = array(
      'data'  => array()
    , 'total_count'=>0
    , 'count'=>0
    );

    $order_str_query = "ORDER BY ";
    $limit_str_query = "LIMIT :limit OFFSET :offset";
    $column_str_query = "";
    $where_str_query = "WHERE user_type = '3' ";
    $params = array();

    $column_str_query = ' user_name, employer_id, employer_name, employer_address,
                          bc_email_address, bc_phone_num1, bc_phone_num2, bc_phone_num3, jfa.jfa_id, jfa.jfa_time_in, jfa.jfa_time_out ';
    if(!empty($filter)){
        $where_str_query .= " AND ( employer_name LIKE :employer_name OR bc_email_address LIKE :bc_email_address
                            OR bc_phone_num1 LIKE :bc_phone_num1 OR bc_phone_num2 LIKE :bc_phone_num2 OR
                            bc_phone_num3 LIKE :bc_phone_num3) ";
        $params[':employer_name'] = '%'.$filter.'%';
        $params[':bc_email_address'] = '%'.$filter.'%';
        $params[':bc_phone_num1'] = '%'.$filter.'%';
        $params[':bc_phone_num2'] = '%'.$filter.'%';
        $params[':bc_phone_num3'] = '%'.$filter.'%';
    }

    foreach($order as $i=>$_order){
      $order_str_query .= $_order['col']." ".$_order['type'];
      if(next($order)){
        $order_str_query .= ", ";
      }
    }

    $sql_statement = "SELECT COUNT(1) as 'num'
                      FROM `tbl_employer`
                      INNER JOIN `tbl_basic_contact`
                      ON `employer_bc_id` = `bc_id`
                      INNER JOIN `tbl_user`
                      ON `employer_user_id` = `user_id`
                      LEFT JOIN (SELECT jfa.*
                                 FROM (SELECT max(jfa_id) as jfa_id, jfa_jf_id, jfa_attendee_id, jfa_type
                                       FROM `tbl_job_fair_attendance`
                                       GROUP BY jfa_jf_id, jfa_attendee_id, jfa_type) max_jfa
                                 INNER JOIN `tbl_job_fair_attendance` jfa
                                 ON jfa.jfa_id = max_jfa.jfa_id) jfa
                      ON `employer_id` = jfa.`jfa_attendee_id` AND jfa.`jfa_type` = '3' AND `jfa_jf_id` = '".$jf_id."'
                      " . $where_str_query;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result['count'] = $stmt->fetch(\PDO::FETCH_ASSOC)['num'];

    $sql_statement = "SELECT ".$column_str_query."
                      FROM `tbl_employer`
                      INNER JOIN `tbl_basic_contact`
                      ON `employer_bc_id` = `bc_id`
                      INNER JOIN `tbl_user`
                      ON `employer_user_id` = `user_id`
                      LEFT JOIN (SELECT jfa.*
                                 FROM (SELECT max(jfa_id) as jfa_id, jfa_jf_id, jfa_attendee_id, jfa_type
                                       FROM `tbl_job_fair_attendance`
                                       GROUP BY jfa_jf_id, jfa_attendee_id, jfa_type) max_jfa
                                 INNER JOIN `tbl_job_fair_attendance` jfa
                                 ON jfa.jfa_id = max_jfa.jfa_id) jfa
                      ON `employer_id` = jfa.`jfa_attendee_id` AND jfa.`jfa_type` = '3' AND `jfa_jf_id` = '".$jf_id."'
                      " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    $result['total_count'] = $this->getAllCount();

		return $result;
  }

  public function employerAttendanceSummary($jf_id){
    $sql_statement = "SELECT *
                        FROM `tbl_employer`
                        INNER JOIN (SELECT `jfa_jf_id`, `jfa_type`, `jfa_attendee_id`, MIN(`jfa_time_in`), MAX(`jfa_time_out`)
                        FROM `tbl_job_fair_attendance`
                        GROUP BY `jfa_jf_id`, `jfa_attendee_id`, `jfa_type`) attendee
                        ON attendee.`jfa_attendee_id` = `employer_id`
                        WHERE attendee.`jfa_jf_id` = :jfa_jf_id
                        ORDER BY `employer_name` ";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
        ':jfa_jf_id' => $jf_id
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function employerSummaryApplicant($jf_id, $employer_id){
    $sql_statement =    "SELECT *
                        FROM `tbl_job_fair`
                        INNER JOIN `tbl_job_posting`
                        ON `jf_id` = `jp_jf_id`
                        INNER JOIN `tbl_applicant_application`
                        ON `aa_jp_id` = `jp_id`
                        INNER JOIN `tbl_applicant`
                        ON `aa_applicant_id` = `applicant_id`
                        INNER JOIN `tbl_basic_contact`
                        ON `applicant_bc_id` = `bc_id`
                        INNER JOIN `tbl_address`
                        ON `address_id` = `applicant_present_id`
                        INNER JOIN `tbl_city`
                        ON `address_city_id` = `city_id`
                        INNER JOIN `tbl_province`
                        ON `address_province_id` = `province_id`
                        WHERE `jf_id` = :jf_id AND `jp_employer_id` = :jp_employer_id
                        ORDER BY `bc_last_name`, `bc_first_name`, `bc_middle_name` ";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
        ':jf_id' => $jf_id,
        ':jp_employer_id'  => $employer_id
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}

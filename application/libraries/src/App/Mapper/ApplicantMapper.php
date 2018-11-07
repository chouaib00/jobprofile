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

  public function getApplicantByIDWithExclusion($applicant_id, $exclusion_applicant_id){
    $sql_statement = "SELECT *
                      FROM  `tbl_applicant`
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
                      WHERE `applicant_id` IN (".$applicant_id.") AND `applicant_id` NOT IN (".$exclusion_applicant_id.")
                      ORDER BY bc_first_name, bc_middle_name, bc_last_name, bc_name_ext";
    $params = array();
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function selectByFilter($filter){
    $params = array();
    $where_statement = '';
    $num_of_matches_statement = '';
    $skill_match_statement = '';
    $filter_type = "";
    $num_of_matches = 0;
    switch($filter['filter-type']){
      case "most-relevant":
        $filter_type = "OR";
      break;
      case 'strict-match':
        $filter_type = "AND";
      break;
    }


    $order_statement = ' ORDER BY match_count DESC, bc_first_name ASC, bc_middle_name ASC, bc_last_name ASC';
    $condition = array();
    if(!empty($filter['applicant-educ-attainment'])){
      $condition[] = " applicant_ea_id IN (".$filter['applicant-educ-attainment'].") ";
    }

    if(!empty($filter['age-range'])){
      $agerange = explode(';', $filter['age-range']);
      $condition[] = " TIMESTAMPDIFF(YEAR, applicant_birthday, CURDATE())  BETWEEN ".$agerange[0]." AND ".$agerange[1]." ";
    }

    if(!empty($filter['add-city'])){
      $condition[] = " (present.address_city_id IN (".$filter['add-city'].")
                      OR permanent .address_city_id IN (".$filter['add-city']."))  ";
    }

    if(!empty($filter['applicant-gender'])){
      $condition[] = " bc_gender = '".$filter['applicant-gender']."'  ";
    }


    foreach($condition as $_condition){
      $where_statement .= $_condition;
      $num_of_matches_statement .= "(case when ".$_condition." then 1 else 0 end)";
      if(next($condition)){
        $where_statement.=" ".$filter_type." ";
        $num_of_matches_statement.=" + ";
      }
    }
    $num_of_matches = count($condition);
    if(strlen($where_statement)>0){
      $where_statement = 'WHERE '.$where_statement;
    }

    $sql_statement = "SELECT tbl_applicant.*, tbl_basic_contact.*, present.*, tbl_city.*, tbl_province.*, tbl_user.user_name, tbl_file_manager.*, ".$num_of_matches_statement." as match_count, ".$num_of_matches." as total_matches
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
                      INNER JOIN `tbl_address` permanent
                      ON `applicant_permanent_add_id` = permanent.`address_id` ".$where_statement.
                      ' '.$order_statement;
    $stmt = $this->prepare($sql_statement);
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
  }

  public function selectDataTable($filter, $columns, $limit, $offset, $order){
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

    $column_str_query = ' CONCAT(bc_first_name, \' \', bc_middle_name, \' \', bc_last_name, \' \', bc_name_ext) as applicant,
                          user_name, bc_phone_num1, bc_phone_num2, bc_phone_num3, bc_gender,
                          bc_email_address, TIMESTAMPDIFF(YEAR, applicant_birthday, CURDATE()) AS age,
                          applicant_civil_status, applicant_nationality,
                          CONCAT(present.address_desc, \' \', city_name, \' City \', province_name) as address ';
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
                      " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    $result['total_count'] = $this->getAllCount();

		return $result;
  }

  public function getApplicantRegisteredCount(){
    $sql_statement = "SELECT YEAR(user_register_date) year_rec, MONTH(user_register_date) month_rec, COUNT(user_id) user
                      FROM tbl_user
                      WHERE user_type = '2'
                      GROUP BY YEAR(user_register_date), month_rec LIMIT 10";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $output = array(
      'month'=> array(),
      'data'=>array()
    );
    for($i=0;$i<10&&$i<count($result);$i++){
      $month = date( 'M', strtotime($result[$i]['year_rec'].'-'.$result[$i]['month_rec'].'-01'));
      $output['month'][] = $month;
      $output['data'][] = $result[$i]['user'];
    }

    return $output;
  }
}

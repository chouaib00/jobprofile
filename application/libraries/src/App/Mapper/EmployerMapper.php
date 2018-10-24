<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class EmployerMapper extends Mapper{

  protected $_table = 'tbl_employer';


  public function selectDataTable($filter, $columns, $limit, $offset, $order){
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
                          bc_email_address, bc_phone_num1, bc_phone_num2, bc_phone_num3 ';
    if(!empty($filter)){
        $where_str_query .= " AND ( employer_name LIKE :employer_name OR bc_email_address LIKE :bc_email_address
                            OR bc_phone_num1 LIKE :bc_phone_num1 OR bc_phone_num2 LIKE :bc_phone_num2 OR
                            bc_phone_num3 LIKE :bc_phone_num3)";
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
                      " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    $result['total_count'] = $this->getAllCount();

		return $result;
  }

  public function getEmployerList(){
    $sql_statement = "SELECT *
                      FROM `tbl_employer`
                      INNER JOIN `tbl_basic_contact`
                      ON `bc_id` = `employer_bc_id`";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute(array(
    ));
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}

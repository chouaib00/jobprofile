<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class JobPostingMapper extends Mapper{

  protected $_table = 'tbl_job_posting';


  public function selectDataTable($filter, $columns, $limit, $offset, $order){
    $result = array(
      'data'  => array()
    , 'total_count'=>0
    , 'count'=>0
    );

    $order_str_query = "ORDER BY ";
    $limit_str_query = "LIMIT :limit OFFSET :offset";
    $column_str_query = "";
    $where_str_query = "";
    $params = array();

    $column_str_query = ' jp_id, jp_date_posted, employer_name, jp_title, jp_open';
    if(!empty($filter)){
        $where_str_query .= "WHERE ( employer_name LIKE :employer_name OR jp_title LIKE :jp_title)";
        $params[':employer_name'] = '%'.$filter.'%';
        $params[':jp_title'] = '%'.$filter.'%';
    }

    foreach($order as $i=>$_order){
      $order_str_query .= $_order['col']." ".$_order['type'];
      if(next($order)){
        $order_str_query .= ", ";
      }
    }

    $sql_statement = "SELECT COUNT(1) as 'num'
                      FROM `tbl_job_posting`
                      LEFT JOIN `tbl_employer`
                      ON `jp_employer_id` = `employer_id`
                      " . $where_str_query;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result['count'] = $stmt->fetch(\PDO::FETCH_ASSOC)['num'];

    $sql_statement = "SELECT ".$column_str_query."
                      FROM `tbl_job_posting`
                      LEFT JOIN `tbl_employer`
                      ON `jp_employer_id` = `employer_id`
                      " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    $result['total_count'] = $this->getAllCount();

		return $result;
  }
}

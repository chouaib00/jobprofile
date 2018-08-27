<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class SchoolMapper extends Mapper{

  protected $_table = 'tbl_school';

  public function selectDataTable($filter, $columns, $limit, $offset, $order){
    $result = array(
      'data'  => array()
    , 'total_count'=>0
    , 'count'=>0
    );

    $order_str_query = "ORDER BY ";
    $limit_str_query = "LIMIT :limit OFFSET :offset";
    $column_str_query = "";
    $where_str_query = (empty($filter))? "" : "WHERE ";
    $params = array();

    foreach($columns as $i=>$_columns){
      $isSearchable = (!empty($filter)) && ($_columns['searchable'] === 'true');
      $column_str_query .= $_columns['data'];
      if($isSearchable){
        $where_str_query .= $_columns['data'] ." LIKE :".$_columns['data']." ";
        $params[":".$_columns['data']] = '%'.$filter.'%';
      }
      if(next($columns)){
        $column_str_query .= ", ";
        if(!empty($filter) && $columns[$i+1]['searchable'] === 'true'){
            $where_str_query .= " OR ";
        }
      }
    }
    if(!empty($order)){
      foreach($order as $i=>$_order){
        $order_str_query .= $_order['col']." ".$_order['type'];
        if(next($order)){
          $order_str_query .= ", ";
        }
      }
    }
    else{
      $order_str_query = '';
    }
    if(strlen($where_str_query) <= 6){
      $where_str_query = '';
    }

    $sql_statement = "SELECT COUNT(1) as 'num'
                      FROM tbl_school
                      LEFT JOIN tbl_address
                      ON school_address_id = address_id
                      LEFT JOIN tbl_city
                      ON address_city_id = city_id
                      LEFT JOIN tbl_province
                      ON address_province_id = province_id
                      LEFT JOIN tbl_region
                      ON province_region_id = region_id
                      LEFT JOIN tbl_country
                      ON region_country_id = country_id
                      " . $where_str_query;
		$stmt = $this->prepare($sql_statement);

		$stmt->execute($params);
		$result['count'] = $stmt->fetch(\PDO::FETCH_ASSOC)['num'];

    $sql_statement = "SELECT ".$column_str_query."
                      FROM tbl_school
                      LEFT JOIN tbl_address
                      ON school_address_id = address_id
                      LEFT JOIN tbl_city
                      ON address_city_id = city_id
                      LEFT JOIN tbl_province
                      ON address_province_id = province_id
                      LEFT JOIN tbl_region
                      ON province_region_id = region_id
                      LEFT JOIN tbl_country
                      ON region_country_id = country_id " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    $result['total_count'] = $this->getAllCount();
		return $result;
  }

}

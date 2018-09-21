<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class SkillTagMapper extends Mapper{

  protected $_table = 'tbl_skill_tag';

  public function selectDataTable($filter, $columns, $limit, $offset, $order, $condition){
    $result = array(
      'data'  => array()
    , 'total_count'=>0
    , 'count'=>0
    );

    $order_str_query = "ORDER BY ";
    $limit_str_query = "LIMIT :limit OFFSET :offset";
    $column_str_query = "";
    $where_str_query = "";
    $condition_query = "";//Additional Condition goes here
    $params = array();

    foreach($columns as $i=>$_columns){
      $filter_value = (empty($_columns['search']['value']))? $filter : $_columns['search']['value'];
      $isSearchable = (!empty($filter_value)) && ($_columns['searchable'] === 'true');
      $column_str_query .= $_columns['data'];
      $column_str_query .= (empty($_columns['name']))? '' : ' as \''. $_columns['name'] .'\'';
      if($isSearchable){
        $named_params = ':'.str_replace('.','',$_columns['data']);
        $where_str_query .= $_columns['data'] ." LIKE ".$named_params." ";
        $params[$named_params] = '%'.$filter_value.'%';
        $where_str_query .= " OR ";
      }
      $column_str_query .= ", ";
    }
    $column_str_query = substr($column_str_query, 0, -2); //Remove excess ', '
    if(strlen($where_str_query)>0){
      $where_str_query = substr($where_str_query, 0, -3); //Remove excess 'OR '
      $where_str_query = '('.$where_str_query.')';
    }


    foreach($condition as $_condition){
      if(!empty($_condition['value'])){
        $condition_query .= $_condition['column'].' = :'.$_condition['column'].' AND ';
        $params[":".$_condition['column']] = $_condition['value'];
      }
    }
    if(strlen($condition_query) > 0){
      $condition_query = substr($condition_query, 0, -4); //Remove excess 'AND '
      $condition_query = '('.$condition_query.')';
      $where_str_query .= (strlen($where_str_query)>0)? ' AND '.$condition_query : $condition_query;

    }

    if(!empty($order)){
      foreach($order as $i=>$_order){
        $order_str_query .= $_order['col']." ".$_order['type'];
        $order_str_query .= ", ";
      }
      $order_str_query = substr($order_str_query, 0, -2); //Remove excess ', '
    }
    else{
      $order_str_query = '';
    }
    if(strlen($where_str_query) > 0){
      $where_str_query = 'WHERE '.$where_str_query;
    }

    $sql_statement = "SELECT COUNT(1) as 'num' FROM tbl_skill_tag " . $where_str_query;
		$stmt = $this->prepare($sql_statement);

		$stmt->execute($params);
		$result['count'] = $stmt->fetch(\PDO::FETCH_ASSOC)['num'];

    $sql_statement = "SELECT ".$column_str_query." FROM tbl_skill_tag " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    $result['total_count'] = $this->getAllCount();
		return $result;
  }
}

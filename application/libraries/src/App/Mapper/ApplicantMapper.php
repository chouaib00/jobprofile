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

  public function selectDataTable($filter, $columns, $limit, $offset, $order){
    $result = array(
      'data'  => array()
    , 'total_count'=>0
    , 'count'=>0
    );

    $order_str_query = "ORDER BY ";
    $limit_str_query = "LIMIT :limit OFFSET :offset";
    $column_str_query = "";
    $where_str_query = "WHERE user_type = '1' ";
    $params = array();

    $column_str_query = ' admin_id, CONCAT(bc_first_name,\' \',bc_middle_name,\' \',bc_last_name,\' \',bc_name_ext) as \'full_name\',
                        user_name, bc_gender';
    if(!empty($filter)){
        $where_str_query .= " bc_first_name LIKE :bc_first_name OR bc_middle_name LIKE :bc_middle_name
                            OR bc_last_name LIKE :bc_last_name OR bc_name_ext LIKE :bc_name_ext OR
                            user_name LIKE :user_name OR bc_gender LIKE :bc_gender ";
        $params[':bc_first_name'] = '%'.$filter.'%';
        $params[':bc_middle_name'] = '%'.$filter.'%';
        $params[':bc_last_name'] = '%'.$filter.'%';
        $params[':bc_name_ext'] = '%'.$filter.'%';
        $params[':user_name'] = '%'.$filter.'%';
        $params[':bc_gender'] = '%'.$filter.'%';
    }
    // foreach($columns as $i=>$_columns){
    //   $isSearchable = (!empty($filter)) && ($_columns['searchable'] === 'true');
    //   $column_str_query .= $_columns['data'];
    //   if($isSearchable){
    //     $where_str_query .= $_columns['data'] ." LIKE :".$_columns['data']." ";
    //     $params[":".$_columns['data']] = '%'.$filter.'%';
    //   }
    //   if(next($columns)){
    //     $column_str_query .= ", ";
    //     if(!empty($filter) && $columns[$i+1]['searchable'] === 'true'){
    //         $where_str_query .= " OR ";
    //     }
    //   }
    // }

    foreach($order as $i=>$_order){
      $order_str_query .= $_order['col']." ".$_order['type'];
      if(next($order)){
        $order_str_query .= ", ";
      }
    }

    $sql_statement = "SELECT COUNT(1) as 'num'
                      FROM `tbl_admin`
                      INNER JOIN `tbl_user`
                      ON admin_user_id = user_id
                      INNER JOIN `tbl_basic_contact`
                      ON admin_bc_id = bc_id " . $where_str_query;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result['count'] = $stmt->fetch(\PDO::FETCH_ASSOC)['num'];

    $sql_statement = "SELECT ".$column_str_query."
                      FROM `tbl_admin`
                      INNER JOIN `tbl_user`
                      ON admin_user_id = user_id
                      INNER JOIN `tbl_basic_contact`
                      ON admin_bc_id = bc_id " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;
		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    $result['total_count'] = $this->getAllCount();

		return $result;
  }
}

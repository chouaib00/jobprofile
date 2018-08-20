<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class FieldOfStudyMapper extends Mapper{

  protected $_table = 'tbl_field_of_study';

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
      $column_str_query .=  $_columns['data'];
      $column_str_query .= (empty($_columns['name']))? '' : ' as \''. $_columns['name'] .'\'';
      if($isSearchable){
        $named_params = ':'.str_replace('.','',$_columns['data']);
        $where_str_query .= $_columns['data'] ." LIKE ".$named_params." ";
        $params[$named_params] = '%'.$filter.'%';
      }
      if(next($columns)){
        $column_str_query .= ", ";
        if(!empty($filter) && $columns[$i+1]['searchable'] === 'true'){
            $where_str_query .= " OR ";
        }
      }
    }

    foreach($order as $i=>$_order){
      $order_str_query .= $_order['col']." ".$_order['type'];
      if(next($order)){
        $order_str_query .= ", ";
      }
    }

    $sql_statement = "SELECT COUNT(1) as 'num'
                      FROM `tbl_field_of_study` child
                      LEFT JOIN `tbl_field_of_study` parent
                      ON child.fos_parent_fos_id = parent.fos_id " . $where_str_query;
		$stmt = $this->prepare($sql_statement);
		$stmt->execute($params);
		$result['count'] = $stmt->fetch(\PDO::FETCH_ASSOC)['num'];
    $sql_statement = "SELECT ".$column_str_query."
                      FROM `tbl_field_of_study` child
                      LEFT JOIN `tbl_field_of_study` parent
                      ON child.fos_parent_fos_id = parent.fos_id " . $where_str_query . " " . $order_str_query. " ".$limit_str_query;

		$stmt = $this->prepare($sql_statement);
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;

		$stmt->execute($params);
		$result['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


    $result['total_count'] = $this->getAllCount();




		return $result;
  }

  public function selectAllHeader(){
    	$sql_statement = "SELECT * FROM tbl_field_of_study WHERE fos_parent_fos_id IS NULL";
  		$stmt = $this->prepare($sql_statement);
  		$stmt->execute();
  		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  		return $result;
  }

	// public function selectAll(){
	// 	$sql_statement = "SELECT * FROM dms_doc_track_entry";
	// 	$stmt = $this->prepare($sql_statement);
	// 	$stmt->execute();
	// 	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
	// 	return $result;
	// }

	// public function selectByDocTrackSlipID($id){
	// 	$sql_statement = "SELECT dte.*,
	// 					emp_from.emp_id as `emp_from_id`,
	// 					emp_from.emp_name as `emp_from_name`,
	// 					emp_from.emp_img_name as `emp_from_img_name`,
	// 					dept_from.edpt_id as `dept_from_id`,
	// 					dept_from.edpt_name as `dept_from_name`,
	// 					emp_to.emp_id as `emp_to_id`,
	// 					emp_to.emp_name as `emp_to_name`,
	// 					emp_to.emp_img_name as `emp_to_img_name`,
	// 					dept_to.edpt_id as `dept_to_id`,
	// 					dept_to.edpt_name as `dept_to_name`
	// 					FROM dms_doc_track_entry dte
	// 					LEFT JOIN dms_employee emp_from
	// 					ON dte.dte_from_emp_id = emp_from.emp_id
	// 					LEFT JOIN dms_emp_dept dept_from
	// 					ON emp_from.edpt_id = dept_from.edpt_id
	// 					LEFT JOIN dms_employee emp_to
	// 					ON dte.dte_to_emp_id = emp_to.emp_id
	// 					LEFT JOIN dms_emp_dept dept_to
	// 					ON emp_to.edpt_id = dept_to.edpt_id
	// 					WHERE dts_id = ?";
	// 	$stmt = $this->prepare($sql_statement);
	// 	$stmt->execute(array($id));
	// 	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
	// 	return $result;
	// }
  //
  //
	// public function selectByDocTrackSlipIDExceptEmpID($dts_id, $emp_id){
	// 	$sql_statement = "SELECT dte.*,
	// 					emp_from.emp_id as `emp_from_id`,
	// 					emp_from.emp_name as `emp_from_name`,
	// 					emp_from.emp_img_name as `emp_from_img_name`,
	// 					dept_from.edpt_id as `dept_from_id`,
	// 					dept_from.edpt_name as `dept_from_name`,
	// 					emp_to.emp_id as `emp_to_id`,
	// 					emp_to.emp_name as `emp_to_name`,
	// 					emp_to.emp_img_name as `emp_to_img_name`,
	// 					dept_to.edpt_id as `dept_to_id`,
	// 					dept_to.edpt_name as `dept_to_name`
	// 					FROM dms_doc_track_entry dte
	// 					LEFT JOIN dms_employee emp_from
	// 					ON dte.dte_from_emp_id = emp_from.emp_id
	// 					LEFT JOIN dms_emp_dept dept_from
	// 					ON emp_from.edpt_id = dept_from.edpt_id
	// 					LEFT JOIN dms_employee emp_to
	// 					ON dte.dte_to_emp_id = emp_to.emp_id
	// 					LEFT JOIN dms_emp_dept dept_to
	// 					ON emp_to.edpt_id = dept_to.edpt_id
	// 					WHERE dts_id = ? AND dte.dte_from_emp_id != ?";
	// 	$stmt = $this->prepare($sql_statement);
	// 	$stmt->execute(array($dts_id, $emp_id));
	// 	$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
	// 	return $result;
	// }
  //
	// public function selectByID($id){
	// 	$sql_statement = "SELECT * FROM dms_doc_track_entry WHERE dte_id = ?";
	// 	$stmt = $this->prepare($sql_statement);
	// 	$stmt->execute(array($id));
	// 	$result = $stmt->fetch(\PDO::FETCH_ASSOC);
	// 	return $this->loadDocTrackEntry($result);
	// }
  //
	// public function insert($data){
	// 	$sql_statement = "INSERT INTO dms_doc_track_entry(
	// 								dts_id,
	// 								dte_from_emp_id,
	// 								dte_from_date,
	// 								dte_to_emp_id,
	// 								dte_to_date,
	// 								dte_msg,
	// 								dte_read_date)
	// 						VALUES
	// 							(  	:dts_id,
	// 								:dte_from_emp_id,
	// 								:dte_from_date,
	// 								:dte_to_emp_id,
	// 								:dte_to_date,
	// 								:dte_msg,
	// 								:dte_read_date) ";
  //
	// 	$stmt = $this->prepare($sql_statement);
	// 	$stmt->execute(array(
	// 					':dts_id' => $data->_dts_id,
	// 					':dte_from_emp_id' => $data->_from_emp_id,
	// 					':dte_from_date' => $data->_from_date,
	// 					':dte_to_emp_id' => $data->_to_emp_id,
	// 					':dte_to_date' => $data->_to_date,
	// 					':dte_msg' => $data->_msg,
	// 					':dte_read_date' => $data->_read_date
	// 					));
	// 	return $this->lastInsertId();
	// }
  //
	// public function updateByID($data){
	// 	$sql_statement = "UPDATE dms_doc_track_entry SET
	// 								dts_id = :dts_id,
	// 								dte_from_emp_id = :dte_from_emp_id,
	// 								dte_from_date = :dte_from_date,
	// 								dte_to_emp_id = :dte_to_emp_id,
	// 								dte_to_date = :dte_to_date,
	// 								dte_msg = :dte_msg,
	// 								dte_read_date = :dte_read_date
	// 								WHERE dte_id = :dte_id";
	// 	$stmt = $this->prepare($sql_statement);
	// 	$stmt->execute(array(
	// 					':dts_id' => $data->_dts_id,
	// 					':dte_from_emp_id' => $data->_from_emp_id,
	// 					':dte_from_date' => $data->_from_date,
	// 					':dte_to_emp_id' => $data->_to_emp_id,
	// 					':dte_to_date' => $data->_to_date,
	// 					':dte_msg' => $data->_msg,
	// 					':dte_read_date' => $data->_read_date,
	// 					':dte_id' => $data->_id
	// 					));
	// 	if( !$stmt->rowCount() ) {
	// 		return false;
	// 	}
	// 	return true;
	// }
  //
	// public function delete($id){
	// 	$sql_statement = "DELETE FROM dms_doc_track_entry WHERE dte_id = ?";
	// 	$stmt = $this->prepare($sql_statement);
	// 	$stmt->execute(array($id));
	// 	if( !$stmt->rowCount() ) {
	// 		return false;
	// 	}
	// 	return true;
	// }
  //
	// private function loadDocTrackEntry($row){
	// 	if(is_array($row)){
	// 		return new DocTrackEntry( $row['dte_id'],
	// 						$row['dts_id'],
	// 						$row['dte_from_emp_id'],
	// 						$row['dte_from_date'],
	// 						$row['dte_to_emp_id'],
	// 						$row['dte_to_date'],
	// 						$row['dte_msg'],
	// 						$row['dte_read_date']);
	// 	} else return null;
	// }

}

<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class UserMapper extends Mapper{

  protected $_table = 'tbl_user';

  public function selectByLoginPassword($username_email, $password){
    $sql_statement = "SELECT *
                      FROM tbl_user
                      WHERE (user_email = :user_email OR user_name = :user_name) AND  user_password = :user_password";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute(array(
      ':user_email'   => $username_email
    , ':user_name'   => $username_email
    , ':user_password'=> $password
    ));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
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

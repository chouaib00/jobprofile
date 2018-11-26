<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jobfair extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function announcement_table(){
		$limit = isset($_POST['length'])? $_POST['length'] : '0';
		$offset = isset($_POST['start'])? $_POST['start'] : '0';
		$condition = isset($_POST['condition'])? $_POST['condition'] : array();
		$search = $_POST['search'];
		$columns = $_POST['columns'];
		$order = isset($_POST['order'])? $_POST['order'] : array();
		$orders = array();

		foreach($order as $_order){
			array_push($orders, array(
				'col'=> $columns[$_order['column']]['data']
			,	'type'	=> $_order['dir']
			));
		}
		$announcementMapper = new App\Mapper\AnnouncementMapper();

		$result = $announcementMapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders, $condition);
		echo json_encode($result);
	}

	public function attendance_log(){
		$input = $_POST;
		$jobFairAttendanceMapper = new App\Mapper\JobFairAttendanceMapper();
		$jobFairMapper = new App\Mapper\JobFairMapper();
		$jf_id = $jobFairMapper->getActive();

		$currentAttendance = $jobFairAttendanceMapper->getByFilter("jfa_jf_id = '".$jf_id."' AND jfa_type = '".$input['type']."' AND jfa_attendee_id = '".$input['attendee_id']."' ORDER BY jfa_id DESC ", true);

		if(!empty($currentAttendance)){

			if($currentAttendance['jfa_time_out']){
				$jfa = array(
						'jfa_jf_id' => $jf_id
					,	'jfa_type'=>$input['type']
					,	'jfa_attendee_id'=>$input['attendee_id']
					,	'jfa_is_reentry'	=>'1'
				);
				if($input['checked'] == '1'){
					$jfa['jfa_time_in'] = date("Y-m-d H:i:s");
				}
				$jfa_id = $jobFairAttendanceMapper->insert($jfa);
			}
			else{
				$jobFairAttendanceMapper->update(array(
					'jfa_time_out' => date("Y-m-d H:i:s")
				), "jfa_id = '".$currentAttendance['jfa_id']."'");
			}
		}
		else{
			$jfa = array(
					'jfa_jf_id' => $jf_id
				,	'jfa_type'=>$input['type']
				,	'jfa_attendee_id'=>$input['attendee_id']
				,	'jfa_is_reentry'	=>'0'
			);
			if($input['checked'] == '1'){
				$jfa['jfa_time_in'] = date("Y-m-d H:i:s");
			}
			$jfa_id = $jobFairAttendanceMapper->insert($jfa);
		}

		echo json_encode(array('success'=>true));

	}

	public function applicant_table(){
		$limit = isset($_POST['length'])? $_POST['length'] : '0';
		$offset = isset($_POST['start'])? $_POST['start'] : '0';
		$condition = isset($_POST['condition'])? $_POST['condition'] : array();
		$search = $_POST['search'];
		$columns = $_POST['columns'];
		$order = isset($_POST['order'])? $_POST['order'] : array();
		$orders = array();

		foreach($order as $_order){
			array_push($orders, array(
				'col'=> $columns[$_order['column']]['data']
			,	'type'	=> $_order['dir']
			));
		}
		$jobFairAttendanceMapper = new App\Mapper\JobFairAttendanceMapper();
		$jobFairMapper = new App\Mapper\JobFairMapper();
		$jf_id = $jobFairMapper->getActive();
		$result = $jobFairAttendanceMapper->selectDataTableApplicant($search['value'], $columns, $limit, $offset, $orders, $jf_id);
		echo json_encode($result);
	}

	public function employer_table(){
		$limit = isset($_POST['length'])? $_POST['length'] : '0';
		$offset = isset($_POST['start'])? $_POST['start'] : '0';
		$condition = isset($_POST['condition'])? $_POST['condition'] : array();
		$search = $_POST['search'];
		$columns = $_POST['columns'];
		$order = isset($_POST['order'])? $_POST['order'] : array();
		$orders = array();

		foreach($order as $_order){
			array_push($orders, array(
				'col'=> $columns[$_order['column']]['data']
			,	'type'	=> $_order['dir']
			));
		}

		$jobFairAttendanceMapper = new App\Mapper\JobFairAttendanceMapper();
		$jobFairMapper = new App\Mapper\JobFairMapper();
		$jf_id = $jobFairMapper->getActive();
		$result = $jobFairAttendanceMapper->selectDataTableEmployer($search['value'], $columns, $limit, $offset, $orders, $jf_id);
		echo json_encode($result);
	}

	public function summary(){
		$jobFairMapper = new App\Mapper\JobFairMapper();
		$jf_id = $jobFairMapper->getActive();

		$this->is_secure = true;
		$this->view('jobfair/summary');
	}


  public function attendance(){
			$this->is_secure = true;
      $this->view('jobfair/attendance');
  }


}

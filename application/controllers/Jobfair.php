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

		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// $id = $_POST['id'];
		// $announcementMapper->delete("annoucement_id = '".$id."'");
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


  public function attendance(){
			$this->is_secure = true;
      $this->view('jobfair/attendance');
  }
	public function job_fair(){
			$jobFairMapper = new App\Mapper\JobFairMapper();
			$jobFair = $jobFairMapper->getList();
			$this->_data['job_fair_list'] = $jobFair;
			$this->is_secure = true;
      $this->view('jobfair/attendance');
  }

	public function add_job_fair(){
			$jobFairMapper = new App\Mapper\JobFairMapper();

			$input = $_POST;
			if(!empty($input)){
				if(isset($input['job-fair-active'])){
					$jobFairMapper->update(array(
						'js_is_current'=>'0'
					), '');
				}
				$jf_id = $jobFairMapper->insert(
					array(
						'jf_is_status'	=> $input['job-fair-status']
					,	'js_title'	=> $input['job-fair-title']
					,	'js_summary'	=> $input['job-fair-summary']
					,	'js_is_current'	=> isset($input['job-fair-active'])? '1': '0'
					,	'js_date_from'	=> date('Y/m/d', strtotime($input['job-fair-start-date']))
					,	'js_date_to'	=> date('Y/m/d', strtotime($input['job-fair-end-date']))
					)
				);
				$this->set_alert(array(
					'message'=>'<i class="fa fa-check"></i> Successfully set and added a job fair event!'
				,	'type'=>'success'
				,	'href'=>DOMAIN.'utility/job-fair'
				,	'text'=>'Job Fair List'
				));
				$this->redirect(DOMAIN.'utility/edit-job-fair/'.$jf_id);
			}

			$form_data = [
				'jf_is_status' => ''
			,	'js_title'	=>	''
			,	'js_summary'	=>	''
			,	'js_is_current'	=>	''
			,	'js_date_from'	=>	''
			,	'js_date_to'	=>	''
			];
			$this->_data['action'] = 'add';
			$this->_data['form_data'] = $form_data;
			$this->is_secure = true;
      $this->view('utility/jobfair/form');
  }

	public function edit_job_fair($jf_id){
			$jobFairMapper = new App\Mapper\JobFairMapper();
			$jobFair = $jobFairMapper->getByFilter("jf_id = '".$jf_id."'", true);
			$input = $_POST;
			if(!empty($input)){
				if(isset($input['job-fair-active'])){
					$jobFairMapper->update(array(
						'js_is_current'=>'0'
					), '');
				}
				$jobFairMapper->update(
					array(
							'jf_is_status'	=> $input['job-fair-status']
						,	'js_title'	=> $input['job-fair-title']
						,	'js_summary'	=> $input['job-fair-summary']
						,	'js_is_current'	=> isset($input['job-fair-active'])? '1': '0'
						,	'js_date_from'	=> date('Y/m/d', strtotime($input['job-fair-start-date']))
						,	'js_date_to'	=> date('Y/m/d', strtotime($input['job-fair-end-date']))
					),
					"jf_id = '".$jf_id."'"
				);
				$this->set_alert(array(
					'message'=>'<i class="fa fa-check"></i> Job Fair Details has been successfully updated!'
				,	'type'=>'success'
				,	'href'=>DOMAIN.'utility/job-fair'
				,	'text'=>'Job Fair List'
				));
			}
			$jobFair = $jobFairMapper->getByFilter("jf_id = '".$jf_id."'", true);
			$this->_data['action'] = 'edit';
			$this->_data['form_data'] = $jobFair;
			$this->is_secure = true;
      $this->view('utility/jobfair/form');
  }

	public function add_announcement(){
		$announcementMapper = new App\Mapper\AnnouncementMapper();
		$adminMapper = new App\Mapper\AdminMapper();
		$data = array(
				'announcement_title'=>''
			,	'announcement_content'=>''
		);
		if(!empty($_POST)){
				$admin = $adminMapper->getByID($_SESSION['current_user']['id']);
				$insert_data = array();
				$insert_data['announcement_title'] = $_POST['announcement-title'];
				$insert_data['announcement_content'] = $_POST['announcement-content'];
				$insert_data['announcement_admin_id'] = $admin['admin_id'];
				$announcementMapper->insert($insert_data);
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;
		$this->is_secure = true;
		$this->view('utility/announcement/form');
	}

	public function edit_announcement($id){
		$announcementMapper = new App\Mapper\AnnouncementMapper();

		if(!empty($_POST)){
				$update_data = array();
				$update_data['announcement_title'] = $_POST['announcement-title'];
				$update_data['announcement_content'] = $_POST['announcement-content'];
				$announcementMapper->update($update_data, " annoucement_id ='".$id."'");
		}
		$announcement = $announcementMapper->getByID($id);
		if(empty($school));//Show 404
		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $announcement;
		$this->is_secure = true;
    $this->view('utility/announcement/form');
	}

	public function delete_announcement(){
		$announcementMapper = new App\Mapper\AnnouncementMapper();
		$id = $_POST['id'];
		$announcementMapper->delete("annoucement_id = '".$id."'");
		echo json_encode(array('success'=>true));

	}

	public function edit_page($id){
		$pageMapper = new App\Mapper\PageMapper();
		$page = $pageMapper->getByFilter("page_id = '".$id."'", true);

		if(!empty($_POST)){
			$pageMapper->update(array(
				'page_context'=>$_POST['page-content']
			), "page_id = '".$id."'");
		}
		$page = $pageMapper->getByFilter("page_id = '".$id."'", true);

		$this->is_secure = true;
		$this->_data['form_data'] = $page;
		$this->view('utility/page/form');
	}
}

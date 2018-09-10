<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utility extends Controller {

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



  public function announcement(){
			$this->is_secure = true;
			if($_SESSION['current_user']['type'] == '1'){
				//Means Admin
				$this->_template = 'templates/admin_main';
			}
			if($_SESSION['current_user']['type'] == '2'){
				//Means Applicant
				$this->_template = 'templates/applicant_main';
			}
      $this->view('utility/announcement/list');
  }

	public function add_announcement(){
		$announcementMapper = new App\Mapper\AnnouncementMapper();
		$adminMapper = new App\Mapper\AdminMapper();
		$this->_template = 'templates/admin_main';
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

		$this->_template = 'templates/admin_main';
    $this->view('utility/announcement/form');
	}

	public function delete_announcement(){
		$announcementMapper = new App\Mapper\AnnouncementMapper();
		$id = $_POST['id'];
		$announcementMapper->delete("annoucement_id = '".$id."'");
		echo json_encode(array('success'=>true));

	}

}

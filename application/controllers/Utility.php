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
      $this->view('utility/announcement');
  }
}

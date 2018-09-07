<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Applicant extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function applicant_ref(){
		$limit = $_POST['length'];
		$offset = $_POST['start'];
		$search = $_POST['search'];
		$columns = $_POST['columns'];
		$option = $_POST['option'];
		$orders = array();

		foreach($_POST['order'] as $_order){
			array_push($orders, array(
				'col'=> $_POST['columns'][$_order['column']]['data']
			,	'type'	=> $_order['dir']
			));
		}
		$mapper = new App\Mapper\AdminMapper();

		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders);

		echo json_encode($result);
	}

	public function list(){
		$this->_template = 'templates/admin_main';
    $this->view('applicant/list');
	}

	public function save_profile(){
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
	}

  public function update_profile($username = ""){
		$userMapper = new App\Mapper\UserMapper();
		$applicantMapper = new App\Mapper\ApplicantMapper();
		$basicContactMapper = new App\Mapper\BasicContactMapper();
		$user = null;
		$applicant = null;
		if($this->sess->isLogin()){
			$user = $userMapper->getByFilter(array(
				array(
					'column'=>'user_id'
				,	'value'	=>$_SESSION['current_user']['id']
				)
			), true);
		}
		if(!$user){
			$user = $userMapper->getByFilter(array(
				array(
					'column'=>'user_name'
				,	'value'	=>$username
				)
			), true);
		}
		if(!$user);//Show 404;
		$applicant = $applicantMapper->getByFilter("applicant_user_id = '". $user['user_id']."' ", true);
		$basicContact = $basicContactMapper->getByFilter("bc_id = '".$applicant['applicant_bc_id']."'", true);
		$form_data = array(
				'applicant_first_name' => $basicContact['bc_first_name']
			,	'applicant_middle_name' => $basicContact['bc_middle_name']
			,	'applicant_last_name' => $basicContact['bc_last_name']
			,	'applicant_name_ext' => $basicContact['bc_name_ext']
			,	'present_add_desc' => ''
			,	'present_add_country' => ''
			,	'permanent_add_desc' => ''
			,	'permanent_add_country' => ''
			,	'applicant_gender' => 'male'
			,	'applicant_birthday' => ''
			,	'applicant_civil_status' => $applicant['applicant_civil_status']
			,	'applicant_nationality' => $applicant['applicant_nationality']
			,	'applicant_citizenship' => $applicant['applicant_citizenship']
			,	'applicant_educ_attainment' => ''
			,	'phone_number_1' => $basicContact['bc_phone_num1']
			,	'phone_number_2' => $basicContact['bc_phone_num2']
			,	'phone_number_3' => $basicContact['bc_phone_num3']
		);
		$this->_data['form_data'] = $form_data;

		$this->is_secure = true;
    $this->_template = 'templates/applicant_main';
    $this->view('applicant/update_profile', $form_data);
  }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function admin_ref(){
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
    $this->view('administrator/list');
  }

	public function add_admin(){
		$userMapper = new App\Mapper\UserMapper();
		$adminMapper = new App\Mapper\AdminMapper();
		$basicContactMapper = new App\Mapper\BasicContactMapper();

		$regionMapper = new App\Mapper\RegionMapper();
		$countryMapper = new App\Mapper\CountryMapper();
		$data = array(
				'region_id' => ''
			,	'region_country_id' => ''
			,	'region_code' => ''
			,	'region_desc' => ''
		);
		if(!empty($_POST)){
				$insert_basic_contact = array(
					'bc_first_name'			=>$_POST['first-name']
				,	'bc_middle_name'	=>$_POST['middle-name']
				,	'bc_last_name'	=>$_POST['last-name']
				,	'bc_name_ext'	=>$_POST['name-ext']
				,	'bc_phone_num1'	=>''
				,	'bc_phone_num2'	=>''
				,	'bc_phone_num3'	=>''
				,	'bc_gender'	=>$_POST['gender']
				,	'bc_email_address'	=>$_POST['user-email']
				,	'bc_present_address_id'	=>NULL
				,	'bc_permanent_address_id'	=> NULL
				);
				$bc_id = $basicContactMapper->insert($insert_basic_contact);

				$insert_user = array(
					'user_name'			=>$_POST['user-id']
				,	'user_password'	=>$_POST['user-password']
				,	'user_email'	=>$_POST['user-email']
				,	'user_type'	=> 1
				);
				$userMapper->insert($insert_user);

				$insert_admin = array(
					'admin_user_name'	=> $insert_user['user_name']
				,	'admin_bc_id'	=> $bc_id
				);
				$adminMapper->insert($insert_admin);

		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->_template = 'templates/admin_main';
    $this->view('administrator/form');
	}

}

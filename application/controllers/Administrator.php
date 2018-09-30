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
		$this->is_secure = true;
    $this->view('administrator/list');
  }

	public function add_admin(){
		$userMapper = new App\Mapper\UserMapper();
		$adminMapper = new App\Mapper\AdminMapper();
		$basicContactMapper = new App\Mapper\BasicContactMapper();

		$data = array(
				'admin_first_name' => ''
			,	'admin_middle_name' => ''
			,	'admin_last_name' => ''
			,	'admin_name_ext' => ''
			,	'admin_gender' => 'male'
			,	'admin_email' => ''
			,	'user_name' => ''
		);
		if(!empty($_POST)){
				$insert_basic_contact = array(
					'bc_first_name'			=>$_POST['admin-first-name']
				,	'bc_middle_name'	=>$_POST['admin-middle-name']
				,	'bc_last_name'	=>$_POST['admin-last-name']
				,	'bc_name_ext'	=>$_POST['admin-name-ext']
				,	'bc_phone_num1'	=>''
				,	'bc_phone_num2'	=>''
				,	'bc_phone_num3'	=>''
				,	'bc_gender'	=>$_POST['gender']
				,	'bc_email_address'	=>$_POST['user-email']
				);
				$bc_id = $basicContactMapper->insert($insert_basic_contact);

				 $insert_user = array(
					'user_name'			=>$_POST['user-name']
				,	'user_password'	=>Encrypt($_POST['user-password'])
				,	'user_email'	=>$_POST['user-email']
				,	'user_type'	=> 1
				,	'user_fm_id'	=> 0
				);
				$user_id =$userMapper->insert($insert_user);

				$insert_admin = array(
					'admin_user_id'	=> $user_id
				,	'admin_bc_id'	=> $bc_id
				);
				$adminMapper->insert($insert_admin);
				$this->set_alert(array(
					'message'=>'<i class="fa fa-check"></i> Successfully added a administrator!'
				,	'type'=>'success'
				));
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('administrator/form');
	}

	public function edit_admin($admin_id){
		$userMapper = new App\Mapper\UserMapper();
		$adminMapper = new App\Mapper\AdminMapper();
		$basicContactMapper = new App\Mapper\BasicContactMapper();


		$admin = $adminMapper->getByFilter("admin_id = '". $admin_id."' ", true);
		$basicContact = $basicContactMapper->getByFilter("bc_id = '". $admin['admin_bc_id']."' ", true);
		$user = $userMapper->getByFilter("user_id = '". $admin['admin_user_id']."' ", true);

		if(!empty($_POST)){
				$update_basic_contact = array(
					'bc_first_name'			=>$_POST['admin-first-name']
				,	'bc_middle_name'	=>$_POST['admin-middle-name']
				,	'bc_last_name'	=>$_POST['admin-last-name']
				,	'bc_name_ext'	=>$_POST['admin-name-ext']
				,	'bc_phone_num1'	=>''
				,	'bc_phone_num2'	=>''
				,	'bc_phone_num3'	=>''
				,	'bc_gender'	=>$_POST['gender']
				,	'bc_email_address'	=>$_POST['user-email']
				);
				$basicContactMapper->update($update_basic_contact, "bc_id = '". $admin['admin_bc_id']."' ");

				$update_user = array(
					'user_name'			=>$_POST['user-name']
				,	'user_email'	=>$_POST['user-email']
				,	'user_type'	=> 1
				,	'user_fm_id'	=> 0
				);
				if(!empty($_POST['user-password'])){
					$update_user['user_password'] = Encrypt($_POST['user-password']);
				}
				$userMapper->update($update_user, "user_id = '". $admin['admin_user_id']."' ");

				$this->set_alert(array(
					'message'=>'<i class="fa fa-check"></i> Successfully updated!'
				,	'type'=>'success'
				));
		}

		$admin = $adminMapper->getByFilter("admin_id = '". $admin_id."' ", true);
		$basicContact = $basicContactMapper->getByFilter("bc_id = '". $admin['admin_bc_id']."' ", true);
		$user = $userMapper->getByFilter("user_id = '". $admin['admin_user_id']."' ", true);

		$data = array(
				'admin_first_name' => $basicContact['bc_first_name']
			,	'admin_middle_name' => $basicContact['bc_middle_name']
			,	'admin_last_name' => $basicContact['bc_last_name']
			,	'admin_name_ext' => $basicContact['bc_name_ext']
			,	'admin_gender' => $basicContact['bc_gender']
			,	'admin_email' => $basicContact['bc_email_address']
			,	'user_name' => $user['user_name']
		);

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('administrator/form');
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function login(){
		if(!empty($_POST)){
			$userMapper = new App\Mapper\UserMapper();
			$basicContactMapper = new App\Mapper\BasicContactMapper();
			$user_email = $_POST['user_email'];
			$user_password =  encrypt($_POST['user_password']);
			$user = $userMapper->selectByLoginPassword($user_email, $user_password);
			if($user){
				$bc_id = 0;
				if($user['user_type'] == 1){
					//Admin
					$adminMapper = new App\Mapper\AdminMapper();
					$admin = $adminMapper->getByUsername($user['user_name']);
				}

				$basicContact = $basicContactMapper->getByID($admin['admin_bc_id']);
				$displayname = $basicContact['bc_first_name'] . ' ' . $basicContact['bc_middle_name'] . ' ' . $basicContact['bc_last_name'] . ' ' . $basicContact['bc_name_ext'];
				$user_details = array(
						'displayname'=>	$displayname
					,	'email'		=>$user['user_email']
					,	'type'		=>$user['user_type']
				);
				$this->sess->setLogin($user_details);
				if(isset($_GET['redirect_url'])){
					$this->redirect($_GET['redirect_url']);
				}
				else{
					$this->redirect(DOMAIN.'dashboard');
				}
			}
			else{
				echo "Invalid User Credentials";
			}
		}
		if(!$this->sess->isLogin()){
			$this->_data['action_url'] = (isset($_GET['redirect_url']))? $_SERVER['REQUEST_URI'] : '?';
			$this->view('auth/login');
		}
		else{
			$this->redirect(DOMAIN.'user/dashboard');
		}

	}

	public function logout(){
		$this->sess->clearLogin();
		$this->redirect(DOMAIN.'login');
	}

}

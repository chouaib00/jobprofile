<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function search($z){
		$usermapper = new App\Mapper\UserMapper();
	}

	public function upload_image(){
		$current_user = $_SESSION['current_user']['id'];
		$userMapper = new App\Mapper\UserMapper();
		$fileManagerMapper = new App\Mapper\FileManagerMapper();
		$user = $userMapper->getByFilter("user_id = '". $current_user."' ", true);

		if(!empty($_FILES)){
			$this->load->model('FileManagement/Upload_Model');
			if($_FILES['applicant-img']["error"] == 0){
				$result = $this->Upload_Model->upload_profile_image($_FILES);

				if($user['user_fm_id']>0){
					//Update
					$fileManager = $fileManagerMapper->getByFilter("fm_id = '".$user['user_fm_id']."'", true);
					$file_path = 'upload/profile/'.$fileManager['fm_encypted_name'];
					if(file_exists($file_path)){
						$this->Upload_Model->delete_file($file_path);
					}
					$fileManagerMapper->update(array(
						'fm_encypted_name'	=> $result['image_name']
					), "fm_id = '".$user['user_fm_id']."'");
				}
				else{
					//Insert
					$user['user_fm_id'] = $fileManagerMapper->insert(array(
						'fm_encypted_name'	=> $result['image_name']
					));
				}
				$userMapper->update(array(
					'user_fm_id' =>$user['user_fm_id']
				), "user_id = '".$current_user."'");

				$this->set_alert(array(
					'message'=>'<i class="fa fa-check"></i> Successfully change display picture!'
				,	'type'=>'success'
				));
			}
			else{
				$this->set_alert(array(
					'message'=>'<i class="fa fa-exclamation"></i> Failed to upload!'
				,	'type'=>'danger'
				));
			}
		};
		$this->is_secure = true;
    $this->view('user/upload_image');
	}

	public function register_applicant(){

		$usermapper = new App\Mapper\UserMapper();
		$basiccontactmapper = new App\Mapper\BasicContactMapper();
		$applicantmapper = new App\Mapper\ApplicantMapper();
		$this->_secure = false;
		$this->_template = 'templates/public';
		if(!empty($_POST)){
			$insert_user = array();
			$insert_user['user_name'] = $_POST['reg-username'];
			$insert_user['user_email'] = $_POST['reg-email'];
			$insert_user['user_password'] = encrypt($_POST['reg-password']);
			$insert_user['user_type'] = '2';
			$insert_user['user_fm_id'] = '0';
			$user_id = $usermapper->insert($insert_user);

			$insert_bc = array();
			$insert_bc['bc_first_name'] = '';
			$insert_bc['bc_middle_name'] = '';
			$insert_bc['bc_last_name'] = '';
			$insert_bc['bc_name_ext'] = '';
			$insert_bc['bc_phone_num1'] = '';
			$insert_bc['bc_phone_num2'] = '';
			$insert_bc['bc_phone_num3'] = '';
			$insert_bc['bc_gender'] = '';
			$insert_bc['bc_email_address'] = $insert_user['user_email'];
			$bc_id = $basiccontactmapper->insert($insert_bc);

			$insert_applicant['applicant_user_id'] = $user_id;
			$insert_applicant['applicant_bc_id'] = $bc_id;
			$insert_applicant['applicant_birthday'] = NULL;
			$insert_applicant['applicant_nationality'] = '';
			$insert_applicant['applicant_citizenship'] = '';
			$insert_applicant['applicant_civil_status'] = '';
			$insert_applicant['applicant_summary'] = '';
			$insert_applicant['applicant_ea_id'] = NULL;
			$insert_applicant['applicant_present_id'] = NULL;
			$insert_applicant['applicant_permanent_add_id'] = NULL;

			$applicant_id = $applicantmapper->insert($insert_applicant);

			$applicant = $applicantmapper->getByID($user_id);
			$basicContact = $basiccontactmapper->getByID($applicant['applicant_bc_id']);
			$displayname = $basicContact['bc_first_name'] . ' ' . $basicContact['bc_middle_name'] . ' ' . $basicContact['bc_last_name'] . ' ' . $basicContact['bc_name_ext'];
			$user = $usermapper->selectByID($user_id);
			$user_details = array(
					'displayname'=>	$displayname
				,	'id'=>	$user['user_id']
				,	'email'		=>$user['user_email']
				,	'type'		=>$user['user_type']
			);
			$this->sess->setLogin($user_details);
			$this->redirect(DOMAIN.'applicant/update_profile');

		}
		$this->view('user/registration');

	}



}

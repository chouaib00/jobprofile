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
			$checkExisting = $usermapper->getByFilter("user_name = '".$_POST['reg-username']."' OR user_email = '".$_POST['reg-email']."' ");

			if(empty($checkExisting)){
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
				$insert_applicant['applicant_is_verified'] = 0;
				$insert_applicant['applicant_verification_code'] = '';

				$applicant_id = $applicantmapper->insert($insert_applicant);
				$this->send_verification($applicant_id);
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
			else{
				$this->set_alert(array(
					'message'=>'<i class="fa fa-times"></i> Username/Email Address already Taken!'
				,	'type'=>'danger'
				));
			}


		}
		$this->view('user/registration');

	}

	private function send_verification($applicant_id){
		$applicantMapper = new App\Mapper\ApplicantMapper();
		$userMapper = new App\Mapper\UserMapper();
		$applicant = $applicantMapper->getByFilter("applicant_id = '".$applicant_id."'", true);
		$user = $userMapper->getByFilter("user_id = '".$applicant['applicant_user_id']."'", true);
		$code = md5($applicant['applicant_id']);
		$applicantMapper->update(array(
			'applicant_verification_code'=>$code
		), "applicant_id = '".$applicant_id."'");
		$link = DOMAIN.'auth/verify-email?code='.$code;

		$this->load->library('email', $this->config->item('email'));

		$message = '<p><span style="font-size: 18px;">Click the link to verify your account</span></p>
								<p><span style="font-size: 18px;"><a href="http://www.pesojobprofiling.com'.$link.'">http://www.pesojobprofiling.com'.$link.'</a></span></p>
								<p style="text-align: center;"><a href="http://www.pesojobprofiling.com" rel="noopener noreferrer" target="_blank">www.pesojobprofiling.com</a></p><address style="text-align: center;">&nbsp;P. Dandan st. CCYA bldg.<br>Batangas City, Batangas&nbsp;</address><address style="text-align: center;">&nbsp;723-8802<br>&nbsp;<a href="mailto:#">pesobatangascity@yahoo.com.ph</a>&nbsp;</address>
								<p style="text-align: center;">Copyright &copy; Public Employment Service Office - Batangas City 2018</p>';

		$this->email->from('no-reply@pesojobprofiling.com', "Account Verificator");
		$this->email->to($user['user_email']);
		$this->email->bcc($this->config->item('email')['smtp_user']);
		$this->email->subject("Account Verification");
		$this->email->message($message);
		$this->email->send();

	}



}

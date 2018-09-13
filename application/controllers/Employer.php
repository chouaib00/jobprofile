<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employer extends Controller {

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

	public function fa_ref(){
		$limit = $_POST['length'];
		$offset = $_POST['start'];
		$search = $_POST['search'];
		$columns = $_POST['columns'];

		$applicantMapper = new App\Mapper\ApplicantMapper();
		$applicant = $applicantMapper->getByFilter("applicant_user_id = '". $_SESSION['current_user']['id']."' ", true);
		$condition = array(
			array(
				'column'=>'aattachment_applicant_id'
			,	'value'	=>$applicant['applicant_id']
			)
		);

		$orders = array();

		foreach($_POST['order'] as $_order){
			array_push($orders, array(
				'col'=> $_POST['columns'][$_order['column']]['data']
			,	'type'	=> $_order['dir']
			));
		}
		$mapper = new App\Mapper\ApplicantAttachmentMapper();
		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders, $condition);
		echo json_encode($result);
	}

	public function file_attachment(){
		$this->is_secure = true;
    $this->view('applicant/file_attachment');
	}

	public function add_file(){
		$this->load->model('FileManagement/Upload_Model');
		$fileManagerMapper = new App\Mapper\FileManagerMapper();
		$applicantAttachmentMapper = new App\Mapper\ApplicantAttachmentMapper();
		$applicantMapper = new App\Mapper\ApplicantMapper();
		if(!empty($_POST)){
			if($_FILES['file']["error"] == 0){
				$result = $this->Upload_Model->upload_file($_FILES);

				$applicant = $applicantMapper->getByFilter("applicant_user_id = '". $_SESSION['current_user']['id']."' ", true);

				$fm_id = $fileManagerMapper->insert(array(
					'fm_encypted_name'	=> $result['new_file_name']
				));

				$fa_id = $applicantAttachmentMapper->insert(array(
					'aattachment_fm_id'=>$fm_id
				,	'aattachment_applicant_id'=>$applicant['applicant_id']
				,	'aattachment_visible'=> isset($_POST['file-visible'])? 1: 0
				,	'aattachment_name'=>$_POST['file-tag']
				));
				$this->set_alert(array(
					'message'=>'<i class="fa fa-check"></i> Successfully uploaded a file!'
				,	'type'=>'success'
				,	'href'=>DOMAIN.'applicant/file-attachment'
				,	'text'=>'File Attachment List'
				));
			}
			else{
				$this->set_alert(array(
					'message'=>'<i class="fa fa-exclamation"></i> Failed to upload!'
				,	'type'=>'danger'
				));
			}
		}
		$this->is_secure = true;
		$this->view('applicant/file_form');
	}

	public function delete_file(){
		$option = $_POST;
		$this->load->model('FileManagement/Upload_Model');
		$applicantAttachmentMapper = new App\Mapper\ApplicantAttachmentMapper();
		$fileManagerMapper = new App\Mapper\FileManagerMapper();

		$applicantAttachment = $applicantAttachmentMapper->getByFilter("aattachment_id = '". $option['id']."' ", true);
		$fileManager = $fileManagerMapper->getByFilter("fm_id = '". $applicantAttachment['aattachment_fm_id']."' ", true);

		$file_path = 'upload/files/'.$fileManager['fm_encypted_name'];
		if(file_exists($file_path)){
			$this->Upload_Model->delete_file($file_path);
		}
		//echo
		$applicantAttachmentMapper->delete(array(
			array(
							'column'=>'aattachment_id'
						,	'value'=> $option['id'])
		));
		$result = $fileManagerMapper->delete(array(
			array(
							'column'=>'fm_id'
						,	'value'=> $fileManager['fm_id'])
		));
		echo json_encode($result);
	}

	public function save_file(){
		$option = $_POST;
		$this->load->model('FileManagement/Copy_Model');
		$applicantAttachmentMapper = new App\Mapper\ApplicantAttachmentMapper();
		$fileManagerMapper = new App\Mapper\FileManagerMapper();

		$applicantAttachment = $applicantAttachmentMapper->getByFilter("aattachment_id = '". $option['id']."' ", true);
		$fileManager = $fileManagerMapper->getByFilter("fm_id = '". $applicantAttachment['aattachment_fm_id']."' ", true);

		$file = $this->Copy_Model->copyFile(array(
			'file_name' => $applicantAttachment['aattachment_name']
		,	'encrypted_name'=>$fileManager['fm_encypted_name']
		));
		echo json_encode($file);
	}

	public function list(){
		$this->_template = 'templates/admin_main';
    $this->view('applicant/list');
	}

	public function save_profile(){
		$userMapper = new App\Mapper\UserMapper();
		$educationMapper = new App\Mapper\EducationMapper();
		$applicantMapper = new App\Mapper\ApplicantMapper();
		$addressMapper = new App\Mapper\AddressMapper();
		$user = $userMapper->getByFilter(array(
			array(
				'column'=>'user_name'
			,	'value'	=>$_POST['applicant-username']
			)
		), true);
		$applicant = $applicantMapper->getByFilter("applicant_user_id = '". $user['user_id']."' ", true);
		if(!$user);//Show 404;

		if($applicant['applicant_present_id']){
			//DO update if already exist
			$addressMapper->update(array(
					"address_city_id"		=>$_POST['present-add-city']
				,	"address_province_id"=>$_POST['present-add-province']
				,	"address_desc"	=>$_POST['present-add-desc']
			), "address_id = '".$applicant['applicant_present_id']."'");
		}
		else{
			$applicant['applicant_present_id'] = $addressMapper->insert(array(
				"address_city_id"		=> $_POST['present-add-city']
			,	"address_province_id"=>$_POST['present-add-province']
			,	"address_desc"	=>$_POST['present-add-desc']
			));
		}

		if($applicant['applicant_permanent_add_id']){
			//DO update if already exist
			$addressMapper->update(array(
					"address_city_id"		=>$_POST['permanent-add-city']
				,	"address_province_id"=>$_POST['permanent-add-province']
				,	"address_desc"	=>$_POST['permanent-add-desc']
			), "address_id = '".$applicant['applicant_present_id']."'");
		}
		else{

			$applicant['applicant_permanent_add_id'] = $addressMapper->insert(array(
				"address_city_id"		=> $_POST['permanent-add-city']
			,	"address_province_id"=>$_POST['permanent-add-province']
			,	"address_desc"	=>$_POST['permanent-add-desc']
			));
		}

		$basicContactMapper = new App\Mapper\BasicContactMapper();
		$basicContactMapper->update(array(
				'bc_first_name' => $_POST['applicant-first-name']
			,	'bc_middle_name' => $_POST['applicant-middle-name']
			,	'bc_last_name' => $_POST['applicant-last-name']
			,	'bc_name_ext' => $_POST['applicant-name-ext']
			,	'bc_phone_num1' => $_POST['phone-number-1']
			,	'bc_phone_num2' => $_POST['phone-number-2']
			,	'bc_phone_num3' => $_POST['phone-number-3']
			,	'bc_gender' => $_POST['applicant-gender']
		), "bc_id = '".$applicant['applicant_bc_id']."'");

		$applicantMapper->update(array(
				'applicant_nationality'=> $_POST['applicant-nationality']
			,	'applicant_citizenship'=> $_POST['applicant-citizenship']
			,	'applicant_civil_status'=> $_POST['applicant-civil-status']
			,	'applicant_birthday'=> ($_POST['applicant-birthday'])? date("Y-m-d", strtotime($_POST['applicant-birthday'])) : NULL
			,	'applicant_present_id'=> $applicant['applicant_present_id']
			,	'applicant_permanent_add_id'=> $applicant['applicant_permanent_add_id']
		), " applicant_id = '".$applicant['applicant_id']."'");

		$educ_table = json_decode($_POST['educ-table'], true);

		foreach($educ_table as $educ){
			$educ_row = array(
						'educ_applicant_id' => $applicant['applicant_id']
				,		'educ_school_id' => $educ['school']
				,		'educ_fos_id' => $educ['field_of_study']
				,		'educ_start_from' => $educ['start_date']
				,		'educ_start_to' => $educ['end_date']
				,		'educ_type' => $educ['educ_type']
				,		'educ_degree' => $educ['course']
				,		'educ_additional' => $educ['add_info']
			);

			if($educ['action'] == 'add'){
				$educationMapper->insert($educ_row);
			}

		}
		echo json_encode(array('success'=>1));
	}

  public function update_profile($username = ""){
		//View only here no saving!
		$userMapper = new App\Mapper\UserMapper();
		$applicantMapper = new App\Mapper\ApplicantMapper();
		$basicContactMapper = new App\Mapper\BasicContactMapper();
		$educAttainmentMapper = new App\Mapper\EducAttainmentMapper();
		$addressMapper = new App\Mapper\AddressMapper();
		$educationMapper = new App\Mapper\EducationMapper();
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
		$educAttainment = $educAttainmentMapper->getByFilter("ea_id = '".$applicant['applicant_ea_id']."'", true);
		$presentAddress = $addressMapper->getCompleteAddressByID($applicant['applicant_present_id']);
		$permanentAddress = $addressMapper->getCompleteAddressByID($applicant['applicant_permanent_add_id']);
		$education = $educationMapper->getEducationTable($applicant['applicant_id']);

		$form_data = array(
				'applicant_username'	=> $user['user_name']
			,	'applicant_first_name' => $basicContact['bc_first_name']
			,	'applicant_middle_name' => $basicContact['bc_middle_name']
			,	'applicant_last_name' => $basicContact['bc_last_name']
			,	'applicant_name_ext' => $basicContact['bc_name_ext']
			,	'present_add_desc' => $presentAddress['address_desc']
			,	'present_add_country' => array(
					'country_id'	=> $presentAddress['country_id']
				,	'country_name'=> $presentAddress['country_name']
				)
			,	'present_add_region' => array(
					'region_id'	=> $presentAddress['region_id']
				,	'region_code'=> $presentAddress['region_code']
				,	'region_desc'=> $presentAddress['region_desc']
				)
			,	'present_add_province' => array(
					'province_id'	=> $presentAddress['province_id']
				,	'province_name'=> $presentAddress['province_name']
				)
			,	'present_add_city' => array(
					'city_id'	=> $presentAddress['city_id']
				,	'city_name'=> $presentAddress['city_name']
				)
			,	'permanent_add_desc' => $permanentAddress['address_desc']
			,	'permanent_add_country' => array(
				'country_id'	=> $permanentAddress['country_id']
			,	'country_name'=> $permanentAddress['country_name']
			)
			,	'permanent_add_region' => array(
					'region_id'	=> $permanentAddress['region_id']
				,	'region_code'=> $permanentAddress['region_code']
				,	'region_desc'=> $permanentAddress['region_desc']
				)
			,	'permanent_add_province' => array(
					'province_id'	=> $permanentAddress['province_id']
				,	'province_name'=> $permanentAddress['province_name']
				)
			,	'permanent_add_city' => array(
					'city_id'	=> $permanentAddress['city_id']
				,	'city_name'=> $permanentAddress['city_name']
				)
			,	'applicant_gender' => $basicContact['bc_gender']
			,	'applicant_birthday' => date("m/d/Y", strtotime($applicant['applicant_birthday']))
			,	'applicant_civil_status' => $applicant['applicant_civil_status']
			,	'applicant_nationality' => $applicant['applicant_nationality']
			,	'applicant_citizenship' => $applicant['applicant_citizenship']
			,	'applicant_educ_attainment' => array(
					'ea_id'	=> $educAttainment['ea_id']
				,	'ea_name'=> $educAttainment['ea_name']
				)
			,	'phone_number_1' => $basicContact['bc_phone_num1']
			,	'phone_number_2' => $basicContact['bc_phone_num2']
			,	'phone_number_3' => $basicContact['bc_phone_num3']
			,	'education_table'=> $education
		);
		$this->_data['form_data'] = $form_data;

		$this->is_secure = true;
    $this->_template = 'templates/applicant_main';
    $this->view('applicant/update_profile');
  }

	public function my_skills(){
		$userMapper = new App\Mapper\UserMapper();
		$applicantMapper = new App\Mapper\ApplicantMapper();
		$skillTagMapper = new App\Mapper\SkillTagMapper();
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
		if(!$user){ };//Show 404;
		$this->_data['skill_list'] = $skillTagMapper->getAll();
		$this->_template = 'templates/applicant_main';
    $this->view('applicant/my_skills');
	}


}

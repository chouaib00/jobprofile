<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vacancy extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function vacancy_list(){
		$this->is_secure = true;
    $this->view('vacancy/vacancy_list');
	}

	public function vacancy_ref(){
		$limit = $_POST['length'];
		$offset = $_POST['start'];
		$search = $_POST['search'];
		$columns = $_POST['columns'];
		$orders = array();

		foreach($_POST['order'] as $_order){
			array_push($orders, array(
				'col'=> $_POST['columns'][$_order['column']]['data']
			,	'type'	=> $_order['dir']
			));
		}
		$mapper = new App\Mapper\JobPostingMapper();
		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders);
		echo json_encode($result);
	}

	public function delete_vacancy(){
		$param = $_POST;
		$jp_id = $param['id'];

		$jobPostingMapper = new App\Mapper\JobPostingMapper();
		$jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();

		$jobPostingMapper->delete("jp_id = '".$jp_id."'");
		$jobPostingQualificationMapper->delete("jpq_jp_id = '".$jp_id."'");

		echo json_encode(array(
			"success"=>1
		));
	}

	public function post_vacancy(){
		$input = $_POST;
		$jobPostingMapper = new App\Mapper\JobPostingMapper();
		$jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();

		if(!empty($input)){
			$jp_id = $jobPostingMapper->insert(array(
				'jp_title'	=>	$input['vacancy-title']
			,	'jp_employer_id'	=>	$input['employer']
			,	'jp_date_posted'	=>	date('Y-m-d H:i:s')
			,	'jp_description'	=>	$input['vacancy-description']
			,	'jp_open'	=>true
			));

			$qualification = $this->format_qualification($input);
			foreach($qualification as $entry){
				$jobPostingQualificationMapper->insert(array(
					'jpq_jp_id'	=>	$jp_id
				,	'jpq_key'	=>	$entry['key']
				,	'jpq_value'	=>	$entry['value']
				,	'jpq_is_strict'	=>	true
				));
			}
			$this->set_alert(array(
				'message'=>'<i class="fa fa-thumb-tack"></i> Successfully posted a job vacancy!'
			,	'type'=>'success'
			,	'href'=>DOMAIN.'vacancy/vacancy-list'
			,	'text'=>'All Job Vacancy List'
			));
		}
		$form_data = array(
			'jp_title'	=>	''
		,	'jp_description'	=> ''
		,	'jp_open'	=>	'1'
		,	'employer'	=> array(
				'employer_id'	=>	''
			,	'employer_name'	=> ''
			)
		,	'gender_qualification'=>array()
		,	'educ_qualification'=>array()
		,	'agefrom_qualification'=>array()
		,	'ageto_qualification'=>array()
		,	'skill_qualification'=>array()
		,	'city_qualification'=>array()
		,	'province_qualification'=>array()
		,	'region_qualification'=>array()
		);
		$this->_data['form_data']	= $form_data;
		$this->is_secure = true;
		$this->view('vacancy/post_vacancy');
	}

	public function edit_vacancy($jp_id){
		$input = $_POST;
		$employerMapper = new App\Mapper\EmployerMapper();
		$jobPostingMapper = new App\Mapper\JobPostingMapper();
		$jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();

		$jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);


		if(!empty($input)){
			$jobPostingMapper->update(array(
				'jp_title'	=>	$input['vacancy-title']
			,	'jp_employer_id'	=>	$input['employer']
			,	'jp_description'	=>	$input['vacancy-description']
			,	'jp_open'	=>isset($input['is-open'])? 1 : 0
		), "jp_id = '".$jp_id."'");
			$jobPostingQualificationMapper->delete("jpq_jp_id = '".$jp_id."'");
			$qualification = $this->format_qualification($input);
			foreach($qualification as $entry){
				$jobPostingQualificationMapper->insert(array(
					'jpq_jp_id'	=>	$jp_id
				,	'jpq_key'	=>	$entry['key']
				,	'jpq_value'	=>	$entry['value']
				,	'jpq_is_strict'	=>	true
				));
			}
			$this->set_alert(array(
				'message'=>'<i class="fa fa-thumb-tack"></i> Successfully updated a job vacancy!'
			,	'type'=>'success'
			,	'href'=>DOMAIN.'vacancy/vacancy-list'
			,	'text'=>'All Job Vacancy List'
			));
		}
		$jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);
		$employer = $employerMapper->getByFilter("employer_id = '".$jobPosting['jp_employer_id']."'", true);
		$ageFromQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_FROM')[0];
		$ageToQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_TO')[0];
		$genderQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'GENDER');
		$educAttainment = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'EDUC_ATTAINMENT');
		$skillsQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'SKILLS');
		$cityQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'CITY');
		$provinceQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'PROVINCE');
		$regionQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'REGION');

		$form_data = array(
			'jp_title'	=>	$jobPosting['jp_title']
		,	'jp_description'	=> $jobPosting['jp_description']
		,	'jp_open'	=>	($jobPosting['jp_open'])? '1':'0'
		,	'employer'	=> array(
				'employer_id'	=>	$employer['employer_id']
			,	'employer_name'	=> $employer['employer_name']
			)
		,	'gender_qualification'=>$genderQualification
		,	'educ_qualification'=>$educAttainment
		,	'agefrom_qualification'=>$ageFromQualification
		,	'ageto_qualification'=>$ageToQualification
		,	'skill_qualification'=>$skillsQualification
		,	'city_qualification'=>$cityQualification
		,	'province_qualification'=>$provinceQualification
		,	'region_qualification'=>$regionQualification
		);

		$this->_data['form_data']	= $form_data;
		$this->is_secure = true;
		$this->view('vacancy/post_vacancy');
	}

	public function view_vacancy($jp_id){
		$input = $_POST;
		$employerMapper = new App\Mapper\EmployerMapper();
		$jobPostingMapper = new App\Mapper\JobPostingMapper();
		$jobPostingQualificationMapper = new App\Mapper\JobPostingQualificationMapper();
		$jobPosting = $jobPostingMapper->getByFilter("jp_id = '".$jp_id."'", true);

		$employer = $employerMapper->getByFilter("employer_id = '".$jobPosting['jp_employer_id']."'", true);
		$ageFromQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_FROM')[0];
		$ageToQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'AGE_TO')[0];
		$genderQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'GENDER');
		$educAttainment = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'EDUC_ATTAINMENT');
		$skillsQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'SKILLS');
		$cityQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'CITY');
		$provinceQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'PROVINCE');
		$regionQualification = $jobPostingQualificationMapper->getQualificationOfJob($jp_id, 'REGION');

		$form_data = array(
			'jp_title'	=>	$jobPosting['jp_title']
		,	'jp_description'	=> $jobPosting['jp_description']
		,	'jp_open'	=>	($jobPosting['jp_open'])? '1':'0'
		,	'employer'	=> array(
				'employer_id'	=>	$employer['employer_id']
			,	'employer_name'	=> $employer['employer_name']
			)
		,	'gender_qualification'=>$genderQualification
		,	'educ_qualification'=>$educAttainment
		,	'agefrom_qualification'=>$ageFromQualification
		,	'ageto_qualification'=>$ageToQualification
		,	'skill_qualification'=>$skillsQualification
		,	'city_qualification'=>$cityQualification
		,	'province_qualification'=>$provinceQualification
		,	'region_qualification'=>$regionQualification
		);

		$this->_data['form_data']	= $form_data;
		$this->is_secure = true;
		$this->view('vacancy/view_vacancy');
	}

	private function format_qualification($input){
		$row_format = array(
			'key'	=>	''
		,	'value'	=>	''
		);
		$output = array();

		if(!empty($input['applicant-gender'])){
			$gender = $row_format;
			$gender['key']	=	'GENDER';
			$gender['value']	=	$input['applicant-gender'];
			array_push($output, $gender);
		}

		if(!empty($input['applicant-educ-attainment'])){
			foreach($input['applicant-educ-attainment'] as $educ_attainment){
				$gender = $row_format;
				$gender['key']	=	'EDUC_ATTAINMENT';
				$gender['value']	=	$educ_attainment;
				array_push($output, $gender);
			}
		}

		if(!empty($input['age-range'])){
			$age_range = json_decode($input['age-range'], true);
			$age_from = $row_format;
			$age_from['key']	=	'AGE_FROM';
			$age_from['value']	=	explode(";",$age_range[0]['value'])[0];
			array_push($output, $age_from);
			$age_to = $row_format;
			$age_to['key']	=	'AGE_TO';
			$age_to['value']	=	explode(";",$age_range[0]['value'])[1];
			array_push($output, $age_to);
		}

		if(!empty($input['applicant-skills'])){
			foreach($input['applicant-skills'] as $applicant_skills){
				$skills = $row_format;
				$skills['key']	=	'SKILLS';
				$skills['value']	=	$applicant_skills;
				array_push($output, $skills);
			}
		}

		if(!empty($input['add-region'])){
			$region = $row_format;
			$region['key']	=	'REGION';
			$region['value']	=	$input['add-region'];
			array_push($output, $region);
		}

		if(!empty($input['add-province'])){
			$province = $row_format;
			$province['key']	=	'PROVINCE';
			$province['value']	=	$input['add-province'];
			array_push($output, $province);
		}

		if(!empty($input['add-city'])){
			$city = $row_format;
			$city['key']	=	'CITY';
			$city['value']	=	$input['add-city'];
			array_push($output, $city);
		}

		return $output;
	}


}

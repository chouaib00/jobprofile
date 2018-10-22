<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Controller {

	public function __construct(){
		parent::__construct();
	}

  public function dashboard(){
			$this->is_secure = true;
			if($this->sess->isLogin()){
				if($_SESSION['current_user']['type'] == '1'){
					$this->admin_dashboard();
				}
				if($_SESSION['current_user']['type'] == '2'){
					$this->applicant_dashboard();
				}
				if($_SESSION['current_user']['type'] == '3'){
					$this->employer_dashboard();
				}
			}
			else{
				$this->redirect(DOMAIN.'logout');
			}
  }

	public function dashboard_catch(){
		$input = $_POST;
		$result = array();

		$user_id = $input['user'];
		$userMapper = new App\Mapper\UserMapper();
		$employerMapper = new App\Mapper\EmployerMapper();
		$applicantMapper = new App\Mapper\ApplicantMapper();
		$adminMapper = new App\Mapper\AdminMapper();
		$jobPostingMapper = new App\Mapper\JobPostingMapper();
		$applicantApplicationMapper = new App\Mapper\ApplicantApplicationMapper();

		$this->load->model('JobSearch/JobSearch_Model');

		$user = $userMapper->getByFilter("user_id = '".$user_id."'", true);
		if($user['user_type'] == 1){
			$admin = $adminMapper->getByFilter("admin_user_id = '".$user['user_id']."'");
			$registered_applicant_count = $userMapper->getByFilter("user_type = '2'");
			$result['registered_applicant_count'] = count($registered_applicant_count);
			$registered_employer_count = $userMapper->getByFilter("user_type = '3'");
			$result['registered_employer_count'] = count($registered_employer_count);
			$job_posted_count = $jobPostingMapper->getAllCount();
			$result['job_posted_count'] = $job_posted_count;


		}
		else if($user['user_type'] == 2){
			$applicant = $applicantMapper->getByFilter("applicant_user_id = '".$user['user_id']."'", true);
			$searchResult = $this->JobSearch_Model->getJobList($applicant['applicant_id']);

			$applicantApplication = $applicantApplicationMapper->getByFilter("aa_applicant_id = '".$applicant['applicant_id']."'");
			$result['job_qualify_count'] = count($searchResult);
			$result['application_count'] = count($applicantApplication);
		}
		else if($user['user_type'] == 3){
			$employer = $employerMapper->getByFilter("employer_user_id = '".$user['user_id']."'", true);
			$jobPosting = $jobPostingMapper->getByFilter("jp_employer_id = '".$employer['employer_id']."'");
			$result['job_posted_count'] = count($jobPosting);
		}
		// $user_id = $_POST

		// $PCRequestMapper = new App\Mapper\PCRequestMapper();
		// $date = $input['today'];
		//
		// $currentProcessedPCRequest = $PCRequestMapper->getTotalPendingByDate($date);
		// $result['sched_police_clearance'] = $currentProcessedPCRequest;
		echo json_encode($result);
	}

	private function admin_dashboard(){
		$this->_data['user_id'] = $_SESSION['current_user']['id'];
		$this->view('home/admin_dashboard');
	}
	private function applicant_dashboard(){
		$this->_data['user_id'] = $_SESSION['current_user']['id'];
		$this->view('home/applicant_dashboard');
	}
	private function employer_dashboard(){
		$this->_data['user_id'] = $_SESSION['current_user']['id'];
		$this->view('home/employer_dashboard');
	}

	public function about(){
		$pageMapper = new App\Mapper\PageMapper();
		$page = $pageMapper->getByFilter("page_id = '1'", true);
		$this->_data['data'] = $page;
		$this->_template = 'templates/public';
		$this->view('home/about');
	}

	public function error_404(){
		$this->_template = 'templates/main';
		$this->view('home/error_404');
	}

	public function landing_page(){
		$this->is_secure = false;
		$announcementMapper = new App\Mapper\AnnouncementMapper();
		$this->_data['announcement_list'] = $announcementMapper->get(array(), array(), array(array(
			'column'=>'announcement_date'
		,	'order'=>'DESC'
		)));

		$jobPostingMapper = new App\Mapper\JobPostingMapper();
		$this->_data['job_post'] = $jobPostingMapper->getJobVacancy();
		$this->_template = 'templates/plain';
		$this->view('home/landing_page');
	}
}

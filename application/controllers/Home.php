<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Controller {

	public function __construct(){
		parent::__construct();
	}

  public function dashboard(){
			$this->is_secure = true;
			if($_SESSION['current_user']['type'] == '1'){
				//Means Admin
				$this->_template = 'templates/admin_main';
			}
			if($_SESSION['current_user']['type'] == '2'){
				//Means Applicant
				$this->_template = 'templates/applicant_main';
			}
      $this->view('home/dashboard');
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
		$this->_template = 'templates/public';
		$this->view('home/landing_page');
	}
}

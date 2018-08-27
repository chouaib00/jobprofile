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

	public function landing_page(){
		$this->view('home/landing_page');
	}
}

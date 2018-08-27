<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Controller {

	public function __construct(){
		parent::__construct();
	}

  public function dashboard(){
			$this->is_secure = true;
			$this->_template = 'templates/admin_main';
      $this->view('home/dashboard');
  }

	public function landing_page(){
		$this->view('home/landing_page');
	}
}

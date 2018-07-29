<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Controller {

	public function __construct(){
		parent::__construct();
	}


  public function dashboard(){
			$this->_template = 'templates/main';
      $this->view('home/dashboard');
  }

}

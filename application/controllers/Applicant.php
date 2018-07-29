<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Applicant extends Controller {

	public function __construct(){
		parent::__construct();
	}

  public function update_profile(){
    $this->_template = 'templates/main';
    $this->view('applicant/update_profile');
  }

}

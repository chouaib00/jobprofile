<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reference extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function ref(){
		$countrymapper = new App\Mapper\CountryMapper();
		echo json_encode($countrymapper->selectDataTable());
	}

  public function country(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/country');
  }
}

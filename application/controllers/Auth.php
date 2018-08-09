<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function login(){
		if(!empty($_POST)){
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
		}



		$this->view('auth/login');

	}

}

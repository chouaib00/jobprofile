<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function login(){
		$this->view('auth/login');

	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function search($z){
		$usermapper = new App\Mapper\UserMapper();

		echo "<pre>";
		print_r($usermapper->getAll());
		echo "</pre>";
	}

}

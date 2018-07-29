<?php
namespace Sys\Sess;
class SessionLoad{
	public function __construct(){
		if (session_status() == PHP_SESSION_NONE) session_start();
	}
	public function isLogin(){
		if(isset($_SESSION['current_user'])){
			return true;
		}
		else{
			return false;
		}
	}
	public function setLogin($email/*, $displayname*/){
		$_SESSION['current_user']['login-email'] = $email;
		//$_SESSION['current_user']['login-name'] = $displayname;
	}	
	public function clearLogin(){
		unset($_SESSION['current_user']);
	}
}
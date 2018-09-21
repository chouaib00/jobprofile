<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller {

	protected $_data = array();
	protected $sess = null;
	protected $is_secure = false;
	protected $_header = array(
		'title' => SITE_NAME
	);
	protected $_template = 'templates/plain';
	public function __construct(){
		parent::__construct();
		$this->sess = new Sys\Sess\SessionLoad();
	}
	protected function set_alert($config){
		$_SESSION['alert_message'] = array(
			'message'	=> $config['message']
		,	'type'		=> $config['type']);
		if(isset($config['href'])){
			$_SESSION['alert_message']['link'] = array(
					'href'=>$config['href']
				,	'text'=>$config['text']
				);
		}

	}


	protected function view($file){
		if($this->is_secure){
			if($this->sess->isLogin()){
				$this->_data['_login_details'] = $this->get_current_user();
				$content = array(
					'content'=> $this->load->view($file, $this->_data, true)
				);
				switch($_SESSION['current_user']['type']){
					case 1:
						$this->_template = 'templates/admin_main';
					break;
					case 2:
						$this->_template = 'templates/applicant_main';
					break;
					case 3:
						$this->_template = 'templates/employer_main';
					break;
					default:
				}


				$this->load->view('components/header', $this->_header);
				$this->load->view($this->_template, $content);
				$this->load->view('components/footer');
			}
			else{
				$this->redirect(DOMAIN.'login'."?redirect_url=".str_replace('/index.php', '', $_SERVER['REQUEST_URI']));
			}
		}
		else{
			$content = array(
				'content'=> $this->load->view($file, $this->_data, true)
			);
			$this->load->view('components/header', $this->_header);
			$this->load->view($this->_template, $content);
			$this->load->view('components/footer');
		}
	}

	public function redirect($url, $permanent = false){

		header('Location: ' . $url, true, $permanent ? 301 : 302);
		exit();
	}

	public function get_current_user(){
		$userMapper = new App\Mapper\UserMapper();
		$fileManagerMapper = new App\Mapper\FileManagerMapper();
		$user = $userMapper->getByFilter("user_id = '". $_SESSION['current_user']['id']."' ", true);
		$fileManager =$fileManagerMapper->getByFilter("fm_id = '". $user['user_fm_id']."' ", true);

		return array(
			'profile_img' => empty($fileManager)? 'emp_img_default.png' : $fileManager['fm_encypted_name']
		);
	}


	public function __destruct(){
	}

}

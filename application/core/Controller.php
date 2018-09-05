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

	protected function view($file){
		if($this->is_secure){
			if($this->sess->isLogin()){
				$content = array(
					'content'=> $this->load->view($file, $this->_data, true)
				);
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


	public function __destruct(){
	}

}

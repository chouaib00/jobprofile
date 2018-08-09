<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller {

	protected $_data = array();
	protected $sess = null;
	protected $_header = array(
		'title' => SITE_NAME
	);
	protected $_template = 'templates/plain';
	public function __construct(){
		parent::__construct();
		$this->sess = new Sys\Sess\SessionLoad();
	}

	protected function view($file){
		$content = array(
			'content'=> $this->load->view($file, $this->_data, true)
		);
		$this->load->view('components/header', $this->_header);
		$this->load->view($this->_template, $content);
		$this->load->view('components/javascript');
		$this->load->view('components/footer');
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reference extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function ref(){
		$limit = $_POST['length'];
		$offset = $_POST['start'];
		$search = $_POST['search'];
		$columns = $_POST['columns'];
		$option = $_POST['option'];
		$orders = array();

		foreach($_POST['order'] as $_order){
			array_push($orders, array(
				'col'=> $_POST['columns'][$_order['column']]['data']
			,	'type'	=> $_order['dir']
			));
		}
		$mapper = '';
		if($option['type'] == 'country'){
			$mapper = new App\Mapper\CountryMapper();
		}
		if($option['type'] == 'region'){
			$mapper = new App\Mapper\RegionMapper();
		}
		if($option['type'] == 'province'){
			$mapper = new App\Mapper\ProvinceMapper();
		}

		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders);

		echo json_encode($result);
	}

  public function country(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/country');
  }

	public function add_country(){
		$this->_template = 'templates/admin_main';
    $this->view('reference/country');
	}

	public function region(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/region');
  }

	public function province(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/province');
  }

}

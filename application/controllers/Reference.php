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
		if($option['type'] == 'city'){
			$mapper = new App\Mapper\CityMapper();
		}

		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders);

		echo json_encode($result);
	}

  public function country(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/country/list');
  }

	public function add_country(){
		$countryMapper = new App\Mapper\CountryMapper();
		$data = array(
				'country_id' => ''
			,	'country_code' => ''
			,	'country_name' => ''
		);

		if(!empty($_POST)){
				$data['country_code'] = $_POST['country_code'];
				$data['country_name'] = $_POST['country_name'];
				$countryMapper->insert($data);
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->_template = 'templates/admin_main';
    $this->view('reference/country/form');
	}

	public function edit_country($id){
		$countryMapper = new App\Mapper\CountryMapper();
		$filter = array();
		$filter[] = array('column'=>'country_id',
											'value' => $id);

		if(!empty($_POST)){
				$data['country_code'] = $_POST['country_code'];
				$data['country_name'] = $_POST['country_name'];
				$countryMapper->update($data, $filter);
		}
		$country = $countryMapper->getByFilter($filter, true);
		if(empty($country));//Show 404

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $country;

		$this->_template = 'templates/admin_main';
    $this->view('reference/country/form');
	}

	public function region(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/region');
  }

	public function province(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/province');
  }

	public function city(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/city');
  }

}

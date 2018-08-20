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
		if($option['type'] == 'field-of-study'){
			$mapper = new App\Mapper\FieldOfStudyMapper();
		}

		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders);

		echo json_encode($result);
	}

	public function delete_ref(){
		$option = $_POST;
		$params = array();
		$mapper = '';
		if($option['type'] == 'country'){
			$mapper = new App\Mapper\CountryMapper();
			$params[] = array(
							'column'=>'country_id'
						,	'value'=> $option['id']);
		}
		if($option['type'] == 'region'){
			$mapper = new App\Mapper\RegionMapper();
			$params[] = array(
							'column'=>'region_id'
						,	'value'=> $option['id']);
		}
		if($option['type'] == 'province'){
			$mapper = new App\Mapper\ProvinceMapper();
			$params[] = array(
							'column'=>'province_id'
						,	'value'=> $option['id']);
		}
		if($option['type'] == 'city'){
			$mapper = new App\Mapper\CityMapper();
			$params[] = array(
							'column'=>'region_id'
						,	'value'=> $option['id']);
			$params[] = array(	'column'=>'city_id'
						,	'value'=> $option['id']);
		}
		if($option['type'] == 'field-of-study'){
			$mapper = new App\Mapper\FieldOfStudyMapper();
			$params[] = array(
							'column'=>'fos_id'
						,	'value'=> $option['id']);
		}

		$result = $mapper->delete($params);
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
				$insert_data = array();
				$insert_data['country_code'] = $_POST['country_code'];
				$insert_data['country_name'] = $_POST['country_name'];
				$countryMapper->insert($insert_data);
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->_template = 'templates/admin_main';
    $this->view('reference/country/form');
	}

	public function add_region(){
		$regionMapper = new App\Mapper\RegionMapper();
		$countryMapper = new App\Mapper\CountryMapper();
		$data = array(
				'region_id' => ''
			,	'region_country_id' => ''
			,	'region_code' => ''
			,	'region_desc' => ''
		);

		if(!empty($_POST)){
				$insert_data = array();
				$insert_data['region_country_id'] = $_POST['region_country_id'];
				$insert_data['region_code'] = $_POST['region_code'];
				$insert_data['region_desc'] = $_POST['region_desc'];
				$regionMapper->insert($insert_data);
		}
		$this->_data['country_list'] = $countryMapper->get(array(),array(),array(array('column'=>'country_name', 'order'=>'ASC')));
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->_template = 'templates/admin_main';
    $this->view('reference/region/form');
	}

	public function edit_country($id){
		$countryMapper = new App\Mapper\CountryMapper();
		$filter = array();
		$filter[] = array('column'=>'country_id',
											'value' => $id);

		if(!empty($_POST)){
				$update_data = array();
				$update_data['country_code'] = $_POST['country_code'];
				$update_data['country_name'] = $_POST['country_name'];
				$countryMapper->update($update_data, $filter);
		}
		$country = $countryMapper->getByFilter($filter, true);
		if(empty($country));//Show 404

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $country;

		$this->_template = 'templates/admin_main';
    $this->view('reference/country/form');

	}

	public function edit_region($id){
		$regionMapper = new App\Mapper\RegionMapper();
		$countryMapper = new App\Mapper\CountryMapper();

		$filter = array();
		$filter[] = array('column'=>'region_id',
											'value' => $id);

		if(!empty($_POST)){
				$update_data = array();
				$update_data['region_country_id'] = $_POST['region_country_id'];
				$update_data['region_code'] = $_POST['region_code'];
				$update_data['region_desc'] = $_POST['region_desc'];
				$regionMapper->update($update_data, $filter);
		}
		$region = $regionMapper->getByFilter($filter, true);
		if(empty($region));//Show 404
		$this->_data['country_list'] = $countryMapper->get(array(),array(),array(array('column'=>'country_name', 'order'=>'ASC')));

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $region;

		$this->_template = 'templates/admin_main';
    $this->view('reference/region/form');

	}


	public function add_field_of_study(){
		$fieldOfStudyMapper = new App\Mapper\FieldOfStudyMapper();
		$data = array(
				'fos_id' => ''
			,	'fos_name' => ''
			,	'fos_parent_fos_id'=> ''
		);
		if(!empty($_POST)){
				$insert_data = array();
				$insert_data['fos_name'] = $_POST['fos_name'];
				$insert_data['fos_parent_fos_id'] = (empty($_POST['fos_parent_fos_id']))? NULL: $_POST['fos_parent_fos_id'];
				$fieldOfStudyMapper->insert($insert_data);

		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;
		$this->_data['fos_parent_list'] = $fieldOfStudyMapper->selectAllHeader();

		$this->_template = 'templates/admin_main';
    $this->view('reference/field_of_study/form');
	}

	public function edit_field_of_study($id){
		$fieldOfStudyMapper = new App\Mapper\FieldOfStudyMapper();
		$filter = array();
		$filter[] = array('column'=>'fos_id',
											'value' => $id);

		if(!empty($_POST)){
				$update_data = array();
				$update_data['fos_name'] = $_POST['fos_name'];
				$update_data['fos_parent_fos_id'] = (empty($_POST['fos_parent_fos_id']))? NULL: $_POST['fos_parent_fos_id'];
				$fieldOfStudyMapper->update($update_data, $filter);
		}
		$fieldOfStudy = $fieldOfStudyMapper->getByFilter($filter, true);
		if(empty($country));//Show 404
		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $fieldOfStudy;
		$this->_data['fos_parent_list'] = $fieldOfStudyMapper->selectAllHeader();

		$this->_template = 'templates/admin_main';
    $this->view('reference/field_of_study/form');
	}

	public function region(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/region/list');
  }

	public function province(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/province/list');
  }

	public function city(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/city');
  }

	public function field_of_study(){
    $this->_template = 'templates/admin_main';
    $this->view('reference/field_of_study/list');
  }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reference extends Controller {

	public function __construct(){
		parent::__construct();
		$this->is_secure = true;
	}

	public function ref(){//Use with DataTable
		$limit = isset($_POST['length'])? $_POST['length'] : '0';
		$offset = isset($_POST['start'])? $_POST['start'] : '0';
		$condition = isset($_POST['condition'])? $_POST['condition'] : array();
		$search = $_POST['search'];
		$columns = $_POST['columns'];
		$option = $_POST['option'];
		$order = isset($_POST['order'])? $_POST['order'] : array();
		$orders = array();

		foreach($order as $_order){
			array_push($orders, array(
				'col'=> $columns[$_order['column']]['data']
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
		if($option['type'] == 'educ-attainment'){
			$mapper = new App\Mapper\EducAttainmentMapper();
		}
		if($option['type'] == 'school'){
			$mapper = new App\Mapper\SchoolMapper();
		}
		if($option['type'] == 'skill'){
			$mapper = new App\Mapper\SkillTagMapper();
		}

		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders, $condition);
		echo json_encode($result);
	}

	public function delete_ref(){
		$option = $_POST;
		$params = array();
		$mapper = '';
		switch($option['type']){
			case 'country':
				$mapper = new App\Mapper\CountryMapper();
				$params[] = array(
								'column'=>'country_id'
							,	'value'=> $option['id']);
			break;
			case 'region':
				$mapper = new App\Mapper\RegionMapper();
				$params[] = array(
								'column'=>'region_id'
							,	'value'=> $option['id']);
			break;
			case 'province':
				$mapper = new App\Mapper\ProvinceMapper();
				$params[] = array(
								'column'=>'province_id'
							,	'value'=> $option['id']);
			break;
			case 'city':
				$mapper = new App\Mapper\CityMapper();
				$params[] = array(
								'column'=>'city_id'
							,	'value'=> $option['id']);
			break;
			case 'field-of-study':
				$mapper = new App\Mapper\FieldOfStudyMapper();
				$params[] = array(
								'column'=>'fos_id'
							,	'value'=> $option['id']);
			break;
			case 'educ-attainment':
				$mapper = new App\Mapper\EducAttainmentMapper();
				$params[] = array(
								'column'=>'ea_id'
							,	'value'=> $option['id']);
			break;
			case 'school':
				$mapper = new App\Mapper\SchoolMapper();
				$params[] = array(
								'column'=>'school_id'
							,	'value'=> $option['id']);
			break;
			case 'skill':
				$mapper = new App\Mapper\SkillTagMapper();
				$params[] = array(
								'column'=>'st_id'
							,	'value'=> $option['id']);
			break;

		}

		$result = $mapper->delete($params);
		echo json_encode($result);
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
				$this->set_alert(array(
					'message'=>	'Successfully added a country.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/country'
				,	'text'	=>	'Country List'
				));
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
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
				$this->set_alert(array(
					'message'=>	'Successfully added a region.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/region'
				,	'text'	=>	'Region List'
				));
		}
		$this->_data['country_list'] = $countryMapper->get(array(),array(),array(array('column'=>'country_name', 'order'=>'ASC')));
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('reference/region/form');
	}

	public function add_province(){
		$provinceMapper = new App\Mapper\ProvinceMapper();
		$regionMapper = new App\Mapper\RegionMapper();
		$data = array(
				'province_id' => ''
			,	'province_region_id' => ''
			,	'province_code' => ''
			,	'province_name' => ''
		);

		if(!empty($_POST)){
				$insert_data = array();
				$insert_data['province_region_id'] = $_POST['province_region_id'];
				$insert_data['province_code'] = $_POST['province_code'];
				$insert_data['province_name'] = $_POST['province_name'];
				$provinceMapper->insert($insert_data);
				$this->set_alert(array(
					'message'=>	'Successfully added a province.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/province'
				,	'text'	=>	'Province List'
				));
		}
		$this->_data['region_list'] = $regionMapper->get(array(),array(),array(array('column'=>'region_desc', 'order'=>'ASC')));
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('reference/province/form');
	}

	public function add_city(){
		$cityMapper = new App\Mapper\CityMapper();
		$provinceMapper = new App\Mapper\ProvinceMapper();
		$data = array(
				'city_province_id' => ''
			,	'city_name' => ''
		);

		if(!empty($_POST)){
				$insert_data = array();
				$insert_data['city_province_id'] = $_POST['city_province_id'];
				$insert_data['city_name'] = $_POST['city_name'];
				$cityMapper->insert($insert_data);
				$this->set_alert(array(
					'message'=>	'Successfully added a city.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/city'
				,	'text'	=>	'City List'
				));
		}
		$this->_data['province_list'] = $provinceMapper->get(array(),array(),array(array('column'=>'province_name', 'order'=>'ASC')));
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('reference/city/form');
	}

	public function add_educ_attainment(){
		$educAttainmentMapper = new App\Mapper\EducAttainmentMapper();
		$data = array(
				'ea_id' => ''
			,	'ea_name' => ''
		);

		if(!empty($_POST)){
				$insert_data = array();
				$insert_data['ea_name'] = $_POST['ea_name'];
				$educAttainmentMapper->insert($insert_data);
				$this->set_alert(array(
					'message'=>	'Successfully added a educational attainment.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/educ-attainment'
				,	'text'	=>	'Educational Attainment List'
				));
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('reference/educ_attainment/form');
	}

	public function add_skill_tag(){
		$skillTagMapper = new App\Mapper\SkillTagMapper();
		$data = array(
				'st_id' => ''
			,	'st_name' => ''
		);

		if(!empty($_POST)){
				$insert_data = array();
				$insert_data['st_name'] = $_POST['st_name'];
				$skillTagMapper->insert($insert_data);
				$this->set_alert(array(
					'message'=>	'Successfully added a Skill Tag.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/skill-tag'
				,	'text'	=>	'Skill Tag List'
				));
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('reference/skill_tag/form');
	}

	public function add_school(){
		$schoolMapper = new App\Mapper\SchoolMapper();
		$addressMapper = new App\Mapper\AddressMapper();
		$data = array(
				'school_name' => ''
			,	'address_desc' => ''
		);

		if(!empty($_POST)){
				$insert_address = array();
				$insert_address['address_city_id'] = $_POST['city_id'];
				$insert_address['address_province_id'] = $_POST['province_id'];
				$insert_address['address_desc'] = $_POST['address_desc'];
				$address_id = $addressMapper->insert($insert_address);

				$insert_school = array();
				$insert_school['school_address_id'] = $address_id;
				$insert_school['school_name'] = $_POST['school_name'];
				$schoolMapper->insert($insert_school);
				$this->set_alert(array(
					'message'=>	'Successfully added a school'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/school'
				,	'text'	=>	'School List'
				));
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;

		$this->is_secure = true;
    $this->view('reference/school/form');
	}

	public function edit_school($id){
		$schoolMapper = new App\Mapper\SchoolMapper();
		$addressMapper = new App\Mapper\AddressMapper();
		$cityMapper = new App\Mapper\CityMapper();
		$provinceMapper = new App\Mapper\ProvinceMapper();

		if(!empty($_POST)){
				$update_data = array();
				$update_data['school_name'] = $_POST['school_name'];
				$update_data['city_name'] = $_POST['city_name'];
				$addressMapper->update($update_data, $filter);
				$this->set_alert(array(
					'message'=>	'Successfully updated a school'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/school'
				,	'text'	=>	'School List'
				));
		}
		$school = $schoolMapper->getByID($id);
		if(empty($school));//Show 404
		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $school;

		$this->is_secure = true;
    $this->view('reference/school/form');
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
				$this->set_alert(array(
					'message'=>	'Successfully updated a country.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/country'
				,	'text'	=>	'Country List'
				));
		}
		$country = $countryMapper->getByFilter($filter, true);
		if(empty($country));//Show 404

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $country;

		$this->is_secure = true;
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
				$this->set_alert(array(
					'message'=>	'Successfully updated a region.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/region'
				,	'text'	=>	'Region List'
				));
		}
		$region = $regionMapper->getByFilter($filter, true);
		if(empty($region));//Show 404
		$this->_data['country_list'] = $countryMapper->get(array(),array(),array(array('column'=>'country_name', 'order'=>'ASC')));

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $region;

		$this->is_secure = true;
    $this->view('reference/region/form');

	}

	public function edit_province($id){
		$regionMapper = new App\Mapper\RegionMapper();
		$countryMapper = new App\Mapper\CountryMapper();
		$provinceMapper = new App\Mapper\ProvinceMapper();

		$filter = array();
		$filter[] = array('column'=>'province_id',
											'value' => $id);

		if(!empty($_POST)){
				$update_data = array();
				$update_data['province_region_id'] = $_POST['province_region_id'];
				$update_data['province_code'] = $_POST['province_code'];
				$update_data['province_name'] = $_POST['province_name'];
				$provinceMapper->update($update_data, $filter);
				$this->set_alert(array(
					'message'=>	'Successfully updated a province.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/province'
				,	'text'	=>	'Province List'
				));
		}
		$province = $provinceMapper->getByFilter($filter, true);
		if(empty($province));//Show 404
		$this->_data['region_list'] = $regionMapper->get(array(),array(),array(array('column'=>'region_desc', 'order'=>'ASC')));

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $province;

		$this->is_secure = true;
    $this->view('reference/province/form');
	}

	public function edit_city($id){
		$cityMapper = new App\Mapper\CityMapper();
		$provinceMapper = new App\Mapper\ProvinceMapper();

		$filter = array();
		$filter[] = array('column'=>'city_id',
											'value' => $id);

		if(!empty($_POST)){
				$update_data = array();
				$update_data['city_province_id'] = $_POST['city_province_id'];
				$update_data['city_name'] = $_POST['city_name'];
				$cityMapper->update($update_data, $filter);
				$this->set_alert(array(
					'message'=>	'Successfully updated a city.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/city'
				,	'text'	=>	'City List'
				));
		}
		$city = $cityMapper->getByFilter($filter, true);
		if(empty($city));//Show 404
		$this->_data['province_list'] = $provinceMapper->get(array(),array(),array(array('column'=>'province_name', 'order'=>'ASC')));

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $city;

		$this->is_secure = true;
    $this->view('reference/city/form');
	}

	public function edit_educ_attainment($id){
		$educAttainmentMapper = new App\Mapper\EducAttainmentMapper();
		$filter = array();
		$filter[] = array('column'=>'ea_id',
											'value' => $id);

		if(!empty($_POST)){
				$update_data = array();
				$update_data['ea_name'] = $_POST['ea_name'];
				$educAttainmentMapper->update($update_data, $filter);
				$this->set_alert(array(
					'message'=>	'Successfully updated a educational attainment.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/educ-attainment'
				,	'text'	=>	'Educational Attainment List'
				));
		}
		$educAttainment = $educAttainmentMapper->getByFilter($filter, true);
		if(empty($country));//Show 404

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $educAttainment;

		$this->is_secure = true;
    $this->view('reference/educ_attainment/form');

	}

	public function edit_skill_tag($id){
		$skillTagMapper = new App\Mapper\SkillTagMapper();
		$filter = array();
		$filter[] = array('column'=>'st_id',
											'value' => $id);

		if(!empty($_POST)){
				$update_data = array();
				$update_data['st_name'] = $_POST['st_name'];
				$skillTagMapper->update($update_data, $filter);
				$this->set_alert(array(
					'message'=>	'Successfully updated a skill tag.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/skill-tag'
				,	'text'	=>	'Skill Tag List'
				));
		}
		$skillTag = $skillTagMapper->getByFilter($filter, true);
		if(empty($country));//Show 404

		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $skillTag;

		$this->is_secure = true;
    $this->view('reference/skill_tag/form');

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
				$this->set_alert(array(
					'message'=>	'Successfully added a field of study.'
				,	'type'	=> 	'success'
				,	'href'	=> 	DOMAIN.'reference/field-of-study'
				,	'text'	=>	'Field of Study List'
				));
		}
		$this->_data['action'] = 'add';
		$this->_data['form_data'] = $data;
		$this->_data['fos_parent_list'] = $fieldOfStudyMapper->selectAllHeader();

		$this->is_secure = true;
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
				$this->set_alert(array(
					'message'=>	'Successfully updated a field of study.'
				,	'type'	=> 	'success'
				,	'href'	=>	DOMAIN.'reference/field-of-study'
				,	'text'	=>	'Field of Study List'
				));
		}
		$fieldOfStudy = $fieldOfStudyMapper->getByFilter($filter, true);
		if(empty($country));//Show 404
		$this->_data['action'] = 'edit';
		$this->_data['form_data'] = $fieldOfStudy;
		$this->_data['fos_parent_list'] = $fieldOfStudyMapper->selectAllHeader();

		$this->is_secure = true;
    $this->view('reference/field_of_study/form');
	}

	public function country(){
    $this->is_secure = true;
    $this->view('reference/country/list');
  }

	public function region(){
    $this->is_secure = true;
    $this->view('reference/region/list');
  }

	public function province(){
    $this->is_secure = true;
    $this->view('reference/province/list');
  }

	public function city(){
    $this->is_secure = true;
    $this->view('reference/city/list');
  }

	public function field_of_study(){
    $this->is_secure = true;
    $this->view('reference/field_of_study/list');
  }

	public function educ_attainment(){
    $this->is_secure = true;
    $this->view('reference/educ_attainment/list');
  }

	public function school(){
    $this->is_secure = true;
    $this->view('reference/school/list');
  }

	public function skill_tag(){
    $this->is_secure = true;
    $this->view('reference/skill_tag/list');
  }

	public function education_form(){
		$this->view('applicant/education_form');
	}




}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function admin_ref(){
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
		$mapper = new App\Mapper\AdminMapper();

		$result = $mapper->selectDataTable($search['value'], $columns, $limit, $offset, $orders);

		echo json_encode($result);
	}

  public function list(){
    $this->_template = 'templates/admin_main';
    $this->view('administrator/list');
  }

}

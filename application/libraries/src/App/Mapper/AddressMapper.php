<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class AddressMapper extends Mapper{

  protected $_table = 'tbl_address';


  public function getCompleteAddressByID($add_id){
    $sql_statement = "SELECT *
                      FROM `tbl_address`
                      LEFT JOIN `tbl_city`
                      ON `city_id` = `address_city_id`
                      LEFT JOIN `tbl_province`
                      ON `province_id` = `city_province_id`
                      LEFT JOIN `tbl_region`
                      ON `region_id` = `province_region_id`
                      LEFT JOIN `tbl_country`
                      ON `country_id` = `region_country_id`
                      WHERE `address_id` = :address_id";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute(array(
      ':address_id'   => $add_id
    ));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $result;
  }

}

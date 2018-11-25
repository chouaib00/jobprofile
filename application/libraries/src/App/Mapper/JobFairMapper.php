<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class JobFairMapper extends Mapper{

  protected $_table = 'tbl_job_fair';

  public function getList(){
    $sql_statement = "SELECT *
                    FROM `tbl_job_fair`
                    ORDER BY `jf_id` DESC";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function getActive(){
    $sql_statement = "SELECT *
                      FROM `tbl_job_fair`
                      WHERE `js_is_current` = '1'";
    $stmt = $this->prepare($sql_statement);
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if(empty($result)){
      return 0;
    }
    else{
      return $result['jf_id'];
    }
  }
}

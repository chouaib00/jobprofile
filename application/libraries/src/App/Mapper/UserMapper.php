<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class UserMapper extends Mapper{

  protected $_table = 'tbl_user';

  public function selectByLoginPassword($username_email, $password){
    $sql_statement = "SELECT *
                      FROM tbl_user
                      WHERE (user_email = :user_email OR user_name = :user_name) AND  user_password = :user_password";
		$stmt = $this->prepare($sql_statement);
		$stmt->execute(array(
      ':user_email'   => $username_email
    , ':user_name'   => $username_email
    , ':user_password'=> $password
    ));
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $result;
  }

}

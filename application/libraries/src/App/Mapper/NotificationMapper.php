<?php
namespace App\Mapper;
use Sys\Mapper\Mapper;

class NotificationMapper extends Mapper{

  protected $_table = 'tbl_notifications';

  public function getNotificationAdmin($user_id){
    $sql_statement = "SELECT *
                      FROM `tbl_notifications`
                      WHERE `notif_user_id` = :notif_user_id AND notif_is_open_admin = '0'
                      ORDER BY `notif_date` DESC
                      LIMIT 100";
		$stmt = $this->prepare($sql_statement);

		$stmt->execute(array(
      ':notif_user_id'=>$user_id
    ));
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function getNotification($user_id){
    $sql_statement = "SELECT *
                      FROM `tbl_notifications`
                      WHERE `notif_user_id` = :notif_user_id AND notif_is_open_user = '0'
                      ORDER BY `notif_date` DESC
                      LIMIT 100";
		$stmt = $this->prepare($sql_statement);

		$stmt->execute(array(
      ':notif_user_id'=>$user_id
    ));
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function markReadAdmin($notif_id){
    $this->update(array(
      'notif_is_open_admin'=> '1'
    ),"notif_id = '".$notif_id."'");
  }

  public function markRead($notif_id){
    $this->update(array(
      'notif_is_open_user'=> '1'
    ),"notif_id = '".$notif_id."'");
  }

}

<?php
/**
 * 1.資料庫EmailNotificationMessage 列出歷史會員寄件訊息
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectEmailNotificationMessageList($start,$per){
    $limit=getSQLLimitStartEnd($start,$per);
    $sql = "SELECT * FROM `email_notification_message` WHERE 1 ORDER BY `send_time` DESC ".$limit;
    return sendSQL($sql);
}
/**
 * 1.資料庫EmailNotificationMessage 新增寄信給客戶內容訊息
 *
 * @author Peter Chang
 *
 * @param string $subject 寄信主旨
 * 
 * @param string $message 寄信訊息
 * 
 * @param string $filename 寄件檔案
 * 
 * @return array
 */
function sqlInsertEmailNotificationMessage($subject,$message,$filename){
    $sql = "INSERT INTO `email_notification_message`(`subject`, `message`, `filename`) VALUES ('".$subject."','".$message."','".$filename."')";
    return sendSQL($sql,true);
}
/**
 * 1.資料庫EmailNotificationMessage 查詢寄信訊息id資料
 *
 * @author Peter Chang
 *
 * @param integer $id EmailNotificationMessage的id
 * 
 * @return array
 */
function sqlSelectEmailNotificationMessageId($id){
    $sql = "SELECT * FROM `email_notification_message` WHERE `email_notification_message_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫EmailNotificationMessage 修改成功或失敗且將寄信的會員儲存至資料庫
 *
 * @author Peter Chang
 *
 * @param integer $id EmailNotificationMessage的id
 * 
 * @param string $member_id 會員id的陣列轉成字串存入
 * 
 * @param integer $pass 成功或不成功狀態
 * 
 * @return array
 */
function sqlUpdateEmailNotificationMessageMemeberIdArrayPass($id,$member_id_array,$pass){
    $sql = "UPDATE `email_notification_message` 
    SET `member_id_array`='".$member_id_array."',
    `email_notification_message_pass`= ".$pass."
    WHERE `email_notification_message_id` = ".$id;
    return sendSQL($sql);
}
?>
<?php
/**
 * 1.資料庫ContactInformation 新增聯絡資訊
 *
 * @author Peter Chang
 *
 * @param string $name 聯絡人名稱
 * 
 * @param string $phone 電話號碼
 * 
 * @param string $email Email
 * 
 * @param string $message 聯絡訊息
 * 
 * @return array
 */
function sqlInsertContactInformation($ip,$name,$phone,$email,$message){
    $sql = "INSERT INTO `contact_information`(`ip`,`name`, `phone`,`email`,`message`, `contact_state`) VALUES ('".$ip."','".$name."','".$phone."','".$email."','".$message."',0)";
    return sendSQL($sql,true);
}

?>
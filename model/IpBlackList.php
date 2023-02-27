<?php
/**
 * 1.資料庫IpBlackList 新增黑名單ip
 *
 * @author Peter Chang
 *
 * @param string $ip 電腦使用者ip
 * 
 * @return array
 */
function sqlInsertIpBlackList($ip){
    $sql = "INSERT INTO `ip_black_list`(`ip`)VALUES('".$ip."') ";
    return sendSQL($sql);
}
?>
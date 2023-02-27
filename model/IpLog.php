<?php
/**
 * 1.資料庫IpLog 查詢不同IP登入
 *
 * @author Peter Chang
 *
 * @param array $date 使用者查詢的項目
 * 
 * @return array
 */
function sqlSelectIpLogIpCreateTime($date){
    $sql = "SELECT * FROM `ip_log` WHERE `ip_create_time` LIKE '".$date."%' GROUP BY `ip` ";
    return sendSQL($sql);
}
/**
 * 1.資料庫IpLog 查詢下載報價單
 *
 * @author Peter Chang
 *
 * @param array $date 使用者查詢的項目
 * 
 * @return array
 */
function sqlSelectIpLogIpCreateTimeOceanExportIdNotNull($date){
    $sql = "SELECT * FROM `ip_log` WHERE `ip_create_time` LIKE '".$date."%' AND `ocean_export_id` IS NOT NULL GROUP BY `ip` ";
    return sendSQL($sql);
}
/**
 * 1.資料庫IpLog 查詢網頁下艙紀錄
 *
 * @author Peter Chang
 *
 * @param array $date 使用者查詢的項目
 * 
 * @return array
 */
function sqlSelectIpLogIpCreateTimeActionBookingOrder($date){
    $sql = "SELECT `ip_log`.*,`member`.`username` 
    FROM `ip_log` 
    INNER JOIN `member` ON `member`.`member_id` = `ip_log`.`member_id` 
    WHERE `ip_create_time` LIKE '".$date."%' AND `action` LIKE 'BookingOrder' GROUP BY `member_id` ";
    return sendSQL($sql);
}
?>
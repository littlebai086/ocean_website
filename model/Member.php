<?php
/**
 * 1.資料庫Member 列出會員審核狀態，及使用者查詢的資料
 *
 * @author Peter Chang
 *
 * @param integer $pass 審核狀態
 * 
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return array
 */
function sqlSelectMemberPassList($pass,$search_fields,$start,$per){
    $limit=getSQLLimitStartEnd($start,$per);
    $sql = "SELECT * FROM `member` WHERE `pass` =".$pass;
    $sql=getStaffMemberListSqlSearchWhere($sql,$search_fields);
    $sql.= " ORDER BY `register_time` DESC ".$limit;
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 查詢註冊驗證碼
 *
 * @author Peter Chang
 *
 * @param array $date 使用者查詢的項目
 * 
 * @return array
 */
function sqlSelectMemberLogCreateTime($date){
    $sql = "SELECT * FROM `member_log` WHERE `create_time` LIKE '".$date."%' AND `member_id` IS NULL GROUP BY `register_username` ";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 查詢沒有通過註冊
 *
 * @author Peter Chang
 *
 * @param array $date 使用者查詢的項目
 * 
 * @return array
 */
function sqlSelectMemberLogCreateTimeMemberIdNullNotPass($date){
    $sql = "SELECT * FROM `member_log` WHERE `create_time` LIKE '".$date."%' AND `member_id` IS NULL AND `pass` = 0 GROUP BY `register_username` ";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 查詢註冊驗證碼
 *
 * @author Peter Chang
 *
 * @param array $date 使用者查詢的項目
 * 
 * @return array
 */
function sqlSelectMemberLogCreateTimeMemberIdNullPass($date){
    $sql = "SELECT * FROM `member_log` WHERE `create_time` LIKE '".$date."%' AND `member_id` IS NULL AND `pass` = 1 GROUP BY `register_username` ";
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 列出會員統計資訊，及使用者查詢的資料
 *
 * @author Peter Chang
 * 
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return array
 */
function sqlSelectMemberLoginLogDataStatisticsList($search_fields,$start,$per){
    $start_date=intval(str_replace("-","",$search_fields['start_date']));
    $end_date=intval(str_replace("-","",$search_fields['end_date']));
    $limit=getSQLLimitStartEnd($start,$per);
    $sql = "
SELECT *, (
    SELECT IFNULL(count(*),0) 
    FROM `member_login_log` 
    WHERE `member`.`member_id` = `member_login_log`.`member_id` AND $end_date>= DATE_FORMAT(`login_time`,'%Y%m') AND DATE_FORMAT(`login_time`,'%Y%m') >= $start_date) AS `member_login_statistics`, (
    SELECT IFNULL(count(*),0) 
    FROM `booking_order` 
    WHERE `member`.`member_id` = `booking_order`.`member_id` AND $end_date>=  DATE_FORMAT(`create_time`,'%Y%m') AND DATE_FORMAT(`create_time`,'%Y%m') >= $start_date) AS `booking_order_statistics`
FROM `member` ";
    $sql=getStaffMemberStatisticsListSqlOrderBy($sql,$search_fields).$limit;
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 搜尋會員當月的登入次數及下單數量
 *
 * @author Peter Chang
 * 
 * @param string $year_month 查詢年月
 * 
 * @param integer $member_id 會員id
 * 
 * @return array
 */
function sqlSelectMemberLoginLogDataStatisticsMemberId($year_month,$member_id){
    $sql = "
SELECT *, ( SELECT IFNULL(count(*),0) FROM `member_login_log` WHERE `member`.`member_id` = `member_login_log`.`member_id` AND `login_time` LIKE '".$year_month."%') AS `member_login_statistics`, ( SELECT IFNULL(count(*),0) FROM `booking_order` WHERE `member`.`member_id` = `booking_order`.`member_id` AND `create_time` LIKE '".$year_month."%') AS `booking_order_statistics` FROM `member` WHERE `member_id` = ".$member_id." ORDER BY `member_login_statistics` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 查詢會員聯絡的EMail
 *
 * @author Peter Chang
 *
 * @param string $email 聯絡Email
 * 
 * @return array
 */
function sqlSelectMemberContactEmail($email){
    $sql = "SELECT * FROM `member` WHERE `contact_email`='".$email."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 查詢為會員id修改審核狀態及審核訊息
 *
 * @author Peter Chang
 *
 * @param integer $id 會員id
 * 
 * @param integer $pass 審核狀態
 * 
 * @param string $pass_message 審核訊息內容
 * 
 * @return array
 */

function sqlUpdateMemberIdPass($id,$pass,$pass_message){
    $sql = "UPDATE `member` SET `pass`=".$pass.",`pass_message` = '".$pass_message."' WHERE `member_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 查詢該會員修改密碼
 *
 * @author Peter Chang
 *
 * @param integer $id 會員id
 * 
 * @param string $password 會員密碼
 * 
 * @return array
 */
function sqlUpdateMemberIdPassword($id,$password){
    $sql = "UPDATE `member` SET `password`='".$password."' WHERE `member_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 新增會員資訊
 *
 * @author Peter Chang
 *
 * @param array $data_array 使用者註冊會員輸入的資料
 * 
 * @return array
 */
function sqlInsertMember($data_array){
    $sql = "INSERT INTO `member`(`username`, `password`, `tax_id_number`,
    `company_chinese`, `company_english`, `contact_name`,`gender`,
    `contact_cellphone`, `contact_company_phone`,`contact_company_extension`,
    `contact_company_fax`,
    `contact_email`, `area_id`, `company_address`,`pass`)
        VALUES('".$data_array['username']."','".$data_array['password']."',
        '".$data_array['tax_id_number']."','".$data_array['company_chinese']."',
        '".$data_array['company_english']."','".$data_array['contact_name']."',
        '".$data_array['gender']."','".$data_array['contact_cellphone']."',
        '".$data_array['contact_company_phone']."','".$data_array['contact_company_extension']."',
        '".$data_array['contact_company_fax']."',
        '".$data_array['contact_email']."',".$data_array['area_id'].",
        '".$data_array['company_address']."',0)";
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 會員修改個人資訊
 *
 * @author Peter Chang
 *
 * @param array $data_array 使用者會員輸入的資料
 * 
 * @return array
 */
function sqlUpdateMember($data_array){
    $sql = "UPDATE `member` SET `tax_id_number`='".$data_array['tax_id_number']."',
    `company_chinese`='".$data_array['company_chinese']."',
    `company_english`='".$data_array['company_english']."',
    `contact_name`='".$data_array['contact_name']."',
    `gender`='".$data_array['gender']."',
    `contact_cellphone`='".$data_array['contact_cellphone']."',
    `contact_company_phone`='".$data_array['contact_company_phone']."',
    `contact_company_extension`='".$data_array['contact_company_extension']."',
    `contact_company_fax`='".$data_array['contact_company_fax']."',
    `contact_email`='".$data_array['contact_email']."',
    `area_id`=".$data_array['area_id'].",
    `company_address`='".$data_array['company_address']."'
    WHERE `member_id`=".$data_array['member_id'];
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 員工修改客戶公司中文名稱及英文名稱
 *
 * @author Peter Chang
 *
 * @param integer $member_id 會員id
 * 
 * @param string $company_chinese 公司中文名稱
 * 
 * @param string $company_english 公司英文名稱
 * 
 * @return array
 */
function sqlUpdateMemberCompanyChineseCompanyEnglish($member_id,$company_chinese,$company_english,$area_id,$company_address){
    $sql = "UPDATE `member` SET `company_chinese`='".$company_chinese."',
    `company_english`='".$company_english."',
    `area_id`='".$area_id."',
    `company_address`='".$company_address."'
    WHERE `member_id`=".$member_id;
    return sendSQL($sql);
}
?>
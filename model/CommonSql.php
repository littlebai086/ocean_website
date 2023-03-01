<?php
/**
 * 1.sendSQL為全部SQL共用資料的部分，將SQL資料轉成陣列於PHP5以下必須為這樣
 * 2.getSQLLink為正式使用的資料庫帳密
 * 3.getSQLLink_test為內網放在主機上的測試使用
 * 
 * @author Peter Chang
 *
 * @param string $sql 為$sql語法
 * 
 * @param boolean $insert_id 是否需要新增的id號碼
 * 
 * @return array
 */
function sendSQL($sql,$insert_id=false)
{
    set_time_limit(0);
    require_once('sqlLink.php');
    //$db = getSQLLink();
    $db = getSQLLink_test();
    //$buf_array=array();
    //echo $sql."<br>";
    $buf = mysqli_query($db, $sql);
    if ($buf !==true and $buf !==false){
        $buf_array=array();
        while ($row=mysqli_fetch_array($buf,MYSQLI_ASSOC)){
            array_push($buf_array,$row);
        }
        $buf=$buf_array;
    }
    $id=mysqli_insert_id($db);
    mysqli_close($db);
    if ($insert_id){
        return $id;
    }
    return $buf;
}
/**
 * 1.資料庫StaffList 搜尋員工id個人資料
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫StaffList的id資料
 * 
 * @return array
 */
function sqlSelectStaffListId($id){
    $sql = "SELECT * FROM `staff_list` WHERE `staff_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫IpLog 紀錄ip就會新增一次
 *
 * @author Peter Chang
 *
 * @param string $ip 為電腦ip
 * 
 * @return array
 */
function sqlInsertIpLog($ip,$member_id,$ocean_export_id="NULL",$destination_port_id="NULL",$shipment_type=NULL){
    $member_id=getDataZeroTransferNullSaveSql($member_id);
    $ocean_export_id=getDataZeroTransferNullSaveSql($ocean_export_id);
    $destination_port_id=getDataZeroTransferNullSaveSql($destination_port_id);
    if($shipment_type===NULL){
        $sql = "INSERT INTO `ip_log`(`ip`, `member_id`, `ocean_export_id`,`destination_port_id`) VALUES ('".$ip."',".$member_id.",".$ocean_export_id.",".$destination_port_id.")";
    }else{
        $sql = "INSERT INTO `ip_log`(`ip`, `member_id`, `ocean_export_id`,`destination_port_id`,`shipment_type`) VALUES ('".$ip."',".$member_id.",".$ocean_export_id.",".$destination_port_id.",'".$shipment_type."')";
    }
    return sendSQL($sql);
}
/**
 * 1.資料庫IpLog 紀錄ip 訂艙畫面新增一次
 *
 * @author Peter Chang
 *
 * @param string $ip 為電腦ip
 * 
 * @param integer $member_id 會員id
 * 
 * @param string $action 會員執行動作 
 * 
 * @param string shipment_type 訂艙類型
 * 
 * @return array
 */
function sqlInsertIpLogActionShipmentType($ip,$member_id,$action,$shipment_type){
    $member_id=getDataZeroTransferNullSaveSql($member_id);
    $sql = "INSERT INTO `ip_log`(`ip`, `member_id`, `action`,`shipment_type`) VALUES ('".$ip."',".$member_id.",'".$action."','".$shipment_type."')";
    
    return sendSQL($sql);
}
/**
 * 1.資料庫IpLog 搜尋IP
 *
 * @author Peter Chang
 *
 * @param string $ip 為電腦ip
 * 
 * @return array
 */
function sqlSelectIpLogIp($ip){
    $sql = "SELECT * FROM `ip_log` WHERE `ip` LIKE '".$ip."' ORDER BY `ip_create_time` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫IpBlackList 搜尋黑名單IP
 *
 * @author Peter Chang
 *
 * @param string $ip 為電腦ip
 * 
 * @return array
 */
function sqlSelectIpBlackListIp($ip){
    $sql = "SELECT * FROM `ip_black_list` WHERE `ip` LIKE '".$ip."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLoginLog 會員登入紀錄就會新增一次
 *
 * @author Peter Chang
 *
 * @param integer $member_id 為會員id資料
 * 
 * @return array
 */
function sqlInsertMemberLoginLog($member_id){
    $sql = "INSERT INTO `member_login_log`(`member_id`)VALUES(".$member_id.")";
    return sendSQL($sql);
}
/**
 * 1.資料庫EmailAddressBook 寄送給員工或公司部門使用，資料庫有資料才會寄送
 * 2.這邊可以針對會CC給部門或是收件者為公司的
 *
 * @author Peter Chang
 *
 * @param string $email 為公司單個或多個Email成立的陣列
 * 
 * @return array
 */
function sqlSelectEmailAddressBookEmail($email){
    $buf="";
    $emails=explode(";",$email);
    $TEST_address="@test.com";
    foreach($emails as $email){
        if($email=="test"){
            $buf.="`email` = 'peter777200067@gmail.com' OR ";
        }elseif($email=="test_cc"){
            $buf.="`email` = 'peter777200067@gmail.com' OR ";
        }else{
            $buf.="`email` = '".$email.$TEST_address."' OR ";
        }
    }
    $buf=rtrim($buf,"OR ");
    $sql = "SELECT * FROM `email_address_book` WHERE 1 AND ".$buf;
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 會員資訊查詢使用者帳號
 *
 * @author Peter Chang
 *
 * @param string $username 為使用者帳號
 * 
 * @return array
 */
function sqlSelectMemberUsername($username){
    $sql = "SELECT * FROM `member` WHERE `username`='".$username."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 會員資訊查詢使用者帳號
 *
 * @author Peter Chang
 *
 * @param string $username 為使用者帳號
 * 
 * @return array
 */
function sqlSelectMemberId($id){
    $sql = "SELECT * FROM `member` LEFT JOIN `area` on `member`.`area_id` = `area`.`area_id` WHERE `member`.`member_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Member 會員資訊查詢使用者審核狀態
 *
 * @author Peter Chang
 *
 * @param integer $pass 為審核狀態
 * 
 * @return array
 */
function sqlSelectMemberPass($pass){
    $sql = "SELECT * FROM `member` WHERE `pass`=".$pass;
    return sendSQL($sql);
}
/**
 * 1.資料庫StaffAccountList 員工帳戶資訊查詢員工帳號
 *
 * @author Peter Chang
 *
 * @param string $username 為員工帳號
 * 
 * @return array
 */
function sqlSelectStaffAccountListUsername($username){
    $sql = "SELECT * FROM `staff_account_list` WHERE `username`='".$username."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫CompanyFeeBasis 公司費用基準
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCompanyFeeBasis(){
    $sql = "SELECT * 
    FROM `company_fee_basis`
    INNER JOIN `company_fee_basis_thc` ON `company_fee_basis_thc`.`company_fee_basis_id` = `company_fee_basis`.`company_fee_basis_id`
    ORDER BY `company_fee_basis`.`company_fee_basis_id`,`company_fee_basis_thc`.`cabinet_volume_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫CFSQuantityUnit 併櫃數量單位
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCFSQuantityUnitUnit(){
    $sql = "SELECT * FROM `cfs_quantity_unit` WHERE `cfs_quantity_unit_del` = 0";
    return sendSQL($sql);
}
/**
 * 1.資料庫CFSQuantityUnit 查詢id
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCFSQuantityUnitId($id){
    $sql = "SELECT * FROM `cfs_quantity_unit` WHERE `cfs_quantity_unit_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Company 公司資訊查詢shipper
 *
 * @author Peter Chang
 *
 * @param string $shipper 為船公司
 * 
 * @return array
 */
function sqlSelectCompanyCompanyAbbreviation($shipper){
    $sql = "SELECT * FROM `company` WHERE `company_abbreviation` LIKE '".$shipper."' AND `type`=1";
    return sendSQL($sql);
}
/**
 * 1.資料庫CutOffPlace 查詢結關地點
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCutOffPlace(){
    $sql = "SELECT * FROM `cut_off_place`
INNER JOIN `city` ON `cut_off_place`.`city_id` = `city`.`city_id`";
    return sendSQL($sql);
}
/**
 * 1.資料庫CutOffPlace 查詢結關地點 根據EXCEL表做大到小顯示
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCutOffPlaceOrderByCutOffPlaceIdDesc(){
    $sql = "SELECT * FROM `cut_off_place` ORDER BY `cut_off_place_id` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫CutOffPlace 查詢結關地點
 *
 * @author Peter Chang
 * 
 * @param integer 結關地點id
 * 
 * @return array
 */
function sqlSelectCutOffPlaceId($id){
    $sql = "SELECT * FROM `cut_off_place` WHERE `cut_off_place_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫CabinetVolume 查詢櫃型種類大小
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCabinetVolumeNotDel(){
    $sql = "SELECT * FROM `cabinet_volume` WHERE `cabinet_volume_del` =0";
    return sendSQL($sql);
}
/**
 * 1.資料庫CabinetVolume 查詢單個櫃型種類大小
 *
 * @author Peter Chang
 * 
 * @param string $cabinet_volume 櫃型種類
 * 
 * @return array
 */
function sqlSelectTableNameCabinetVolumeNotDel($cabinet_volume){
    $sql = "SELECT * FROM `cabinet_volume` WHERE `table_name` LIKE '".$cabinet_volume."' AND `cabinet_volume_del` =0";
    return sendSQL($sql);
}
/**
 * 1.資料庫StaffAccountList 員工帳戶資訊查詢員工id
 *
 * @author Peter Chang
 *
 * @param integer $staff_id 為員工id
 * 
 * @return array
 */
function sqlSelectStaffAccountListStaffId($staff_id){
    $sql = "SELECT * FROM `staff_account_list` WHERE `staff_id`=".$staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 國家資料查詢
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCountryCountryNotDel(){
    $sql = "SELECT * FROM `country` WHERE `country_del`= 0";
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 國家資訊查詢國家英文
 *
 * @author Peter Chang
 *
 * @param string $country_english 為國家英文
 * 
 * @return array
 */
function sqlSelectCountryCountryEnglish($country_english){
    $sql = "SELECT * FROM `country` WHERE `country_english` LIKE '".$country_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 國家資訊查詢國家Id
 *
 * @author Peter Chang
 *
 * @param integer $country_id 為國家id
 * 
 * @return array
 */
function sqlSelectCountryCountryId($country_id){
    $sql = "SELECT * FROM `country` WHERE `country_id` = ".$country_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫City 城市資訊用id排序
 *
 * @author Peter Chang
 *
 * @return array
 */
function sqlSelectCity(){
    $sql = "SELECT * FROM `city` ORDER BY `city_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫City 城市資訊查詢城市id
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @return array
 */
function sqlSelectCityId($id){
    $sql = "SELECT * FROM `city` WHERE `city_id` =".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫City 城市資訊查詢城市中文相關條件且用id排序
 *
 * @author Peter Chang
 *
 * @param string $value 城市中文
 * 
 * @return array
 */
function sqlSelectCityCityChineseOrderById($value){
    $sql = "SELECT * FROM `city` WHERE `city_chinese` LIKE '".$value."%' ORDER BY `city_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫Area 區域資訊查詢城市id底下的區域
 *
 * @author Peter Chang
 *
 * @param integer $city_id 城市id
 * 
 * @return array
 */
function sqlSelectAreaCityId($city_id){
    $sql="SELECT * FROM `area` WHERE `city_id` = ".$city_id." ORDER BY `area_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫Area 區域資訊查詢區域帳號
 *
 * @author Peter Chang
 *
 * @param integer $id 區域id
 * 
 * @return array
 */
function sqlSelectAreaId($id){
    $sql="SELECT * FROM `area` WHERE `area_id` = ".$id." ORDER BY `area_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫Destination 目的地資訊查詢國家id
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectDestinationCountryId($country_id){
    $sql="SELECT * FROM `destination` 
LEFT JOIN `destination_port` ON `destination`.`destination_port_id` = `destination_port`.`destination_port_id`
LEFT JOIN `destination_container_depot` ON `destination`.`destination_container_depot_id` = `destination_container_depot`.`destination_container_depot_id`
LEFT JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
LEFT JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
LEFT JOIN `country` ON `city`.`country_id` = `country`.`country_id`
WHERE (`destination_port`.`country_id` = ".$country_id." OR `country`.`country_id`=".$country_id.") AND (`destination_port`.`destination_port_del` = 0 OR `destination_city`.`destination_city_del`=0)
ORDER BY `destination_container_depot`.`container_depot_english` ASC,`destination_port`.`destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫Destinaion 查詢目的地id
 *
 * @author Peter Chang
 *
 * @param integer $id 目的地id
 * 
 * @return array
 */
function sqlSelectDestinationId($id){
    $sql="SELECT `destination`.*,`destination_port`.*,
    `destination_container_depot`.*,
    `country`.`country_id` AS `destination_container_depot_country_id`,
    `destination_port`.`country_id` AS `destination_port_country_id`
FROM `destination`
LEFT JOIN `destination_port` ON `destination`.`destination_port_id` = `destination_port`.`destination_port_id`
LEFT JOIN `destination_container_depot` ON `destination`.`destination_container_depot_id` = `destination_container_depot`.`destination_container_depot_id`
LEFT JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
LEFT JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
LEFT JOIN `country` ON `city`.`country_id` = `country`.`country_id`
 WHERE `destination_id`=".$id;

    return sendSQL($sql);
}
/**
 * 1.資料庫Destination 目的地資訊查詢國家id底下的貨櫃目的地
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectDestinationDestinationContainerDepotCountryId($country_id){
    $sql="SELECT * FROM `destination` 
INNER JOIN `destination_container_depot` ON `destination`.`destination_container_depot_id` = `destination_container_depot`.`destination_container_depot_id`
INNER JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
INNER JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
INNER JOIN `country` ON `city`.`country_id` = `country`.`country_id`
WHERE `country`.`country_id`=".$country_id." AND `destination_container_depot`.`destination_container_depot_del`=0
ORDER BY `destination_container_depot`.`container_depot_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionCity 查詢城市id
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @return array
 */
function sqlSelectDestinationCityCityId($city_id){
    $sql="SELECT * FROM `destination_city` 
    INNER JOIN `destination_container_depot` ON `destination_city`.`destination_city_id` = `destination_container_depot`.`destination_city_id`
    WHERE `city_id`=".$city_id;
    return sendSQL($sql);
}

/**
 * 1.資料庫OceanExportPrice 目的港港口資訊查詢國家id
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectOceanExportPriceDestinationPort($country_id){
    $sql="SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
WHERE `destination_port`.`country_id` = ".$country_id." 
GROUP BY `destination_port`.`destination_port_english`
ORDER BY `destination_port`.`destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 目的港港口資訊查詢國家id
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectOceanExportPriceDestinationPortDestination($country_id){
    $sql="SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `destination` ON `destination`.`destination_port_id` = `destination_port`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
WHERE `destination_port`.`country_id` = ".$country_id." 
GROUP BY `destination_port`.`destination_port_english`
ORDER BY `destination_port`.`destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 查詢目的港id
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港港口id
 * 
 * @return array
 */
function sqlSelectDestinationPortId($id){
    $sql="SELECT * FROM `destination_port` WHERE `destination_port_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationPort 目的港國家港口按照國家英文排序且同個國家只出現一筆
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectDestinationPortGroupByCountryId(){
    $sql = "SELECT *
        FROM `destination_port` 
        INNER JOIN `country` ON `destination_port`.`country_id` = `country`.`country_id`
        WHERE `destination_port`.`country_id`!=0  AND `destination_port_del` = 0
        GROUP BY `destination_port`.`country_id`
        ORDER BY `country`.`country_english`";
    return sendSQL($sql);
}


/**
 * 1.資料庫DestinationPort 目的港國家港口查詢國家跟港口
 *
 * @author Peter Chang
 * 
 * @param string $country 國家英文
 * 
 * @param string $destination_port_english 目的港英文
 * 
 * @return array
 */
function sqlSelectDestinationPortCountryEnglishDestinationPortEnglish($country,$destination_port_english){
    $sql = "SELECT *
        FROM `destination_port` 
        INNER JOIN `country` ON `destination_port`.`country_id` = `country`.`country_id`
        WHERE `country`.`country_english` LIKE '".$country."' AND
        `destination_port_english` LIKE '".$destination_port_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationPort 修改目的港將海運報價的id先全部變為刪除
 *
 * @author Peter Chang
 * 
 * @param integer $country_id
 * 
 * @return array
 */
function sqlUpdateDestinationPortDestinationPortDelDelete($country_id){
    $sql = "UPDATE `destination_port` SET `destination_port_del` = 1
        WHERE `country_id` = ".$country_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationPort 修改目的港將海運報價的id先全部變為刪除
 *
 * @author Peter Chang
 * 
 * @param integer $destination_port_id
 * 
 * @return array
 */
function sqlUpdateDestinationPortDestinationPortNotDel($destination_port_id,$port_code){
    $sql = "UPDATE `destination_port` SET `destination_port_del` = 0,`port_code`='".$port_code."'
        WHERE `destination_port_id` = ".$destination_port_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Department 查詢部門所有資料
 *
 * @author Peter Chang
 *
 * @return array
 */
function sqlSelectDepartment(){
    $sql="SELECT * FROM `department` ORDER BY `department_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫Department 查詢部門名稱相關文字
 *
 * @author Peter Chang
 *
 * @param string $value 部門名稱
 * 
 * @return array
 */
function sqlSelectDepartmentDepartment($value){
    $sql="SELECT * FROM `department` WHERE `department` LIKE '".$value."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫Position 查詢職位所有資料
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectPosition(){
    $sql="SELECT * FROM `position` ORDER BY `position_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫StaffState 查詢員工狀態
 *
 * @author Peter Chang
 *
 * @return array
 */
function sqlSelectStaffState(){
    $sql="SELECT * FROM `staff_state` ORDER BY `staff_state_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫StaffList 查詢單個員工個人資料將部門及職位一起顯示
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港港口id
 * 
 * @return array
 */
function sqlSelectStaffListStaffId($id){
    $sql="SELECT *,
    GROUP_CONCAT(DISTINCT `department`.`department` SEPARATOR ';') AS `department`,
    GROUP_CONCAT(DISTINCT `department`.`department_id` SEPARATOR ';') AS `department_id` 
    FROM `staff_list`
    INNER JOIN `staff_list_department` ON `staff_list`.`staff_id` = `staff_list_department`.`staff_id`
    INNER JOIN `department` ON `staff_list_department`.`department_id` = `department`.`department_id`
    INNER JOIN `position` ON `staff_list`.`position_id` = `position`.`position_id`
    WHERE `staff_list`.`staff_id`=".$id."
    GROUP BY `staff_list`.`staff_id`";
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 新增國家英文
 *
 * @author Peter Chang
 *
 * @param string $country_english 國家英文
 * 
 * @return array
 */
function sqlInsertCountryCountryEnglish($country_english){
    $sql = "INSERT INTO `country`(`country_english`)VALUES('".$country_english."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 修改國家海運報價id
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return array
 */
function sqlUpdateCountryOceanExportId($country_id,$ocean_export_id){
    $sql = "UPDATE `country` SET `ocean_export_id` = ".$ocean_export_id." WHERE `country_id` = ".$country_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫StaffAccountList 新增員工帳戶
 *
 * @author Peter Chang
 *
 * @param integer $id 員工id
 * 
 * @param string $username 員工帳號
 * 
 * @param string $password 員工密碼
 * 
 * @return array
 */
function sqlInsertStaffAccountList($id,$username,$password){
    $sql = "INSERT INTO `staff_account_list`(`staff_id`,`username`, `password`)
    VALUES('".$id."','".$username."','".$password."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫StaffList 員工資訊查詢該員工修改員工狀態
 *
 * @author Peter Chang
 *
 * @param integer $staff_id 員工id
 * 
 * @param integer $staff_state_id 員工狀態id
 * 
 * @return array
 */
function sqlUpdateStaffListStaffStateId($staff_id,$staff_state_id){
    $sql="UPDATE `staff_list` SET `staff_state_id`=".$staff_state_id."
    WHERE `staff_id` =".$staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫StaffAccountList 若員工為離職或留職停薪則刪除該帳戶
 *
 * @author Peter Chang
 *
 * @param integer $id 員工id
 * 
 * @return array
 */
function sqlDeleteStaffAccountListStaffId($id){
    $sql = "DELETE FROM `staff_account_list` WHERE `staff_id` =".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 查詢訂艙流水編號最新一筆
 *
 * @author Peter Chang
 *
 * @param string $head 流水編號的頭
 * 
 * @param string $number 流水編號的年份月第幾筆
 * 
 * @return array
 */
function sqlSelectBookingOrderCountSerial($head,$number){
    $sql = "SELECT * FROM `booking_order` 
    WHERE `serial_head`='".$head."' AND `serial_number` LIKE '".$number."%' 
    ORDER BY `serial_number` DESC LIMIT 0,1";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 新增註冊帳號及驗證碼紀錄用於註冊帳號
 *
 * @author Peter Chang
 *
 * @param string $username 會員使用者帳號
 * 
 * @param string $verification_code 驗證碼
 * 
 * @return array
 */
function sqlInsertMemberLogRegisterUsername($username,$verification_code){
    $sql = "INSERT INTO `member_log`(`register_username`, `verification_code`,`frequency`,`pass`) VALUES ('".$username."','".$verification_code."',0,0)";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 新增會員id及驗證碼紀錄用於修改密碼
 *
 * @author Peter Chang
 *
 * @param integer $member_id 會員id
 * 
 * @param string $verificaion_code 驗證碼
 * 
 * @return array
 */
function sqlInsertMemberLog($member_id,$verification_code){
    $sql = "INSERT INTO `member_log`(`member_id`, `verification_code`,`frequency`,`pass`) VALUES (".$member_id.",'".$verification_code."',0,0)";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 查詢該會員Log最新第一筆紀錄
 *
 * @author Peter Chang
 *
 * @param integer $member_id 會員id
 * 
 * @return array
 */
function sqlSelectMemberLogMemberId($member_id){
    $sql = "SELECT * FROM `member_log` WHERE `member_id` = ".$member_id." ORDER BY `create_time` DESC LIMIT 0,1";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 查詢會員Log註冊帳號的最新第一筆紀錄
 *
 * @author Peter Chang
 *
 * @param string $username 註冊帳號
 * 
 * @return array
 */
function sqlSelectMemberLogRegisterUsername($username){
    $sql = "SELECT * FROM `member_log` WHERE `register_username` = '".$username."' ORDER BY `create_time` DESC LIMIT 0,1";
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 查詢會員Log紀錄修改已經錯誤的次數
 *
 * @author Peter Chang
 *
 * @param integer $id 會員Log的id
 * 
 * @param integer $frequency 驗證錯誤次數
 * 
 * @return array
 */
function sqlUpdateMemberLogFrequency($id,$frequency){
    $sql = "UPDATE `member_log` SET `frequency` = ".$frequency." WHERE `member_log_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫MemberLog 查詢會員Log的id修改此紀錄為正確
 *
 * @author Peter Chang
 *
 * @param integer $id 會員Log的id
 * 
 * @param integer $pass 會員紀錄狀態
 * 
 * @return array
 */
function sqlUpdateMemberLogPass($id,$pass){
    $sql = "UPDATE `member_log` SET `pass` = ".$pass." WHERE `member_log_id` =".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Marquee 最新跑馬燈資料
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectMarqueeExportFirst(){
    $sql = "SELECT * FROM `marquee` ORDER BY `create_time` DESC LIMIT 0,1";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport查尋海運報價id
 *
 * @author Peter Chang
 *
 * @param integer $id 海運報價id
 * 
 * @return array
 */
function sqlSelectOceanExportId($id){
    $sql = "SELECT * FROM `ocean_export` WHERE `ocean_export_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport查尋地區id全部的國家id
 *
 * @author Peter Chang
 *
 * @param integer $id 海運報價id
 * 
 * @return array
 */
function sqlSelectOceanExportInnerCountryDestinationPortOceanExportId($id){
    $sql = "SELECT * 
    FROM `ocean_export` 
    INNER JOIN `country` ON `country`.`ocean_export_id`=`ocean_export`.`ocean_export_id`
    INNER JOIN `destination_port` ON `destination_port`.`country_id`=`country`.`country_id`
    WHERE `ocean_export`.`ocean_export_id` = ".$id." AND `destination_port`.`destination_port_del`=0
    GROUP BY `country`.`country_english`
    ORDER BY `country`.`country_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport查尋海運報價及期限id
 *
 * @author Peter Chang
 *
 * @param integer $id 海運報價id
 * 
 * @return array
 */
function sqlSelectOceanExportInnerOceanExportDateDeadlineOceanExportId($id,$shipment_type){
    $sql = "SELECT * 
    FROM `ocean_export`
    INNER JOIN `ocean_export_date_deadline` ON `ocean_export`.`ocean_export_id`=`ocean_export_date_deadline`.`ocean_export_id`
    WHERE `ocean_export`.`ocean_export_id` = ".$id." AND
    `ocean_export_date_deadline`.`shipment_type` LIKE '".$shipment_type."'
    ORDER BY `ocean_export_date_deadline`.`create_time` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport用目的港查尋期限id
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港id
 * 
 * @return array
 */
function sqlSelectOceanExportDateDeadlineDestinationPortId($id,$shipment_type){
    $sql = " SELECT * 
    FROM `ocean_export_date_deadline` 
    INNER JOIN `ocean_export` ON `ocean_export`.`ocean_export_id`=`ocean_export_date_deadline`.`ocean_export_id`
    INNER JOIN `country` ON `country`.`ocean_export_id`=`ocean_export`.`ocean_export_id`
    INNER JOIN `destination_port` ON `destination_port`.`country_id`=`country`.`country_id`
    WHERE `destination_port`.`destination_port_id` = ".$id." AND
    `ocean_export_date_deadline`.`shipment_type` LIKE '".$shipment_type."' AND 
    `ocean_export_date_deadline`.`create_time` IN (
    SELECT max(`ocean_export_date_deadline`.`create_time`) 
    FROM `ocean_export_date_deadline`
    INNER JOIN `ocean_export` ON `ocean_export`.`ocean_export_id`=`ocean_export_date_deadline`.`ocean_export_id`
    INNER JOIN `country` ON `country`.`ocean_export_id`=`ocean_export`.`ocean_export_id`
    INNER JOIN `destination_port` ON `destination_port`.`country_id`=`country`.`country_id`
    WHERE `destination_port`.`destination_port_id` = ".$id." AND
    `ocean_export_date_deadline`.`shipment_type` LIKE '".$shipment_type."')
    GROUP BY `ocean_export_date_deadline`.`ocean_export_id`
    ORDER BY `ocean_export_date_deadline`.`create_time` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport用目的港查尋期限id
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectOceanExportDateDeadlineShipmentTypeCFS(){
    $sql = "SELECT * 
    FROM `ocean_export_date_deadline` 
    INNER JOIN `ocean_export` ON `ocean_export`.`ocean_export_id`=`ocean_export_date_deadline`.`ocean_export_id`
    WHERE `ocean_export_date_deadline`.`shipment_type` LIKE 'CFS'
    GROUP BY `ocean_export_date_deadline`.`ocean_export_id`
    ORDER BY `ocean_export_date_deadline`.`create_time` DESC";
    return sendSQL($sql);
}

/**
 * 1.資料庫OceanExport 依照報價路線排序
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectOceanExportOrderByQuoteRoute(){
    $sql = "SELECT * FROM `ocean_export` ORDER BY `ocean_quote_sort`";
    return sendSQL($sql);
}

/**
 * 1.資料庫Marquee 後台預設Select資料
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectMarqueeExportDefaultSelect(){
    $sql = "SELECT * FROM `marquee` WHERE `default_select` = 1 ORDER BY `create_time` DESC LIMIT 0,1";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 目的港國家港口查詢海運航線的國家
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectOceanExportPriceAllDestinationCountry(){
    $sql = "SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
GROUP BY `country`.`country_english`
ORDER BY `country`.`country_english` ASC,`destination_port`.`destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 目的港國家港口查詢海運航線的國家
 *
 * @author Peter Chang
 * 
 * @param string $ocean_export_id 海運航線id
 * 
 * @return array
 */
function sqlSelectOceanExportPriceDestinationCountry($ocean_export_id){
    $sql = "SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
WHERE `ocean_export_price`.`ocean_export_id` = ".$ocean_export_id."
GROUP BY `country`.`country_english`
ORDER BY `country`.`country_english` ASC,`destination_port`.`destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價費用查詢
 *
 * @author Peter Chang
 * 
 * @param integer $destination_port_id 目的港id
 * 
 * @param integer $cut_off_place_id 結關地點的id
 * 
 * @return array
 */
function sqlSelectOceanExportPriceDestinationPortIdCutOffId($destination_port_id,$cut_off_place_id){
    $sql = "SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `ocean_export_price`.`cut_off_place_id`
INNER JOIN `cabinet_volume` ON `cabinet_volume`.`cabinet_volume_id` = `ocean_export_price`.`cabinet_volume_id`
WHERE `ocean_export_price`.`destination_port_id` = ".$destination_port_id." AND 
        `ocean_export_price`.`cut_off_place_id` = ".$cut_off_place_id."
ORDER BY `cut_off_place`.`cut_off_place_id` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價費用查詢
 *
 * @author Peter Chang
 * 
 * @param integer $destination_port_id 目的港id
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地點的id
 * 
 * @return array
 */
function sqlSelectOceanExportPriceDestinationPortIdCutOffIdCabinetVolumeId($destination_port_id,$cabinet_volume_id,$cut_off_place_id){
    $sql = "SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `ocean_export_price`.`cut_off_place_id`
INNER JOIN `cabinet_volume` ON `cabinet_volume`.`cabinet_volume_id` = `ocean_export_price`.`cabinet_volume_id`
WHERE `ocean_export_price`.`destination_port_id` = ".$destination_port_id." AND 
        `ocean_export_price`.`cabinet_volume_id` = ".$cabinet_volume_id." AND
        `ocean_export_price`.`cut_off_place_id` = ".$cut_off_place_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價費用全部國家查詢
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCFSOceanPriceAllDestinationCountry(){
    $sql = "SELECT * FROM `cfs_ocean_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `cfs_ocean_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `cfs_ocean_price`.`cut_off_place_id`
GROUP BY `country`.`country_english`
ORDER BY `country`.`country_english` ASC";
    return sendSQL($sql);
}
?>
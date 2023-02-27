<?php
/**
 * 1.資料庫BookingOrder的id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @return array
 */
function sqlSelectBookingOrderId($id){
	$sql = "SELECT `booking_order`.*,
    `destination`.*,
    `cfs_quantity_unit`.*,
    `destination_port`.*,
    `destination_container_depot`.*,
    `country`.`country_id` AS `destination_container_depot_country_id`,
    `destination_port`.`country_id` AS `destination_port_country_id`,
    `member`.`username`,`member`.`tax_id_number`,`member`.`contact_email` AS `current_contact_email`,
    `member`.`gender`
    FROM `booking_order` 
    INNER JOIN `member` ON `booking_order`.`member_id` = `member`.`member_id`
    INNER JOIN `destination` ON `booking_order`.`destination_id` = `destination`.`destination_id`
    LEFT JOIN `cfs_quantity_unit` ON `booking_order`.`cfs_quantity_unit_id` = `cfs_quantity_unit`.`cfs_quantity_unit_id`
    LEFT JOIN `destination_port` ON `destination`.`destination_port_id` = `destination_port`.`destination_port_id`
    LEFT JOIN `destination_container_depot` ON `destination`.`destination_container_depot_id` = `destination_container_depot`.`destination_container_depot_id`
    LEFT JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
    LEFT JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
    LEFT JOIN `country` ON `city`.`country_id` = `country`.`country_id`
    WHERE `booking_order`.`booking_order_id` = ".$id;
	return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder的會員id資料，用為會員下單顯示查詢的資料
 * 2.用建立訂單時間來排序
 *
 * @author Peter Chang
 *
 * @param integer $id 會員id的資料
 * 
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @param integer|boolean $start 第幾筆開始
 * 
 * @param integer|boolean $per 顯示筆數
 * 
 * @param string 接收資訊的狀態
 * 
 * @return array
 */
function sqlSelectBookingOrderMemberIdList($id,$search_fields,$start,$per,$state){
    $limit=getSQLLimitStartEnd($start,$per);
    $sql="SELECT `booking_order`.*,
    `destination`.*,
    `cfs_quantity_unit`.*,
    `destination_port`.*,
    `destination_container_depot`.*,
    `country`.`country_id` AS `destination_container_depot_country_id`,
    `destination_port`.`country_id` AS `destination_port_country_id`
    FROM `booking_order` 
    INNER JOIN `destination` ON `booking_order`.`destination_id` = `destination`.`destination_id`
    LEFT JOIN `cfs_quantity_unit` ON `booking_order`.`cfs_quantity_unit_id` = `cfs_quantity_unit`.`cfs_quantity_unit_id`
    LEFT JOIN `destination_port` ON `destination`.`destination_port_id` = `destination_port`.`destination_port_id`
    LEFT JOIN `destination_container_depot` ON `destination`.`destination_container_depot_id` = `destination_container_depot`.`destination_container_depot_id`
    LEFT JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
    LEFT JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
    LEFT JOIN `country` ON `city`.`country_id` = `country`.`country_id`
    WHERE `booking_order`.`member_id` = ".$id;
    $sql=getBookingOrderSqlSearchWhere($sql,$search_fields,$state);
    $sql.= " ORDER BY `booking_order`.`create_time` DESC ".$limit;
	return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder的會員id資料，用為會員下單顯示查詢的資料
 * 2.用建立訂單時間來排序
 * 3.為員工查看會員以月來算下過幾筆訂單，因先上線故未完成
 *
 * @author Peter Chang
 *
 * @param integer $id 會員id的資料
 * 
 * @return array
 */
function sqlSelectBookingOrderMemberId($id){
    $sql="SELECT *
    FROM `booking_order` 
    INNER JOIN `destination` ON `booking_order`.`destination_id` = `destination`.`destination_id`
    WHERE `booking_order`.`member_id` = ".$id;
    $sql.= " ORDER BY `booking_order`.`create_time` DESC ";
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder的會員id資料，搜尋下幾筆資料
 * 2.用建立訂單時間來排序
 * 3.為員工查看會員以月來算下過幾筆訂單，因先上線故未完成
 *
 * @author Peter Chang
 *
 * @param integer $id 會員id的資料
 * 
 * @return array
 */
function sqlSelectBookingOrderBookingOrderStatisticsMemberId($id){
    $sql="SELECT count(`member_id`) as `booking_order_statistics`
    FROM `booking_order` 
    WHERE `member_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder的查詢該步驟編碼，且該員工為該服務人員的資料
 * 2.用建立訂單時間來排序
 *
 * @author Peter Chang
 *
 * @param integer $staff_id 員工id的資料
 * 
 * @param integer $schedule 步驟編碼
 * 
 * @return array
 */
function sqlSelectBookingOrderCsDocFinancialStaffId($staff_id,$schedule){
    $staff_sql=getBookingOrderDepartmentStaffIdSql($schedule);
    $sql="SELECT `booking_order`.*,
    `destination_port`.`country_id`,`destination_port`.`destination_port_english`
    FROM `booking_order` 
    INNER JOIN `destination` ON `booking_order`.`destination_id` = `destination`.`destination_id`
    INNER JOIN `country` ON `destination_port`.`country_id` = `country`.`country_id`
    WHERE `booking_order`.`".$staff_sql."staff_id` = ".$staff_id." AND 
    `booking_order`.`schedule` = ".$schedule."
    ORDER BY `booking_order`.`create_time` DESC ";
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder的查詢目的地id
 *
 * @author Peter Chang
 *
 * @param integer $id 目的地id
 * 
 * @return array
 */
function sqlSelectBookingOrderDestinationId($id){
    $sql="SELECT *
    FROM `booking_order` 
    INNER JOIN `destination` ON `booking_order`.`destination_id` = `destination`.`destination_id`
    WHERE `destination`.`destination_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 員工查詢會員下訂艙資料
 * 2.用建立訂單時間來排序
 *
 * @author Peter Chang
 *
 * @param array $search_fields 使用者搜尋的資料
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return array
 */
function sqlSelectStaffBookingOrderSchedule($search_fields,$start,$per){
    $limit=getSQLLimitStartEnd($start,$per);
    $sql="SELECT `booking_order`.*,
    `destination_port`.*,
    `cfs_quantity_unit`.*,
    `destination_container_depot`.*,
    `country`.`country_id` AS `destination_container_depot_country_id`,
    `destination_port`.`country_id` AS `destination_port_country_id`,
    `member`.`username`,`member`.`tax_id_number`
    FROM `booking_order` 
    INNER JOIN `member` ON `booking_order`.`member_id` = `member`.`member_id`
    INNER JOIN `destination` ON `booking_order`.`destination_id` = `destination`.`destination_id`
    LEFT JOIN `cfs_quantity_unit` ON `booking_order`.`cfs_quantity_unit_id` = `cfs_quantity_unit`.`cfs_quantity_unit_id`
    LEFT JOIN `destination_port` ON `destination`.`destination_port_id` = `destination_port`.`destination_port_id`
    LEFT JOIN `destination_container_depot` ON `destination`.`destination_container_depot_id` = `destination_container_depot`.`destination_container_depot_id`
    LEFT JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
    LEFT JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
    LEFT JOIN `country` ON `city`.`country_id` = `country`.`country_id`
    WHERE 1 ";
    $sql=getStaffBookingOrderSqlSearchWhere($sql,$search_fields);
    $sql.= " ORDER BY `booking_order`.`create_time` DESC ".$limit;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 員工下訂艙新增資料
 *
 * @author Peter Chang
 *
 * @param array $member_array 該下訂艙會員基本資料
 * 
 * @param array $data_array FROM表單POST的資料
 * 
 * @return array
 */
function sqlInsertBookingOrder($member_array,$data_array){
    $data_array['volume']=getDataZeroTransferNullSaveSql($data_array['volume']);
    $data_array['cfs_quantity_unit_id']=getDataZeroTransferNullSaveSql($data_array['cfs_quantity_unit_id']);
    $sql = "INSERT INTO `booking_order`(`serial_head`,`serial_number`,`shipment_type`,
    `member_id`,`company_chinese`, `contact_name`, `contact_company_phone`,
    `contact_company_extension`, `contact_company_fax`,
    `contact_email`,`purchase_order_no`,
    `lc_no`, `hs_code`, `cargo_weight`,
    `dangerous_goods`,`class`,`un_no`,
    `volume`,`cabinet_volume`,`cfs_quantity_unit_id`,
    `terms_of_trade`,`terms_of_trade_remark`,
    `cut_off_place_id`,`destination_id`,`ocean_export_price_data`,
    `goods_date`, `cut_off_date`,`onboard_date`,
    `remark`,`trading`,`schedule`,`attachments`) VALUES (
    '".$data_array['serial_head']."',".$data_array['serial_number'].",'".$data_array['shipment_type']."',
    '".$member_array['member_id']."','".$data_array['company_chinese']."',
    '".$data_array['contact_name']."',
    '".$data_array['contact_company_phone']."',
    '".$data_array['contact_company_extension']."',
    '".$data_array['contact_company_fax']."',
    '".$data_array['contact_email']."',
    '".$data_array['purchase_order_no']."',
    '".$data_array['lc_no']."','".$data_array['hs_code']."','".$data_array['cargo_weight']."',
    '".$data_array['dangerous_goods']."','".$data_array['class']."','".$data_array['un_no']."',
    ".$data_array['volume'].",'".$data_array['cabinet_volume']."',".$data_array['cfs_quantity_unit_id'].",
    '".$data_array['terms_of_trade']."','".$data_array['terms_of_trade_remark']."',
    '".$data_array['cut_off_place_id']."','".$data_array['destination_id']."','".$data_array['ocean_export_price_data']."',
    '".$data_array['goods_date']."','".$data_array['cut_off_date']."',
    '".$data_array['onboard_date']."','".$data_array['remark']."',
    '".$data_array['trading']."',1,'".$data_array['attachments']."')";
    return sendSQL($sql,true);
}
/**
 * 1.資料庫Destinaion 修改Destinaionid資料
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港id
 * 
 * @param integer $destinaion_id 修改的目的地id
 * 
 * @return array
 */
function sqlUpdateBookingOrderDestinationId($id,$destination_id){
    $sql = "UPDATE `booking_order` 
    SET `destination_id` = '".$destination_id."'
    WHERE `destination_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 作為修改移交人員使用
 *
 * @author Peter Chang
 *
 * @param integer $schedule 該步驟編碼
 * 
 * @param integer $staff_id 員工id
 * 
 * @param array $array 被移交的客戶訂艙資料為訂艙id
 * 
 * @return array
 */
function sqlUpdateBookingOrderStaffId($schedule,$staff_id,$array){
    $staff_sql=getBookingOrderDepartmentStaffIdSql($schedule);
    $buf=" AND(";
    foreach ($array as $id){
        $buf.=" `booking_order_id` =".$id." OR ";
    }
    $buf=rtrim($buf,"OR ");
    $buf.=")";
    $sql="UPDATE `booking_order` SET `".$staff_sql."staff_id` = ".$staff_id."
    WHERE `schedule` = ".$schedule.$buf;
    return sendSQL($sql);
}


/**
 * 1.資料庫BookingOrder 客服部第一次上傳S/O檔案及日期
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $cs_staff_id 客服部員工id
 * 
 * @param string $cut_off_date 為結關日
 * 
 * @param string $onboard_date 為開航日
 * 
 * @param string $date 為S/O上傳日
 * 
 * @param string $so 為S/O檔案
 * 
 * @param string $attchment 為S/O其他附檔
 * 
 * @return array
 */
function sqlUpdateBookingOrderCsStaffDateCsStaffAttchment($id,$cs_staff_id,$cut_off_date,$onboard_date,$date,$so,$attchment){
    $sql = "UPDATE `booking_order` 
    SET `cut_off_date` = '".$cut_off_date."',
    `onboard_date` = '".$onboard_date."',
    `cs_staff_date` = '".$date."',
    `cs_staff_attachment` = '".$attchment."',
    `so_attachment` = '".$so."'
    WHERE `booking_order_id` = ".$id." AND `cs_staff_id` = ".$cs_staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 客服部修改S/O日期及檔案
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $cs_staff_id 客服部員工id
 * 
 * @param string $date 為S/O上傳日
 * 
 * @param string $so 為S/O檔案
 * 
 * @return array
 */
function sqlUpdateBookingOrderCsStaffDateSoAttachment($id,$cs_staff_id,$date,$so){
    $sql = "UPDATE `booking_order` 
    SET `cs_staff_date` = '".$date."',
    `so_attachment` = '".$so."'
    WHERE `booking_order_id` = ".$id." AND `cs_staff_id` = ".$cs_staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 客服部修改開航日或結關日
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $staff_id 員工id
 * 
 * @param string $date 為結關日或開航日
 * 
 * @param string $sql_name 為結關日或開航日的sql名稱
 * 
 * @return array
 */
function sqlUpdateBookingOrderCsStaffDateCutOffDateOnBoardDate($id,$staff_id,$date,$sql_name){
    $sql = "UPDATE `booking_order` 
    SET `".$sql_name."` = '".$date."'
    WHERE `booking_order_id` = ".$id." AND 
    `doc_staff_id`=0 AND 
    `cs_staff_id` = ".$staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 文件部第一次上傳提單及帳單檔案及日期
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $doc_staff_id 文件部員工id
 * 
 * @param string $date 為提單上傳日
 * 
 * @param string $bill_of_lading 為提單核對檔案
 * 
 * @param string $receive_bill 為帳單檔案
 * 
 * @param string $attchment 為文件其他附檔
 * 
 * @return array
 */
function sqlUpdateBookingOrderDocStaffDateDocBillReceiveAttachment($id,$doc_staff_id,$date,$bill_of_lading,$receive_bill,$attchment){
    $sql = "UPDATE `booking_order` 
    SET `doc_staff_date` = '".$date."',
    `bill_of_lading_attachment` = '".$bill_of_lading."',
    `receive_bill_attachment` = '".$receive_bill."',
    `doc_staff_attachment` = '".$attchment."'
    WHERE `booking_order_id` = ".$id." AND `doc_staff_id` = ".$doc_staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 文件部重新上傳提單及帳單檔案及日期
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $doc_staff_id 文件部員工id
 * 
 * @param string $date 為提單上傳日
 * 
 * @param string $bill_of_lading 為提單核對檔案
 * 
 * @param string $receive_bill 為帳單檔案
 * 
 * @return array
 */
function sqlUpdateBookingOrderDocStaffDateBillReceiveAttachment($id,$doc_staff_id,$date,$bill_of_lading,$receive_bill){
    $sql = "UPDATE `booking_order` 
    SET `doc_staff_date` = '".$date."',
    `bill_of_lading_attachment` = '".$bill_of_lading."',
    `receive_bill_attachment` = '".$receive_bill."'
    WHERE `booking_order_id` = ".$id." AND `doc_staff_id` = ".$doc_staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 文件部修改開航日或結關日，會將文件日期及附檔清空
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $staff_id 員工id
 * 
 * @param string $date 為結關日或開航日
 * 
 * @param string $sql_name 為結關日或開航日的sql名稱
 * 
 * @return array
 */
function sqlUpdateBookingOrderDocStaffDateCutOffDateOnBoardDate($id,$staff_id,$date,$sql_name){
    $sql = "UPDATE `booking_order` 
    SET `".$sql_name."` = '".$date."',
    `doc_staff_date` ='',
    `doc_staff_attachment` ='',
    `bill_of_lading_attachment` ='',
    `receive_bill_attachment` =''
    WHERE `booking_order_id` = ".$id." AND 
    `financial_staff_id`=0 AND 
    `doc_staff_id` = ".$staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 財務部收到款項
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $financial_staff_id 財務部員工id
 * 
 * @param string $date 為上傳日期
 * 
 * @param string $attchment 目前財務部上傳檔案，但先留著
 * 
 * @return array
 */
function sqlUpdateBookingOrderFinancialStaffDate($id,$financial_staff_id,$date,$attchment){
    $sql = "UPDATE `booking_order` SET `financial_staff_date` = '".$date."',
    `financial_staff_attachment` = '".$attchment."'
    WHERE `booking_order_id` = ".$id."  AND `financial_staff_id` = ".$financial_staff_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 結案日期
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $staff_id 結案人員員工id
 * 
 * @param string $date 為結案日期
 * 
 * @return array
 */
function sqlUpdateBookingOrderCaseClosedStaffDate($id,$staff_id,$date){
    $sql = "UPDATE `booking_order` SET `case_closed_date` = '".$date."',
    `schedule`=6,`case_closed_staff_id` = ".$staff_id."
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 修改該訂艙步驟編碼
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param string $schedule 該步驟編碼
 * 
 * @return array
 */
function sqlUpdateBookingOrderSchedule($id,$schedule){
    $sql = "UPDATE `booking_order` SET `schedule` = ".$schedule." 
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 客服部成為該訂艙服務人員
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $staff_id 客服員工id
 * 
 * @param string $schedule 該步驟編碼
 * 
 * @return array
 */
function sqlUpdateStaffBookingOrderCsStaffIdSchedule($id,$staff_id,$schedule){
    $sql = "UPDATE `booking_order` SET `schedule` = ".$schedule.",
    `cs_staff_id` = ".$staff_id." 
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 文件部成為該訂艙服務人員
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $doc_staff_id 客服員工id
 * 
 * @return array
 */
function sqlUpdateStaffBookingOrderDocStaffId($id,$staff_id){
    $sql = "UPDATE `booking_order` SET `doc_staff_id` = ".$staff_id." 
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 財務部成為該訂艙收款人員
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $staff_id 客服員工id
 * 
 * @return array
 */
function sqlUpdateStaffBookingOrderFinancialStaffId($id,$staff_id){
    $sql = "UPDATE `booking_order` SET `financial_staff_id` = ".$staff_id." 
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 修改客人訂艙附檔
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param string $attachments 訂艙附檔
 * 
 * @return array
 */
function sqlUpdateBookingOrderAttachments($id,$attachments){
    $sql = "UPDATE `booking_order` SET `attachments` = '".$attachments."' 
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 將訂艙文件回復成客服步驟
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $schedule 該步驟的編碼
 * 
 * @return array
 */
function sqlUpdateBookingOrderDocReplyCsSchedule($id,$schedule){
    $sql = "UPDATE `booking_order` 
    SET `schedule`=".$schedule.",
    `doc_staff_id`=0
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 將訂艙財務回復成文件步驟
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $schedule 該步驟的編碼
 * 
 * @return array
 */
function sqlUpdateBookingOrderFinancialReplyDocSchedule($id,$schedule){
    $sql = "UPDATE `booking_order` 
    SET `schedule`=".$schedule.",
    `financial_staff_id`=0
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 將訂艙未結案回復成財務步驟
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @return array
 */
function sqlUpdateBookingOrderCasedCloseReplyFinancialSchedule($id){
    $sql = "UPDATE `booking_order` 
    SET `schedule`=4,
    `financial_staff_id`=0,
    `financial_staff_date`=NULL
    WHERE `booking_order_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫BookingOrder 將客戶修改訂艙資訊
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param array $data_array 為FORM POST的會員訂艙資訊
 * 
 * @return array
 */
function sqlUpdateBookingOrder($id,$data_array){
    $data_array['volume']=getDataZeroTransferNullSaveSql($data_array['volume']);
    $data_array['cfs_quantity_unit_id']=getDataZeroTransferNullSaveSql($data_array['cfs_quantity_unit_id']);
    $sql = "UPDATE `booking_order` SET 
    `company_chinese`='".$data_array['company_chinese']."', 
    `contact_name`='".$data_array['contact_name']."',
    `contact_company_phone`='".$data_array['contact_company_phone']."',
    `contact_company_extension`='".$data_array['contact_company_extension']."',
    `contact_company_fax`='".$data_array['contact_company_fax']."',
    `contact_email`='".$data_array['contact_email']."',
    `purchase_order_no`='".$data_array['purchase_order_no']."',
    `lc_no`='".$data_array['lc_no']."',
    `hs_code`='".$data_array['hs_code']."',
    `cargo_weight`='".$data_array['cargo_weight']."',
    `dangerous_goods`='".$data_array['dangerous_goods']."',
    `class`='".$data_array['class']."',
    `un_no`='".$data_array['un_no']."',
    `volume`=".$data_array['volume'].",
    `cabinet_volume`='".$data_array['cabinet_volume']."',
    `cfs_quantity_unit_id`=".$data_array['cfs_quantity_unit_id'].",
    `terms_of_trade`='".$data_array['terms_of_trade']."',
    `terms_of_trade_remark`='".$data_array['terms_of_trade_remark']."',
    `cut_off_place_id`='".$data_array['cut_off_place_id']."',
    `destination_id`='".$data_array['destination_id']."',
    `ocean_export_price_data`='".$data_array['ocean_export_price_data']."',
    `goods_date`='".$data_array['goods_date']."',
    `cut_off_date`='".$data_array['cut_off_date']."',
    `onboard_date`='".$data_array['onboard_date']."',
    `remark`='".$data_array['remark']."',
    `attachments`='".$data_array['attachments']."'
    WHERE `booking_order_id` =".$id;
    return sendSQL($sql);
}
?>
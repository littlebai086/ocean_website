<?php
/**
 * 1.資料庫DestinaionPort 列出目的港使用者查詢的資料
 *
 * @author Peter Chang
 *
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @return array
 */
function sqlSelectDestinationPortList($search_fields){
    $sql = "SELECT *
        FROM `destination_port` 
        INNER JOIN `country` ON `destination_port`.`country_id` = `country`.`country_id`
        WHERE `destination_port`.`country_id`!=0";
    $sql=getDestinationPortSqlSearchWhere($sql,$search_fields);
    $sql .= " ORDER BY `country`.`country_english`";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 查詢國家id
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectDestinationPortCountryId($country_id){
    $sql = "SELECT * FROM `destination_port` WHERE `country_id` = ".$country_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 查詢目的港港口英文
 *
 * @author Peter Chang
 * 
 * @param string $destination_port_english 目的港港口英文
 * 
 * @return array
 */
function sqlSelectDestinationPortEnglish($destination_port_english){
    $sql = "SELECT * FROM `destination_port` WHERE `destination_port_english` LIKE '".$destination_port_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 查詢國家id和目的港港口英文
 *
 * @author Peter Chang
 *
 * @param integer country_id 國家id
 * 
 * @param string $destination_port_english 目的港港口英文
 * 
 * @return array
 */
function sqlSelectDestinationPortCoutnryIdDestinationPortEnglish($country_id,$destination_port_english){
	$sql = "SELECT * FROM `destination_port` WHERE `country_id` = ".$country_id." AND `destination_port_english` LIKE '".$destination_port_english."'";
	return sendSQL($sql);
}
/**
 * 1.資料庫DestinationPort 目的港資訊查詢不等於這個id
 *
 * @author Peter Chang
 *
 * @param integer $destination_port_id 目的港id
 * 
 * @return array
 */
function sqlSelectDestinationPortNotDestinationPortId($destination_port_id){
    $sql = "SELECT * FROM `destination_port` WHERE `destination_port_del` = 0 AND `destination_port_id` != ".$destination_port_id."
    ORDER BY `destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationPort 目的港資訊查詢目的港英文及id
 *
 * @author Peter Chang
 *
 * @param integer $destination_port_id 目的港id
 * 
 * @param string $destination_port_english 為目的港英文
 * 
 * @return array
 */
function sqlSelectDestinationPortIdDestinationPortEnglish($destination_port_id,$destination_port_english){
    $sql = "SELECT * FROM `destination_port` WHERE `destination_port_id` != ".$destination_port_id." AND `destination_port_english` LIKE '".$destination_port_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 新增目的港港口資訊
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @param string $destination_port_english 目的港港口英文
 * 
 * @return array
 */
function sqlInsertDestinationPortCountryIdDestinationPortEnglish($country_id,$destination_port_english){
    $sql = "INSERT INTO `destination_port`(`country_id`, `destination_port_english`) VALUES (".$country_id.",'".$destination_port_english."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationPort 新增目的港
 *
 * @author Peter Chang
 *
 * @param array $data_array 目的港新增的資訊
 * 
 * @return array
 */
function sqlInsertDestinationPort($data_array){
    $sql = "INSERT INTO `destination_port`(`country_id`, `destination_port_english`,`port_code`,`port_code_1`) 
    VALUES ('".$data_array['country_id']."',
    '".$data_array['destination_port_english']."',
    '".$data_array['port_code']."',
    '".$data_array['port_code_1']."')";
    return sendSQL($sql,true);
}
/**
 * 1.資料庫DestinationPort 修改目的港資料
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港id
 * 
 * @param array $data_array 目的港修改的資訊
 * 
 * @return array
 */
function sqlUpdateDestinationPort($id,$data_array){
    $sql = "UPDATE `destination_port` 
    SET `country_id` = '".$data_array['country_id']."',
    `destination_port_english` = '".$data_array['destination_port_english']."',
    `port_code` = '".$data_array['port_code']."',
    `port_code_1` = '".$data_array['port_code_1']."'
    WHERE `destination_port_id` = ".$id;
    return sendSQL($sql);
}

/**
 * 1.資料庫DestinaionPort 修改國家id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 國家id
 * 
 * @param integer $country_id 修改的國家id
 * 
 * @return array
 */
function sqlUpdateDestinationPortCountryId($id,$country_id){
    $sql = "UPDATE `destination_port` 
    SET `country_id` = '".$country_id."'
    WHERE `country_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 修改DestinaionPortid未刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 修改的目的港id為未刪除
 * 
 * @return array
 */
function sqlUpdateDestinationPortDestinationPortNotDelDestinationPortId($id){
    $sql = "UPDATE `destination_port` SET `destination_port_del`=0 WHERE `destination_port_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 修改DestinaionPortid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 修改的目的港id為刪除
 * 
 * @return array
 */
function sqlUpdateDestinationPortDestinationPortDelDestinationPortId($id){
    $sql = "UPDATE `destination_port` SET `destination_port_del`=1 WHERE `destination_port_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionPort 刪除DestinaionPortid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 刪除目的港id資料
 * 
 * @return array
 */
function sqlDeleteDestinationPortDestinationPortId($id){
    $sql = "DELETE FROM `destination_port` WHERE `destination_port_id`=".$id;
    return sendSQL($sql);
}
?>
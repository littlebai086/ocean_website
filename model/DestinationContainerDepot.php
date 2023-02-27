<?php
/**
 * 1.資料庫DestinationContainerDepot 查詢貨櫃目的地id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 貨櫃目的地id
 * 
 * @return array
 */
function sqlSelectDestinationContainerDepotDestinationContainerDepotId($id){
    $sql = "SELECT *
        FROM `destination_container_depot` 
        INNER JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
        INNER JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
        WHERE `destination_container_depot`.`destination_container_depot_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationContainerDepot 列出貨櫃目的地使用者查詢的資料
 *
 * @author Peter Chang
 *
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @return array
 */
function sqlSelectDestinationContainerDepotList($search_fields){
    $sql = "SELECT *
        FROM `destination_container_depot` 
        INNER JOIN `destination_city` ON `destination_container_depot`.`destination_city_id` = `destination_city`.`destination_city_id`
        INNER JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
        WHERE 1 ";
    $sql=getDestinationContainerDepotSqlSearchWhere($sql,$search_fields);
    $sql .= " ORDER BY `destination_container_depot`.`container_depot_english`";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationContainerDepot 查詢城市目的地id
 *
 * @author Peter Chang
 *
 * @param integer $id 城市目的地id
 * 
 * @return array
 */
function sqlSelectDestinationContainerDepotDestinationCityId($id){
    $sql = "SELECT * FROM `destination_container_depot` 
    WHERE `destination_city_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationContainerDepot 目的地資料查詢未刪除
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectDestinationContainerDepotDestinationContainerDepotNotDelDestinationContainerDepotId($id){
    $sql = "SELECT * FROM `destination_container_depot` WHERE `destination_container_depot_del` = 0 AND `destination_container_depot_id` != ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationContainerDepot 目的地貨櫃資料查詢貨櫃英文
 *
 * @author Peter Chang
 * 
 * @param string $container_depot_english 貨櫃英文
 * 
 * @return array
 */
function sqlSelectDestinationContainerDepotEnglish($container_depot_english){
    $sql = "SELECT * FROM `destination_container_depot` WHERE `container_depot_english` LIKE '".$container_depot_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionContainerDepot 新增貨櫃目的地資料
 *
 * @author Peter Chang
 *
 * @param array $data_array 貨櫃目的地資料儲存
 * 
 * @return array
 */
function sqlInsertDestinationContainerDepot($data_array){
    $sql = "INSERT INTO `destination_container_depot`(`destination_city_id`, `container_depot_english`) VALUES ('".$data_array['destination_city_id']."','".$data_array['container_depot_english']."')";
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
function sqlUpdateDestinationContainerDepot($id,$data_array){
    $sql = "UPDATE `destination_container_depot` 
    SET `destination_city_id` = '".$data_array['destination_city_id']."',
    `container_depot_english` = '".$data_array['container_depot_english']."'
    WHERE `destination_container_depot_id` = ".$id;
    return sendSQL($sql);
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
function sqlUpdateDestinationContainerDepotDestinationCityId($id,$destination_city_id){
    $sql = "UPDATE `destination_container_depot` 
    SET `destination_city_id` = '".$destination_city_id."'
    WHERE `destination_city_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationPort 修改目的港id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港id
 * 
 * @return array
 */
function sqlUpdateDestinationContainerDepotDelDestinationContainerDepotId($id){
    $sql = "UPDATE `destination_container_depot` 
    SET `destination_container_depot_del` = 1
    WHERE `destination_container_depot_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionContainerDepot 修改DestinaionContainerDepotid未刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 修改的貨櫃目的地id為未刪除
 * 
 * @return array
 */
function sqlUpdateDestinationContainerDepotDestinationContainerDepotNotDelDestinationContainerDepotId($id){
    $sql = "UPDATE `destination_container_depot` SET `destination_container_depot_del`=0 WHERE `destination_container_depot_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionContainerDepot 修改DestinaionContainerDepotid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 修改的貨櫃目的地id為刪除
 * 
 * @return array
 */
function sqlUpdateDestinationContainerDepotDestinationContainerDepotDelDestinationContainerDepotId($id){
    $sql = "UPDATE `destination_container_depot` SET `destination_container_depot_del`=1 WHERE `destination_container_depot_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionContainerDepot 刪除DestinaionContainerDepotid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 刪除貨櫃目的地id資料
 * 
 * @return array
 */
function sqlDeleteDestinationContainerDepotDestinationContainerDepotId($id){
    $sql = "DELETE FROM `destination_container_depot` WHERE `destination_container_depot_id`=".$id;
    return sendSQL($sql);
}

?>
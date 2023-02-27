<?php
/**
 * 1.資料庫DestinationCity 列出目的地城市使用者查詢的資料
 *
 * @author Peter Chang
 *
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @return array
 */
function sqlSelectDestinationCityList($search_fields){
    $sql = "SELECT *
        FROM `destination_city` 
        INNER JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
        INNER JOIN `country` ON `city`.`country_id` = `country`.`country_id`
        WHERE 1";
    $sql=getDestinationCitySqlSearchWhere($sql,$search_fields);
    $sql .= " ORDER BY `country`.`country_english`";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationCity 目的地城市資訊查詢未刪除
 *
 * @author Peter Chang
 *
 * @param integer $destination_city_id 目的港id
 * 
 * @return array
 */
function sqlSelectDestinationCityNotDestinationCityId(){
    $sql = "SELECT * FROM `destination_city` 
    INNER JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
    WHERE `destination_city_del` = 0
    ORDER BY `city`.`city_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinationCity 目的地城市id資訊
 *
 * @author Peter Chang
 *
 * @param integer $id 目的地id
 * 
 * @return array
 */
function sqlSelectDestinationCityDestinationCityId($id){
    $sql = "SELECT * FROM `destination_city` 
    INNER JOIN `city` ON `destination_city`.`city_id` = `city`.`city_id`
    WHERE `destination_city_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionCity 新增DestinaionCityid資料
 *
 * @author Peter Chang
 *
 * @param integer $city_id 新增城市id進目的港id
 * 
 * @return array
 */
function sqlInsertDestinationCityCityId($city_id){
    $sql = "INSERT INTO `destination_city`(`city_id`) VALUES ('".$city_id."')";
    return sendSQL($sql);
}

/**
 * 1.資料庫DestinaionCity 修改DestinaionCityid未刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $city_id 修改的目的港id為位刪除
 * 
 * @return array
 */
function sqlUpdateDestinationCityDestinationCityNotDel($city_id){
    $sql = "UPDATE `destination_city` SET `destination_city_del`=0 WHERE `city_id`=".$city_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionCity 修改DestinaionCityid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $city_id 修改的目的港id為刪除
 * 
 * @return array
 */
function sqlUpdateDestinationCityDestinationCityDel($city_id){
    $sql = "UPDATE `destination_city` SET `destination_city_del`=1 WHERE `city_id`=".$city_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionCity 修改DestinaionCityid未刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 修改的目的地城市id為未刪除
 * 
 * @return array
 */
function sqlUpdateDestinationCityDestinationCityNotDelDestinationCityId($id){
    $sql = "UPDATE `destination_city` SET `destination_city_del`=0 WHERE `destination_city_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionCity 修改DestinaionCityid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 修改的目的地城市id為刪除
 * 
 * @return array
 */
function sqlUpdateDestinationCityDestinationCityDelDestinationCityId($id){
    $sql = "UPDATE `destination_city` SET `destination_city_del`=1 WHERE `destination_city_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DestinaionCity 刪除DestinaionCityid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 刪除目的地城市id資料
 * 
 * @return array
 */
function sqlDeleteDestinationCityDestinationCityId($id){
    $sql = "DELETE FROM `destination_city` WHERE `destination_city_id`=".$id;
    return sendSQL($sql);
}
?>
<?php
/**
 * 1.資料庫City 列出城市使用者查詢的資料
 *
 * @author Peter Chang
 *
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @return array
 */
function sqlSelectCityList($search_fields){
    $sql = "SELECT *
        FROM `city` 
        INNER JOIN `country` ON `city`.`country_id` = `country`.`country_id`
        WHERE 1";
    $sql=getCitySqlSearchWhere($sql,$search_fields);
    $sql .= " ORDER BY `country`.`country_english`";
    return sendSQL($sql);
}
/**
 * 1.資料庫City 查詢國家id
 *
 * @author Peter Chang
 * 
 * @param $country_id 國家id
 * 
 * @return array
 */
function sqlSelectCityCountryId($country_id){
    $sql = "SELECT * FROM `city` WHERE `country_id` = ".$country_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫City 查詢城市英文
 *
 * @author Peter Chang
 * 
 * @param $city_english 城市英文
 * 
 * @return array
 */
function sqlSelectCityEnglish($city_english){
    $sql = "SELECT * FROM `city` WHERE `city_english` LIKE '".$city_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫City 城市資訊查詢不等於這個id
 *
 * @author Peter Chang
 *
 * @param integer $city_id 城市id
 * 
 * @return array
 */
function sqlSelectCityNotCityId($city_id){
    $sql = "SELECT * FROM `city` WHERE `city_del` = 0 AND `city_id` != ".$city_id."
    ORDER BY `city_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫City 城市資訊查詢城市英文及id
 *
 * @author Peter Chang
 *
 * @param integer $city_id 城市id
 * 
 * @param string $city_english 為城市英文
 * 
 * @return array
 */
function sqlSelectCityIdCityEnglish($city_id,$city_english){
    $sql = "SELECT * FROM `city` WHERE `city_id` != ".$city_id." AND `city_english` LIKE '".$city_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫City 新增城市
 *
 * @author Peter Chang
 *
 * @param array $data_array 城市新增的資訊
 * 
 * @return array
 */
function sqlInsertCity($data_array){
    $sql = "INSERT INTO `city`(`country_id`, `city_english`, `city_chinese`, `city_abbreviation`) 
    VALUES ('".$data_array['country_id']."',
    '".$data_array['city_english']."',
    '".$data_array['city_chinese']."',
    '".$data_array['city_abbreviation']."')";
    return sendSQL($sql,true);
}
/**
 * 1.資料庫City 修改國家id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 國家id
 * 
 * @param integer $country_id 修改的國家id
 * 
 * @return array
 */
function sqlUpdateCityCountryId($id,$country_id){
    $sql = "UPDATE `city` 
    SET `country_id` = '".$country_id."'
    WHERE `country_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫City 修改城市資料
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @param array $data_array 城市修改的資訊
 * 
 * @return array
 */
function sqlUpdateCity($id,$data_array){
    $sql = "UPDATE `city` 
    SET `country_id` = '".$data_array['country_id']."',
    `city_english` = '".$data_array['city_english']."',
    `city_chinese` = '".$data_array['city_chinese']."',
    `city_abbreviation` = '".$data_array['city_abbreviation']."'
    WHERE `city_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫City 修改城市id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @return array
 */
function sqlUpdateCityCityDelCityId($id){
    $sql = "UPDATE `city` 
    SET `city_del` = 1
    WHERE `city_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫City 修改城市id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @return array
 */
function sqlUpdateCityCityNotDelCityId($id){
    $sql = "UPDATE `city` 
    SET `city_del` = 0
    WHERE `city_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫City 刪除城市id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @return array
 */
function sqlDeleteCityCityId($id){
    $sql = "DELETE FROM `city` WHERE `city_id` = ".$id;
    return sendSQL($sql);
}

?>
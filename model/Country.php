<?php
/**
 * 1.資料庫Country 列出國家使用者查詢的資料
 *
 * @author Peter Chang
 *
 * @param array|boolean $search_fields 使用者搜尋的資料
 * 
 * @return array
 */
function sqlSelectCountryList($search_fields){
    $sql = "SELECT *
        FROM `country` 
        LEFT JOIN `ocean_export` ON `country`.`ocean_export_id` = `ocean_export`.`ocean_export_id`
        WHERE 1";
    $sql=getCountrySqlSearchWhere($sql,$search_fields);
    $sql .= " ORDER BY `ocean_export`.`quote_route` ASC,`country`.`country_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 國家資訊查詢不等於這個id
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectCountryNotCountryId($country_id){
    $sql = "SELECT * FROM `country` WHERE `country_del` = 0 AND `country_id` != ".$country_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 國家資訊查詢國家英文及id
 *
 * @author Peter Chang
 *
 * @param integer $country_id 國家id
 * 
 * @param string $country_english 為國家英文
 * 
 * @return array
 */
function sqlSelectCountryCountryIdCountryEnglish($country_id,$country_english){
    $sql = "SELECT * FROM `country` WHERE `country_id` != ".$country_id." AND `country_english` LIKE '".$country_english."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 新增國家
 *
 * @author Peter Chang
 *
 * @param array $data_array 國家新增的資訊
 * 
 * @return array
 */
function sqlInsertCountry($data_array){
    $sql = "INSERT INTO `country`(`ocean_export_id`, `country_english`, `country_chinese`, `country_abbreviation`) 
    VALUES (".$data_array['ocean_export_id'].",
    '".$data_array['country_english']."',
    '".$data_array['country_chinese']."',
    '".$data_array['country_abbreviation']."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 修改國家資料
 *
 * @author Peter Chang
 *
 * @param integer $id 國家id
 * 
 * @param array $data_array 國家修改的資訊
 * 
 * @return array
 */
function sqlUpdateCountry($id,$data_array){
    $sql = "UPDATE `country` 
    SET `ocean_export_id` = ".$data_array['ocean_export_id'].",
    `country_english` = '".$data_array['country_english']."',
    `country_chinese` = '".$data_array['country_chinese']."',
    `country_abbreviation` = '".$data_array['country_abbreviation']."'
    WHERE `country_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 修改國家id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 國家id
 * 
 * @return array
 */
function sqlUpdateCountryCountryDelCountryId($id){
    $sql = "UPDATE `country` 
    SET `country_del` = 1
    WHERE `country_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 修改國家id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 國家id
 * 
 * @return array
 */
function sqlUpdateCountryCountryNotDelCountryId($id){
    $sql = "UPDATE `country` 
    SET `country_del` = 0
    WHERE `country_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Country 刪除國家id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 國家id
 * 
 * @return array
 */
function sqlDeleteCountryCountryId($id){
    $sql = "DELETE FROM `country` WHERE `country_id` = ".$id;
    return sendSQL($sql);
}
?>
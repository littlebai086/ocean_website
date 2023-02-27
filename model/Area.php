<?php
/**
 * 1.資料庫Area 修改城市id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @param integer $city_id 修改的城市id
 * 
 * @return array
 */
function sqlUpdateAreaCityId($id,$city_id){
    $sql = "UPDATE `area` 
    SET `city_id` = '".$city_id."'
    WHERE `city_id` = ".$id;
    return sendSQL($sql);
}
?>
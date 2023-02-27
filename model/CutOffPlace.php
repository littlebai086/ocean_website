<?php
/**
 * 1.資料庫CutOffPlace 結關地資訊查詢城市id
 *
 * @author Peter Chang
 *
 * @param integer $city_id 城市id
 * 
 * @return array
 */
function sqlSelectCutOffPlaceCityId($city_id){
    $sql="SELECT * FROM `cut_off_place` WHERE `city_id` = ".$city_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫CutOffPlace 修改城市id資料
 *
 * @author Peter Chang
 *
 * @param integer $id 城市id
 * 
 * @param integer $city_id 修改的城市id
 * 
 * @return array
 */
function sqlUpdateCutOffPlaceCityId($id,$city_id){
    $sql = "UPDATE `cut_off_place` 
    SET `city_id` = '".$city_id."'
    WHERE `city_id` = ".$id;
    return sendSQL($sql);
}
?>
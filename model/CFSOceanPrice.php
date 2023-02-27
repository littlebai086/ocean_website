<?php
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
function sqlSelectCFSOceanPriceDestinationPortIdCutOffId($destination_port_id,$cut_off_place_id){
    $sql = "SELECT * FROM `cfs_ocean_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `cfs_ocean_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `cfs_ocean_price`.`cut_off_place_id`
WHERE `cfs_ocean_price`.`destination_port_id` = ".$destination_port_id." AND 
        `cfs_ocean_price`.`cut_off_place_id` = ".$cut_off_place_id."
ORDER BY `cut_off_place`.`cut_off_place_id` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價費用查詢
 *
 * @author Peter Chang
 * 
 * @return array
 */
function sqlSelectCFSOceanPriceQuoteRoute(){
    $sql = "SELECT * FROM `cfs_ocean_price`
INNER JOIN `ocean_export` ON `ocean_export`.`ocean_export_id` = `cfs_ocean_price`.`ocean_export_id`
GROUP BY `ocean_export`.`ocean_export_id`";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價費用查詢
 *
 * @author Peter Chang
 * 
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return array
 */
function sqlSelectCFSOceanPriceDestinationCountry($ocean_export_id){
    $sql = "SELECT * FROM `cfs_ocean_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `cfs_ocean_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `cfs_ocean_price`.`cut_off_place_id`
WHERE `cfs_ocean_price`.`ocean_export_id` = ".$ocean_export_id." 
GROUP BY `country`.`country_english`
ORDER BY `country`.`country_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價費用查詢
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectCFSOceanPriceDestinationPort($country_id){
    $sql = "SELECT * FROM `cfs_ocean_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `cfs_ocean_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `cfs_ocean_price`.`cut_off_place_id`
WHERE `destination_port`.`country_id` = ".$country_id." 
GROUP BY `destination_port`.`destination_port_english`
ORDER BY `destination_port`.`destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價費用查詢
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectCFSOceanPriceDestinationPortDestination($country_id){
    $sql = "SELECT * FROM `cfs_ocean_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `cfs_ocean_price`.`destination_port_id`
INNER JOIN `destination` ON `destination`.`destination_id` = `destination_port`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `cfs_ocean_price`.`cut_off_place_id`
WHERE `destination_port`.`country_id` = ".$country_id." 
GROUP BY `destination_port`.`destination_port_english`
ORDER BY `destination_port`.`destination_port_english` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫CFSOceanPrice 海運併櫃報價價格列表
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return array
 */
function sqlSelectCFSOceanPriceCFSOceanPriceIdList($ocean_export_id){
    $sql = "SELECT * FROM `cfs_ocean_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `cfs_ocean_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `cfs_ocean_price`.`cut_off_place_id`
WHERE `cfs_ocean_price`.`ocean_export_id` = ".$ocean_export_id."
ORDER BY `country`.`country_english` ASC,`destination_port`.`destination_port_english` ASC,`cut_off_place`.`cut_off_place_id` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫CFSOceanPrice 刪除併櫃報價在重新新增新的報價
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 海運報價id
 * 
 * @param integer $destination_port_id 目的港id
 * 
 * @param integer $cut_off_place_id 結關地id
 * 
 * @param integer $price 價格
 * 
 * @return array
 */
function sqlInsertCFSOceanPrice($ocean_export_id,$destination_port_id,$cut_off_place_id,$price){
    $sql = "INSERT INTO `cfs_ocean_price`(`ocean_export_id`, `destination_port_id`, `cut_off_place_id`, `cfs_ocean_price`) 
    VALUES ('".$ocean_export_id."','".$destination_port_id."','".$cut_off_place_id."',".$price.")";
    return sendSQL($sql);
}
/**
 * 1.資料庫CFSOceanPrice 刪除併櫃報價在重新新增新的報價
 *
 * @author Peter Chang
 *
 * @return array
 */
function sqlDeleteCFSOceanPrice($id){
    $sql = "DELETE FROM `cfs_ocean_price` WHERE `ocean_export_id` = ".$id;
    return sendSQL($sql);
}
?>
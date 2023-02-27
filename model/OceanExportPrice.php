<?php
/**
 * 1.資料庫OceanExportPrice 海運報價價格列表
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return array
 */
function sqlSelectOceanExportPriceOceanExportIdList($ocean_export_id){
    $sql = "SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `ocean_export_price`.`cut_off_place_id`
INNER JOIN `cabinet_volume` ON `cabinet_volume`.`cabinet_volume_id` = `ocean_export_price`.`cabinet_volume_id`
WHERE `ocean_export_price`.`ocean_export_id` = ".$ocean_export_id."
ORDER BY `country`.`country_english` ASC,`destination_port`.`destination_port_english` ASC,`cut_off_place`.`cut_off_place_id` DESC,`cabinet_volume`.`cabinet_volume_id` ASC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 用於尋找port_code 
 *
 * @author Peter Chang
 *
 * @param string $port_code 目的港code
 * 
 * @return array
 */
function sqlSelectOceanExportPricePortCode($port_code){
    $sql = "SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
WHERE `destination_port`.`port_code` LIKE '".$port_code."' OR 
    `destination_port`.`port_code_1` LIKE '".$port_code."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 用於尋找port_code 及櫃型種類和結關地點id
 *
 * @author Peter Chang
 *
 * @param string $port_code 目的港code
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地點id
 * 
 * @return array
 */
function sqlSelectOceanExportPricePortCodeCabinetVolumeIdCutOffPlaceId($port_code,$cabinet_volume_id,$cut_off_place_id){
    $sql = "SELECT * FROM `ocean_export_price`
INNER JOIN `destination_port` ON `destination_port`.`destination_port_id` = `ocean_export_price`.`destination_port_id`
INNER JOIN `country` ON `country`.`country_id`=`destination_port`.`country_id`
INNER JOIN `cut_off_place` ON `cut_off_place`.`cut_off_place_id` = `ocean_export_price`.`cut_off_place_id`
INNER JOIN `cabinet_volume` ON `cabinet_volume`.`cabinet_volume_id` = `ocean_export_price`.`cabinet_volume_id`
WHERE (`destination_port`.`port_code` LIKE '".$port_code."' OR 
    `destination_port`.`port_code_1` LIKE '".$port_code."') AND 
    `ocean_export_price`.`cabinet_volume_id` = ".$cabinet_volume_id." AND 
    `ocean_export_price`.`cut_off_place_id` = ".$cut_off_place_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 尋找目的港id
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港id
 * 
 * @return array
 */
function sqlSelectOceanExportPriceDestinationPortId($id){
    $sql = "SELECT * FROM `ocean_export_price` WHERE `destination_port_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DgOceanPrice DG費用表格尋找費用價錢
 *
 * @author Peter Chang
 *
 * @param integer $company_id 公司id
 * 
 * @param integer $country_id 國家id
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地點id
 * 
 * @return array
 */
function sqlSelectDgOceanPriceCompanyIdCoutryIdCabinetVolumeIdCutOffPlaceId($company_id,$country_id,$cabinet_volume_id,$cut_off_place_id){
    $sql = "SELECT * FROM `dg_ocean_price`
    WHERE `company_id` = ".$company_id." AND 
    `country_id` = ".$country_id." AND 
    `cabinet_volume_id` = ".$cabinet_volume_id." AND 
    `cut_off_place_id` = ".$cut_off_place_id."
    ORDER BY `dg_ocean_price_id` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 海運報價價格新增
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 海運報價id
 * 
 * @param integer $destination_port_id 目的港id
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地id
 * 
 * @param integer $price 價格
 * 
 * @return array
 */
function sqlInsertOceanExportPrice($ocean_export_id,$destination_port_id,$cabinet_volume_id,$cut_off_place_id,$price,$company_id){
    $company_id=getDataZeroTransferNullSaveSql($company_id);
    if($price===NULL){$price="NULL";}
    $sql = "INSERT INTO `ocean_export_price`(`ocean_export_id`, `destination_port_id`, `cabinet_volume_id`, `cut_off_place_id`, `ocean_export_price`,`company_id`) 
    VALUES ('".$ocean_export_id."','".$destination_port_id."','".$cabinet_volume_id."',
    '".$cut_off_place_id."',".$price.",".$company_id.")";
    return sendSQL($sql);
}

/**
 * 1.資料庫OceanExportPrice 修改海運報價資料
 *
 * @author Peter Chang
 *
 * @param integer $id 目的港id
 * 
 * @param integer $destination_port_id 修改目的港id
 * 
 * @return array
 */
function sqlUpdateOceanExportPriceDestinationPortId($id,$destination_port_id){
    $sql = "UPDATE `ocean_export_price` 
    SET `destination_port_id` = '".$destination_port_id."'
    WHERE `destination_port_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExportPrice 刪除指定的報價id在重新新增新的報價
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return array
 */
function sqlDeleteOceanExportPriceOceanExportId($ocean_export_id){
    $sql = "DELETE FROM `ocean_export_price` WHERE `ocean_export_id` = ".$ocean_export_id;
    return sendSQL($sql);
}
?>
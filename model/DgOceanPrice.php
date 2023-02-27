<?php
/**
 * 1.資料庫DgOceanPrice查詢地區id資料刪除
 *
 * @author Peter Chang
 *
 * @param integer $id 海運報價id
 * 
 * @return array
 */
function sqlSelectDgOceanPriceInnerOceanExportId($id){
    $sql = "SELECT * 
    FROM `dg_ocean_price` 
    INNER JOIN `country` ON `country`.`country_id`=`dg_ocean_price`.`country_id`
    WHERE `ocean_export`.`ocean_export_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DgOceanPrice查詢國家id資料刪除
 *
 * @author Peter Chang
 *
 * @param integer $id 國家id
 * 
 * @return array
 */
function sqlSelectDgOceanPriceCountryId($id){
    $sql = "SELECT * 
    FROM `dg_ocean_price` 
    WHERE `country_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫DgOceanPrice 海運報價價格新增
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 地區id
 * 
 * @param integer $company_id 公司id
 * 
 * @param integer $country_id 國家id
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地id
 * 
 * @param integer $price 價格
 * 
 * @return array
 */
function sqlInsertDgOceanPrice($ocean_export_id,$company_id,$country_id,$cabinet_volume_id,$cut_off_place_id,$price){
    $sql = "INSERT INTO `dg_ocean_price`(`ocean_export_id`,`company_id`,`country_id`,`cabinet_volume_id`, `cut_off_place_id`, `dg_price`) 
    VALUES ('".$ocean_export_id."','".$company_id."','".$country_id."','".$cabinet_volume_id."',
    '".$cut_off_place_id."','".$price."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫DgOceanPrice 刪除指定的報價地區id在重新新增新的報價
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 地區id
 * 
 * @return array
 */
function sqlDeleteDgOceanPriceOceanExportId($ocean_export_id){
    $sql = "DELETE FROM `dg_ocean_price` WHERE `ocean_export_id` = ".$ocean_export_id;
    return sendSQL($sql);
}
?>
<?php
/**
 * 1.資料庫ShippingCompanyFeesAfr 尋找價格用船公司報價費用id和櫃量id
 * 
 * @author Peter Chang
 *
 * @param integer $shipping_company_fees_id 船公司報價費用id
 * 
 * @param integer $ocean_export_id 地區id
 * 
 * @return array
 */
function sqlSelectShippingCompanyFeesAfrShippingCompanyFeesIdOceanExportIdCountryId($shipping_company_fees_id,$ocean_export_id,$country_id){
    $sql = "SELECT * 
    FROM `shipping_company_fees_afr` 
    WHERE `shipping_company_fees_id` = ".$shipping_company_fees_id." AND
    `ocean_export_id` = ".$ocean_export_id." AND
    (`country_id` = ".$country_id." OR `country_id` = NULL)
    ORDER BY `shipping_company_fees_afr`.`shipping_company_fees_afr_create` DESC";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport 新增海運報價名稱及附檔
 *
 * @author Peter Chang
 *
 * @param array $data_array 海運報價新增的資訊
 * 
 * @return array
 */
function sqlInsertShippingCompanyFeesAfr($shipping_company_fees_id,$currency,$afr,$country_id,$ocean_export_id){
    $country_id=getDataZeroTransferNullSaveSql($country_id);
    $sql = "INSERT INTO `shipping_company_fees_afr`(`shipping_company_fees_id`, `currency`, `afr`,`country_id`,`ocean_export_id`) 
    VALUES ('".$shipping_company_fees_id."','".strtoupper($currency)."','".$afr."',
    ".$country_id.",'".$ocean_export_id."')";
    return sendSQL($sql);
}
?>
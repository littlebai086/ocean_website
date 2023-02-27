<?php
/**
 * 1.資料庫OceanExport 搜尋船公司報價費用
 *
 * @author Peter Chang
 *
 * @param integer $shipping_company_fees_id 船公司報價費用id
 * 
 * @param integer $cabinet_volume_id 櫃量id
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function sqlSelectShippingCompanyFeesThcShippingCompanyFeesIdCabinetVolumeId($shipping_company_fees_id,$cabinet_volume_id){
    $sql = "SELECT * 
    FROM `shipping_company_fees_thc` 
    WHERE `shipping_company_fees_id` = ".$shipping_company_fees_id." AND
    `cabinet_volume_id` = ".$cabinet_volume_id."
    ORDER BY `shipping_company_fees_thc`.`shipping_company_fees_thc_create` DESC";
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
function sqlInsertShippingCompanyFeesThc($shipping_company_fees_id,$cabinet_volume_id,$thc){
    $sql = "INSERT INTO `shipping_company_fees_thc`(`shipping_company_fees_id`, `cabinet_volume_id`, `thc`) 
    VALUES ('".$shipping_company_fees_id."','".$cabinet_volume_id."','".$thc."')";
    return sendSQL($sql);
}
?>
<?php
/**
 * 1.資料庫OceanExport 搜尋船公司報價費用
 *
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 地區id
 * 
 * @param integer $company_id 公司id
 * 
 * @return array
 */
function sqlSelectShippingCompanyFeesOceanExportIdCompanyId($ocean_export_id,$company_id){
    $sql = "SELECT * 
    FROM `shipping_company_fees` 
    WHERE `ocean_export_id` = ".$ocean_export_id." AND
    `company_id` = ".$company_id."
    ORDER BY `shipping_company_fees`.`shipping_company_fees_create` DESC";
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
function sqlInsertShippingCompanyFees($ocean_export_id,$company_id,$b_l,$seal,$telex_release){
    $sql = "INSERT INTO `shipping_company_fees`(`ocean_export_id`, `company_id`, `b_l`, `seal`, `telex_release`) 
    VALUES ('".$ocean_export_id."','".$company_id."','".$b_l."',
    '".$seal."','".$telex_release."')";
    return sendSQL($sql,true);
}
?>
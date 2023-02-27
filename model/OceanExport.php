<?php
/**
 * 1.資料庫OceanExport 海運報價列表
 *
 * @author Peter Chang
 *
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return array
 */
function sqlSelectOceanExportList(){
    $sql = "SELECT * FROM `ocean_export` ORDER BY `quote_route` ASC ";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport 海運搜尋列表
 *
 * @author Peter Chang
 *
 * @param string $quote_route 地區名稱
 * 
 * @return array
 */
function sqlSelectOceanExportQuoteRoute($quote_route){
    $sql = "SELECT `ocean_export_id` FROM `ocean_export` WHERE `quote_route` LIKE '".$quote_route."'";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport查尋地區id其他的國家id
 *
 * @author Peter Chang
 *
 * @param integer $id 海運報價id
 * 
 * @return array
 */
function sqlSelectOceanExportInnerCountryDestinationPortOceanExportIdCountryId($id,$country_ids){
    $buf="";
    $country_array=array();
    foreach($country_ids as $country_id){
        array_push($country_array,"`country`.`country_id` = ".$country_id);
    }
    if($country_array){
        $buf.=" AND ".implode(" AND ", $country_array);
    }
    $sql = "SELECT * 
    FROM `ocean_export` 
    INNER JOIN `country` ON `country`.`ocean_export_id`=`ocean_export`.`ocean_export_id`
    INNER JOIN `destination_port` ON `destination_port`.`country_id`=`country`.`country_id`
    WHERE `ocean_export`.`ocean_export_id` = ".$id." AND `destination_port`.`destination_port_del`=0".$buf."
    GROUP BY `country`.`country_english`
    ORDER BY `country`.`country_english` ASC";
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
function sqlInsertOceanExport($data_array){
    $sql = "INSERT INTO `ocean_export`(`quote_route`) VALUES ('".$data_array['quote_route']."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport 修改海運報價列表
 *
 * @author Peter Chang
 *
 * @param integer $id 海運報價id
 * 
 * @param string $quote_route 報價航線名稱
 * 
 * @return array
 */
function sqlUpdateOceanExportQuoteRoute($id,$quote_route){
    $sql = "UPDATE `ocean_export` SET `quote_route` = '".$quote_route."' WHERE `ocean_export_id` = ".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫OceanExport 修改海運報價列表
 *
 * @author Peter Chang
 *
 * @param integer $id 海運報價id
 * 
 * @param string $quote_route 報價航線名稱
 * 
 * @param string $filename 額外檔案連結
 * 
 * @return array
 */
function sqlUpdateOceanExportOceanExportAdditionalHref($id,$quote_route,$filename){
    $sql = "UPDATE `ocean_export` SET `quote_route` = '".$quote_route."', `ocean_export_additional_href` = '".$filename."' WHERE `ocean_export_id` = ".$id;
    return sendSQL($sql);
}
?>
<?php
/**
 * 1.資料庫OceanExportExport 海運報價價格期限新增
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
function sqlInsertOceanExportDateDeadline($ocean_export_id,$start_date,$end_date,$attchment,$charge_arrays,$shipment_type){
    $sql = "INSERT INTO `ocean_export_date_deadline`(
    `ocean_export_id`, `start_date`, `end_date`, `attachment`,
    `b_l`,`cfs`,`thc`,
    `seal`,`telex_release`,
    `transfer_fee`,
    `transfer_fee_remark`,
    `transfer_fee_country`,
    `shipment_type`) 
    VALUES (".$ocean_export_id.",'".$start_date."','".$end_date."','".$attchment."',
    '".$charge_arrays["bl"]["price"]."','".$charge_arrays["cfs"]["price"]."',
    '".$charge_arrays["thc"]["price"]."',
    '".$charge_arrays["seal"]["price"]."','".$charge_arrays["telex_release"]["price"]."',
    '".$charge_arrays["transfer_fee"]["price"]."',
    '".$charge_arrays["transfer_fee"]["remark"]."',
    '".$charge_arrays["transfer_fee"]["country"]."',
    '".$shipment_type."')";
    return sendSQL($sql);
}

?>
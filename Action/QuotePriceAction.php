<?php
require_once('../model/CommonSql.php');
require_once('../model/CFSOceanPrice.php');
require_once('../controllers/CommonSqlController.php');
require_once('../controllers/CommonHtmlController.php');
require_once('../controllers/OceanExportController.php');
require_once('../controllers/CFSOceanPriceController.php');
session_start();
header('Content-Type:text/html;charset=utf-8');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
if (isset($_POST['cabinet_volumets'])) {
    $cabinet_volumets = $_POST['cabinet_volumets'];
}
if (isset($_POST['cut_off_place_id'])) {
    $cut_off_place_id = $_POST['cut_off_place_id'];
}
if (isset($_POST['ocean_export_id'])) {
    $ocean_export_id = $_POST['ocean_export_id'];
}
if (isset($_POST['destination_port_id'])) {
    $destination_port_id = $_POST['destination_port_id'];
}
if (isset($_POST['shipment_type'])) {
    $shipment_type = $_POST['shipment_type'];
}
switch ($action) {
    case 'destinationcountry':
        $content_array=array();
        $buf = sqlSelectOceanExportPriceDestinationCountry($ocean_export_id);
        if($buf){
            foreach ($buf as $row){
                array_push($content_array,array($row['country_id']=>$row['country_english']));
            }
        }else{
            $content_array=false;
        }
        $content_text=json_encode($content_array);
        break;
    case 'cfsdestinationcountry':
        $content_array=array();
        $buf = sqlSelectCFSOceanPriceDestinationCountry($ocean_export_id);
        if($buf){
            foreach ($buf as $row){
                array_push($content_array,array($row['country_id']=>$row['country_english']));
            }
        }else{
            $content_array=false;
        }
        $content_text=json_encode($content_array);
        break;
   case 'ocean_cut_off_place_price':
        $content_array=array();
        if($shipment_type=="CY"){
            $content_text=getStaffOceanExportPriceListCutOffPlaceTable($destination_port_id,$cut_off_place_id);
        }elseif($shipment_type=="CFS"){
            $content_text=getStaffCFSOceanPriceListCutOffPlaceTable($destination_port_id,$cut_off_place_id);
        }
        $content_text=json_encode($content_text);
        break;
   case 'CFS_ocean_local_charge':
        $content_array=array();
        $content_text=getOceanExportPriceLocalChargeTable($destination_port_id,"CFS");
        $content_text=json_encode($content_text);
        break;
   case 'ocean_local_charge':
        $content_array=array();
        $content_text=getOceanExportPriceLocalChargeTable($destination_port_id,strtoupper($shipment_type));
        $content_text=json_encode($content_text);
        break;
   case 'price':
        $content_array=array();
        $cabinet_volum_price_array=array();
        $cabinet_volumets=getCabinetVolumeArrayKeyToCabinetVolumeId($cabinet_volumets);
        foreach($cabinet_volumets as $key=>$value){
            $value=intval($value);
            if($value>0){
                $array=getOceanExportPriceDestinationPortIdCutOffIdCabinetVolumeId($destination_port_id,$key,$cut_off_place_id);
                if($array){
                    array_push($content_array,getOceanExportPriceCommonValuation($array["ocean_export_price"])."/".$array["table_name"]);
                    array_push($cabinet_volum_price_array,$key.":".$array["ocean_export_price"]);
                    //array_push($content_array,$value);
                }
            }
        }
        $content_value=implode("<br>",$content_array);
        $cabinet_volum_price_value=implode("|",$cabinet_volum_price_array);
        $content_text=json_encode(array($content_value,$cabinet_volum_price_value));
        break;
}
echo $content_text;
?>
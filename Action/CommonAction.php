<?php
require_once('../model/CommonSql.php');
require_once('../model/CFSOceanPrice.php');
require_once('../controllers/CommonSqlController.php');
require_once('../controllers/CommonHtmlController.php');
require_once('../controllers/CFSOceanPriceController.php');

header('Content-Type:text/html;charset=utf-8');

if (isset($_GET['shipment_type'])) {
    $shipment_type = $_GET['shipment_type'];
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if (isset($_GET['val'])) {
    $id = $_GET['val'];
}

switch ($action) {
    case 'city_select':
        $content_array=array();
        $buf=sqlSelectAreaCityId($id);
        foreach ($buf as $row){
            array_push($content_array,array($row['area_id']=>$row['area_chinese']));
        }
        $content_text=json_encode($content_array);
        break;
    case 'alldestination':
        $content_array=false;
        $content_array=array();
        $buf=getDestinationIdEnglish($id);
        if($buf){
            $content_array=$buf;
        }
        $content_text=json_encode($content_array);
        break;
    case 'destinationport':
        $content_array=array();
        $buf=sqlSelectOceanExportPriceDestinationPort($id);
        if($buf){
            foreach ($buf as $row){
                array_push($content_array,array($row['destination_port_id']=>$row['destination_port_english']));
            }
        }else{
            $content_array=false;
        }
        $content_text=json_encode($content_array);
        break;
    case 'cfsdestinationport':
        $content_array=array();
        $buf=sqlSelectCFSOceanPriceDestinationPort($id);
        if($buf){
            foreach ($buf as $row){
                array_push($content_array,array($row['destination_port_id']=>$row['destination_port_english']));
            }
        }else{
            $content_array=false;
        }
        $content_text=json_encode($content_array);
        break;    
    case 'destination':
        $content_array=array();
        $container_buf = false;
        if($shipment_type=="CY"){
            $buf = sqlSelectOceanExportPriceDestinationPortDestination($id);
            $container_buf = sqlSelectDestinationDestinationContainerDepotCountryId($id);
        }elseif($shipment_type=="CFS"){
            $buf = sqlSelectCFSOceanPriceDestinationPortDestination($id);
        }
        if($buf){
            foreach ($buf as $row){
                array_push($content_array,array($row['destination_id']=>$row['destination_port_english']));
            }
        }else{
            $content_array=false;
        }
        if($container_buf){
            foreach ($container_buf as $row){
                array_push($content_array,array($row['destination_id']=>$row['container_depot_english']));
            }
        }
        $content_text=json_encode($content_array);
        break; 
}
echo $content_text;
?>
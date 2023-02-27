<?php

require_once('../model/CommonSql.php');
require_once('../controllers/CommonSqlController.php');
require_once('../controllers/CommonHtmlController.php');
session_start();
header('Content-Type:text/html;charset=utf-8');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
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
   case 'record':
   $member_id= $_SESSION['member_id'];
   $ip=$_SESSION['ip'];
    if(sqlInsertIpLog($ip,$member_id,$ocean_export_id,$destination_port_id,$shipment_type)){
        $content_text=json_encode("true");
    }else{
        $content_text=json_encode("false");
    }
   break;
}
echo $content_text;
?>
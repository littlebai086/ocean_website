<?php
/**
 * 1.資料庫Destinaion 查詢DestinaionPortid資料
 *
 * @author Peter Chang
 *
 * @param integer $destinaion_port_id 的目的港id
 * 
 * @return array
 */
function sqlSelectDestinationDestinationPortId($destination_port_id){
    $sql = "SELECT * FROM `destination` WHERE `destination_port_id` = ".$destination_port_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Destinaion 查詢DestinaionContainerDepotid資料
 *
 * @author Peter Chang
 *
 * @param integer $destination_container_depot_id 的目的地貨櫃id
 * 
 * @return array
 */
function sqlSelectDestinationDestinationContainerDepotId($destination_container_depot_id){
    $sql = "SELECT * FROM `destination` 
    WHERE `destination_container_depot_id` = ".$destination_container_depot_id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Destinaion 新增DestinaionPortid資料
 *
 * @author Peter Chang
 *
 * @param integer $destinaion_port_id 新增的目的港id
 * 
 * @return array
 */
function sqlInsertDestinationDestinationPortId($destination_port_id){
    $sql = "INSERT INTO `destination`(`destination_port_id`) VALUES ('".$destination_port_id."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫Destinaion 新增DestinaionContainerDepotid資料
 *
 * @author Peter Chang
 *
 * @param integer $destinaion_container_depot_id 新增的貨櫃目的地id
 * 
 * @return array
 */
function sqlInsertDestinationDestinationContainerDepotId($destination_container_depot_id){
    $sql = "INSERT INTO `destination`(`destination_container_depot_id`) VALUES ('".$destination_container_depot_id."')";
    return sendSQL($sql);
}
/**
 * 1.資料庫Destinaion 刪除DestinaionContainerDepotid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 刪除貨櫃目的地id資料
 * 
 * @return array
 */
function sqlDeleteDestinationDestinationContainerDepotId($id){
    $sql = "DELETE FROM `destination` WHERE `destination_container_depot_id`=".$id;
    return sendSQL($sql);
}
/**
 * 1.資料庫Destinaion 刪除DestinaionPortid刪除資料
 *
 * @author Peter Chang
 *
 * @param integer $id 刪除目的地港口id資料
 * 
 * @return array
 */
function sqlDeleteDestinationDestinationPortId($id){
    $sql = "DELETE FROM `destination` WHERE `destination_port_id`=".$id;
    return sendSQL($sql);
}
?>
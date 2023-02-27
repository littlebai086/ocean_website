<?php
/**
 * 1.資料庫OceanExport 新增海運報價名稱及附檔
 *
 * @author Peter Chang
 *
 * @param array $data_array 海運報價新增的資訊
 * 
 * @return array
 */
function sqlInsertMarquee($content){
    $sql = "INSERT INTO `marquee`(`marquee_content`) VALUES ('".$content."')";
    return sendSQL($sql);
}
?>
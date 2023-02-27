<?php
$file_path = "../../upload/OceanExportQuotePriceExcel/test.txt";
if(file_exists($file_path)){
$str = file_get_contents($file_path);//將整個檔案內容讀入到一個字串中
$str = str_replace("\r\n","<br />",$str);
echo $str;
}
?>
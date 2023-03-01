<?php
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../model/OceanExportDateDeadline.php");
require_once("../../model/DgOceanPrice.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
session_start();
$form="";
if(isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
if($state=="upload_excel"){
  $data_array=getOceanExportId($id);
  $form=getStaffOceanExportPriceExcelUploadForm($state,$data_array);
  $title="海運報價航線上傳報價";
  $submit="上傳";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <?php 
    echo TESTransportStaffCommonHtmlHead("測試海運網後台",true);
  ?>
</head>
<body>
<?php 
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
	echo PopupWidowScriptHiddenButton(false,"OceanExportQuoteUploadMessage");
?>
<main class="container-fluid" >
  <form method="post" action="" id="loginForm" enctype="multipart/form-data">
    <input type="text" name="ocean_export_id" value="<?php echo $id;?>" hidden>
    <?php
      echo $form;
    ?>
    
    <div class="row">
        <div class="col col-lg-5">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <input type="submit" name="emp_edit_send" class="btn btn-success" value="<?php echo $submit;?>">
         </div>
        <div class="col col-lg-1 d-flex align-items-center">
            <input type="button" value="回海運報價航線列表" onclick="location.href='./OceanExportQuoteList.php'" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send'])){
  $postname="attachment";
  $path="../../upload/OceanExportQuotePriceExcel/";
  list($result,$filename)=getUploadFile($path,$postname,false);

  if(!$result){
    echo PopupStaticWidowHref($title,"上傳出現錯誤，請聯絡公司相關IT人員","back",true,"OceanExportQuoteUploadMessage");
    exit;
  }
  $state_array=array("upload_country","quote_price");
  $excel_array=getExcelToDataArray($path.$filename,1);
  $price_start_field=4;
  $cut_off_array=getOceanExportQuotEexcelToCutOffPlaceArray($excel_array[$price_start_field-3]);
  $cabinet_volume_array=getOceanExportQuotEexcelToCabinetVolumeArray($excel_array[$price_start_field-1]);
  $start_date=date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(intval($excel_array[$price_start_field-2][1])));
  $end_date=date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(intval($excel_array[$price_start_field-2][2])));
  list($result,$msg,$key)=getOceanExportQuoteEexcelArrayUploadDatabaseReturn($id,$price_start_field,$cut_off_array,$cabinet_volume_array,$excel_array);
  if(!$result){
    echo PopupStaticWidowHref($title,$msg,"back",true,"OceanExportQuoteUploadMessage");
      exit;
  }
  // foreach($state_array as $state){
  //   list($result,$msg,$key)=getOceanExportQuoteEexcelArrayUploadDatabaseReturn($id,$price_start_field,$cut_off_array,$cabinet_volume_array,$excel_array,$state);
  //   if(!$result){
  //     echo PopupStaticWidowHref($title,$msg,"back",true,"OceanExportQuoteUploadMessage");
  //     exit;
  //   }
  // }
  $dg_excel_array=getExcelToDataArray($path.$filename,2);
  $price_start_field=1;

  list($result,$msg)=getDGOceanQuoteEexcelArrayUploadDGDatabaseReturn($id,$dg_excel_array,$price_start_field);
  if(!$result){
    echo PopupStaticWidowHref($title,$msg,"back",true,"OceanExportQuoteUploadMessage");
    exit;
  }
  $charge_arrays=getOceanExportQuoteEexcelArrayChargeArrayReturn($key,$excel_array);
  //print_r($charge_arrays);
  if(sqlInsertOceanExportDateDeadline($id,$start_date,$end_date,$filename,$charge_arrays,"CY")){
    echo PopupStaticWidowHref($title,$msg,"./OceanExportQuoteList.php",true,"OceanExportQuoteUploadMessage");
    exit;
  }
}

?>

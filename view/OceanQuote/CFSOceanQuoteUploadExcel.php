<?php
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../model/CFSOceanPrice.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../model/OceanExportDateDeadline.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
require_once("../../controllers/CFSOceanPriceController.php");
session_start();
$form="";
if(isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
if($state=="upload_excel"){
  $data_array=getOceanExportId($id);
  $title="併櫃上傳報價";
  $submit="上傳";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <?php 
    echo QATransportStaffCommonHtmlHead("洋宏海運網後台",true);
  ?>
</head>
<body>
<?php 
  list($result,$html)=QATransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
	echo PopupWidowScriptHiddenButton(false,"OceanExportQuoteUploadMessage");
?>
<main class="container-fluid" >
  <form method="post" action="" id="loginForm" enctype="multipart/form-data">
    <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputELastName' class='control-label'>附檔</label>
        </div>
        <div class='col col-lg-2'>
          <input type='file'  class='form-control'name='attachment' id='inputAttachment' required='required'>
        </div>
    </div>
    
    <div class="row">
        <div class="col col-lg-5">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <input type="submit" name="emp_edit_send" class="btn btn-success" value="<?php echo $submit;?>">
         </div>
        <div class="col col-lg-1 d-flex align-items-center">
            <input type="button" value="回併櫃報價費用列表" onclick="location.href='./OceanExportQuoteList.php'" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo QATransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send'])){
  $postname="attachment";
  $path="../../upload/CFSOceanQuotePriceExcel/";
  list($result,$filename)=getUploadFile($path,$postname,false);

  if(!$result){
    echo PopupStaticWidowHref($title,"上傳出現錯誤，請聯絡公司相關IT人員","back",true,"OceanExportQuoteUploadMessage");
    exit;
  }
  $excel_array=getExcelToDataArray($path.$filename,1);
  $price_start_field=4;
  $cut_off_array=getOceanExportQuotEexcelToCutOffPlaceArray($excel_array[$price_start_field-1]);
  $start_date=date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(intval($excel_array[$price_start_field-2][1])));
  $end_date=date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(intval($excel_array[$price_start_field-2][2])));
  list($result,$msg,$key)=getCFSOceanPriceQuoteEexcelArrayUploadDatabaseReturn($id,$price_start_field,$cut_off_array,$excel_array);
  if(!$result){
    echo PopupStaticWidowHref($title,$msg,"back",true,"OceanExportQuoteUploadMessage");
      exit;
  }
  $charge_arrays=getOceanExportQuoteEexcelArrayChargeArrayReturn(($key+1),$excel_array);
  //print_r($charge_arrays);
  if(sqlInsertOceanExportDateDeadline($id,$start_date,$end_date,$filename,$charge_arrays,"CFS")){
    echo PopupStaticWidowHref($title,$msg,"./CFSOceanQuoteList.php",true,"OceanExportQuoteUploadMessage");
    exit;
  }
}

?>

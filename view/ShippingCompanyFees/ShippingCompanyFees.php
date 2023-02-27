<?php
require_once("../../model/CommonSql.php");
require_once("../../model/ShippingCompanyFees.php");
require_once("../../model/ShippingCompanyFeesAfr.php");
require_once("../../model/ShippingCompanyFeesThc.php");
require_once("../../model/OceanExport.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
require_once("../../controllers/ShippingCompanyFeesController.php");
session_start();
$form="";
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffPagePriorityReturn(5);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
if($state=="shipping_company_fees_upload"){
  $title="海運整櫃船公司費用";
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
	echo PopupWidowScriptHiddenButton(false,"Message");
?>
<main class="container-fluid" >
  <form method="post" action="" id="loginForm" enctype="multipart/form-data">
    <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-auto d-flex align-items-center'>
          <label for='inputELastName' class='control-label'>海運整櫃船公司費用</label>
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
     </div>
  </form>
</main>
<?php echo QATransportStaffFooter();?>
</body>
</html>
<?php 
if(isset($_POST['emp_edit_send'])){
  $postname="attachment";
  $path="../../upload/ShippingCompanyFeesExcel/";
  list($result,$filename)=getUploadFile($path,$postname,false);

  if(!$result){
    echo PopupStaticWidowHref($title,"上傳出現錯誤，請聯絡公司相關IT人員","back",true,"Message");
    exit;
  }
  $excels=array(0,1,2,3);
  foreach($excels AS $excel_key){
    $excel_array=getExcelToDataArray($path.$filename,$excel_key);
    $field_start=1;
    $cabinet_volume_array=getOceanExportQuotEexcelToCabinetVolumeArray($excel_array[$field_start]);
    if(getShippingCompanyFeesArrayInsertSQL($excel_array,$cabinet_volume_array)){
      echo "新增船公司費用成功<hr>";
    }else{
      echo $excel_key."工作表 新增船公司費用失敗<hr>";
      exit;
    }
  }
}
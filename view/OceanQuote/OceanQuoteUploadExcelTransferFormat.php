<?php
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../model/OceanExportDateDeadline.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
session_start();
$form="";
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffPagePriorityReturn(7);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
if($state=="upload_excel"){
  $title="海運報價轉檔";
  $submit="下載";
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
  <form method="post" action="OceanQuoteExcelTransferFormat.php" id="loginForm" enctype="multipart/form-data">
    <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-auto d-flex align-items-center'>
          <label for='inputELastName' class='control-label'>台塑附檔轉檔比對</label>
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
            <input type="button" value="回海運報價航線列表" onclick="location.href='./OceanExportQuoteList.php'" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo TESTransportStaffFooter();?>
</body>
</html>

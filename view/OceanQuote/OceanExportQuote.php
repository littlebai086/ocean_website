<?php
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
session_start();
$form="";
if(isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,5,$id,false);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
list($result,$message)=getStaffPagePriorityReturn(5);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$items=array("quote_route","ocean_export_additional_link");
if(isset($_POST['emp_edit_send'])){
  foreach ($items as $item){
    $data_array[$item]=trim($_POST[$item]);
  }
}elseif($state=="add"){
  foreach ($items as $item){
    $data_array[$item]="";
  }
  $form=getStaffOceanExportForm($state,$data_array);
}elseif($state=="update"){
  	$data_array=getOceanExportId($id);
    $attachment_text="原檔案:".$data_array['attachment'];
    $form=getStaffOceanExportForm($state,$data_array);
}
if($state=="add"){
  $title="海運報價航線新增";
  $submit="新增";
}elseif($state=="update"){
  $title="海運報價航線修改";
  $submit="修改";
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
            <input type="button" value="回海運報價航線列表" onclick="history.back()" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send'])){
  if($state=="add"){
    $title="測試航運報價新增";
  }elseif($state=="update"){
    $title="測試航運報價修改";
  }
  $quote_route=strtoupper($data_array['quote_route']);

  // if (!CompanyEnglishFormat($data_array['quote_route'])){
  //   echo PopupStaticWidowHref($title,"報價名稱應為英文，不該有中文及一些特殊符號","back",true,"OceanExportQuoteUploadMessage");
  //   exit;
  // }
  $postname="attachments";
  $path="../../upload/OceanExportQuoteAdditional/";
  list($result,$msg,$filenames)=getMultipleUploadFileAttachmentsArray($postname,$path);
  $filename=implode(";",$filenames);
  if(!$result){
    echo PopupStaticWidowHref($title,"上傳出現錯誤，請聯絡公司相關IT人員","back",true,"OceanExportQuoteUploadMessage");
    exit;
  }
  if ($state=="add"){
  	if (sqlInsertOceanExport($data_array)){
      echo PopupStaticWidowHref($title,"海運報價航線新增完成","./OceanExportQuoteList.php",true,"OceanExportQuoteUploadMessage");
    }else{
      echo PopupStaticWidowHref($title,"海運報價航線新增失敗","back",true,"OceanExportQuoteUploadMessage");
    }
  }elseif($state=="update"){
    if($filename){
      if(sqlUpdateOceanExportOceanExportAdditionalHref($id,$quote_route,$filename)){
        echo PopupStaticWidowHref($title,"修改海運報價航線完成","./OceanExportQuoteList.php",true,"OceanExportQuoteUploadMessage");
        exit;
      }
      echo PopupStaticWidowHref($title,"修改海運報價航線失敗，請聯絡公司相關IT人員","back",true,"OceanExportQuoteUploadMessage");
      exit;
    }
    if(sqlUpdateOceanExportQuoteRoute($id,$quote_route,$filename)){
        echo PopupStaticWidowHref($title,"修改海運報價航線完成","./OceanExportQuoteList.php",true,"OceanExportQuoteUploadMessage");
    }
    echo PopupStaticWidowHref($title,"修改海運報價航線失敗，請聯絡公司相關IT人員","back",true,"OceanExportQuoteUploadMessage");
    exit;
  }

}
?>

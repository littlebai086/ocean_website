<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/DestinationPort.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/DestinationPortController.php");
$table="";
$title="洋宏海運網";
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,4,false,false);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
list($result,$message)=getStaffPagePriorityReturn(4);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
?>
<!doctype html>
<html lang="en">
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
  echo PopupWidowScriptHiddenButton(true,"StaticWidowMessage");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  echo $table;
?> 
<form action='' method='post' enctype='multipart/form-data'>
  <div class='row'>
        <div class='col col-lg-3'>
        </div>
        <div class='col col-lg-2'>
            EXCEL目的港檔案上傳
        </div>
        <div class='col col-lg-2'>
            <input type='file' class='form-control' name='attachments[]' id='inputAttachments' required='required'>
        </div>
    </div>
 <p class='text-center'>
  <input type='submit' class='btn btn-success' value='送出'>
  </p>
</form>
  <?php echo QATransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_FILES['attachments']['name'][0])){
  
  $path="../../upload/DestinationPort/";
  list($result,$message,$attachments)=getMultipleUploadFileAttachmentsArray("attachments",$path);
  $filename=implode(";",$attachments);
  if(!$result){
    echo $message;
    echo PopupStaticWidowHref($title,"錯誤","back",true,"StaticWidowMessage");
    exit;
  }
  $excel_array=getExcelToDataArray($path.$filename,1);
  foreach($excel_array as $key=>$array){
    $country=trim($array[0]);
    $destination_port=trim($array[1]);
    if(!$country && isset($merge_country)){
      $country=$merge_country;
    }
    if($key>0 && $destination_port){
      $merge_country=$country;
      $country=strtoupper($country);
      $destination_port=strtoupper($destination_port);
      $country_array=getCountryCountryEnglish($country);
      if($country_array){
        if(!getDestinationPortCountryIdDestinationPortEnglish($country_array['country_id'],$destination_port)){
          if(!sqlInsertDestinationPort($country_array['country_id'],$destination_port)){
            echo PopupStaticWidowHref($title,"新增目的港失敗","back",true,"StaticWidowMessage");
            exit;
          }
        }
      }else{
        if(sqlInsertCountryCountryEnglish($country)){
          $country_array=getCountryCountryEnglish($country);
          if(!sqlInsertDestinationPort($country_array['country_id'],$destination_port)){
            echo PopupStaticWidowHref($title,"新增目的港失敗","back",true,"StaticWidowMessage");
            exit;
          }
        }
      }
    }
  }
  echo PopupStaticWidowHref($title,"上傳目的港完成","./DestinationPortList.php",true,"StaticWidowMessage");
  //echo "上傳目的港完成";

}
?>
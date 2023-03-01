<?php
session_start();
require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/BookingOrder.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/BookingController.php");
$table="";
$title="測試海運網";

if (isset($_GET['id'])){
  $id=$_GET['id'];
  $data_array=getBookingOrderId($id);
  $serial_number=getSerialCombinationStr($data_array);
  if($data_array['trading']=="export"){
    $text="出口";
  }else{
    $text="進口";
  }
  list($account,$auth)=getAccountAuth();
  $emailname="測試海運網";
  $recipients=getSendMailRecipientsArray($data_array['contact_name'],$data_array['contact_email']);
}else{
  $id=false;
}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,6,$id,false);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
if($state=="information"){
  $title="詳細資訊";
  if($data_array){
    $table=getBookingOrderInformationTable($data_array,true,$_SESSION['identity'],false);
  }
}elseif($state=="provide_so_date" || $state=="collection_date" || $state=="document_check_date" || $state=="case_closed_date" || $state=="cut_off_date" || $state=="onboard_date"){
  if($state=="cut_off_date"){
    $state_text="結關";
  }elseif($state=="onboard_date"){
    $state_text="開航";
  }
  $table=getBookingOrderFormDate($state,$data_array);
}elseif($state=="delfile"){
  $title="刪除檔案";
}
?>
<!doctype html>
<html lang="en">
  <head>
<?php 
  echo TESTransportStaffCommonHtmlHead("測試海運網後台",true);
?>
   </head>
  <script language="javascript">
function InputFileFileListShowStaffProvideFile(){
  $("#FileList").empty();
  var fragment = "";
  var extension_allows = new Array();
  extension_allows = ["pdf", "docx", "doc", "jpg", "jpeg","png","gif","xlsx"];
  $("input[name='attachments[]']").each(function(key){
    var fp=$("input[name='attachments[]']")[key];
    var lg = fp.files.length;
    var items = fp.files;
    if (lg > 0) {
      var fileName = items[0].name; // get file name
      var FileExtension1=getFileExtension1(fileName).toLowerCase();
      if(jQuery.inArray( FileExtension1, extension_allows )!== -1){
        fragment +="<div class='row'>";
        fragment +="<div class='col col d-flex align-items-start'>";
        fragment +="<button type='button' id='delfile"+key+"' class='btn btn-secondary' onclick=\"DelStaffProvideAttachment("+key+")\">"+fileName+" "+getDelUploadFileIcon();
        fragment +="</div></div>";
      }else{
        alert("格式限定：DOC、PDF、JPEG，請重新上傳檔案");
        fp.val(null);
        return false;
      }
    }
  })
  $("#FileList").append(fragment);
}

  function DelStaffProvideAttachment(key){
    $("input[name='attachments[]']")[key].value=null;
    InputFileFileListShowStaffProvideFile();
  }
  $(document).ready(function(){
    $("input[name='attachments[]']").change(function (e) {
      InputFileFileListShowStaffProvideFile();
    });
  });
  </script>
  <body>

<?php
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(true,"StaticWidowMessage");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  if($state!="information" && $state!="delfile" && 
    !getBookingOrderDepartmentPositionSchedulePriorityReturn($data_array['schedule'],$staff_array)){
    echo PopupStaticWidowHref($title,"無此權限進行修改","back",true,true);
    echo getBoostrapBlundleJsImportEnd();
    exit;
  }
  echo $table;
  if($state=="information"){
    echo "
    <div class='row'>
        <div class='col col-lg-5'>
        </div>
        <div class='cole col-auto'>
            <input type='button' value='回訂艙列表' onclick='history.back()' class='btn btn-secondary'>
        </div>
    </div>";
  }
?> 
</form>
  <?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if($data_array['schedule']==2 && $state=="provide_so_pending" && $data_array['cs_staff_id']==$staff_array['staff_id']){
  if(strtotime($data_array['cs_staff_date'])>strtotime($data_array['cut_off_date'])){
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."結關日期不可早於S/O日期","back",true,"StaticWidowMessage");
      exit;
  }
  list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
  $recipients=getAllSendMailDataDecide("staff","doc",false);
  if(sqlUpdateBookingOrderSchedule($id,3)){
    if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."S/O已完成","./StaffBookingOrderList.php?schedule=2",true,"StaticWidowMessage");
    }
  }
}elseif($data_array['schedule']==3 && $state=="document_check_pending" && $data_array['doc_staff_id']==$staff_array['staff_id']){
  if(strtotime($data_array['doc_staff_date'])<strtotime($data_array['onboard_date'])){
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."開航日期不可早於文件核對日期","back",true,"StaticWidowMessage");
      exit;
  }
  list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
  $recipients=getAllSendMailDataDecide("staff","financial",false);
  if(sqlUpdateBookingOrderSchedule($id,4)){
    if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."提供提單及帳單已完成","./StaffBookingOrderList.php?schedule=3",true,"StaticWidowMessage");
    }
  }
}

if(isset($_POST['date'])){
  $date=$_POST['date'];
  $path=getBookingOrderStaffAttachmentPath($data_array['schedule'],$data_array);
  if($path!==false){
    list($result,$message,$attachments)=getMultipleUploadFileAttachmentsArray("attachments",$path);
    $filename=implode(";",$attachments);
    if(!$result){
      echo $message;
      echo PopupStaticWidowHref($title,"錯誤","back",true,"StaticWidowMessage");
      exit;
    }
  }

  if(($data_array['schedule']==2 || $data_array['schedule']==3) && 
    ($state=="cut_off_date" || $state=="onboard_date")){
    $cut_off_date=false;
    $onboard_date=false;
    if($state=="cut_off_date"){
      $cut_off_date=$date;
    }elseif($state=="onboard_date"){
      $onboard_date=$date;
    }

    list($result,$message)=getBookingOrderStaffDateCutOffDateOnboardDateDecide($data_array,$cut_off_date,$onboard_date,$data_array['cs_staff_date'],false,false,false);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"StaticWidowMessage");
      exit;
    }
    if(getBookingOrderUpdateSqlStaffDateCutOffDateOnboardDate($id,$staff_array['staff_id'],$date,$state,$data_array['schedule'])){
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
        echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."已修改".$state_text."日期","./StaffBookingOrderList.php?schedule=".$data_array['schedule'],true,"StaticWidowMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."修改".$state_text."日期發生錯誤","./StaffBookingOrderList.php?schedule=".$data_array['schedule'],true,"StaticWidowMessage");
    }
  }

  if($data_array['schedule']==2 && $state=="provide_so_date"){
    if(isset($_POST['cut_off_date']) && isset($_POST['onboard_date'])){
      $cut_off_date=$_POST['cut_off_date'];
      $onboard_date=$_POST['onboard_date'];
    }else{
      $cut_off_date=$data_array['cut_off_date'];
      $onboard_date=$data_array['onboard_date'];
    }
    $cs_staff_date=$date;
    list($result,$message)=getBookingOrderStaffDateCutOffDateOnboardDateDecide($data_array,$cut_off_date,$onboard_date,$cs_staff_date,false,false,false);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"StaticWidowMessage");
      exit;
    }

    if(getBookingOrderUpdateSqlCsStaffDateAttachment($id,$staff_array,$date,$data_array,$filename,$cut_off_date,$onboard_date)){
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
        echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."已提供S/O日期","./StaffBookingOrderList.php?schedule=2",true,"StaticWidowMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"提供S/O日期修改失敗","./StaffBookingOrderList.php?schedule=2",true,"StaticWidowMessage");
    }
  }

  if($data_array['schedule']==3 && $state=="document_check_date"){
    $doc_staff_date=$date;
    list($result,$message)=getBookingOrderStaffDateCutOffDateOnboardDateDecide($data_array,$data_array['cut_off_date'],$data_array['onboard_date'],$data_array['cs_staff_date'],$doc_staff_date,false,false);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"StaticWidowMessage");
      exit;
    }

    if(getBookingOrderUpdateSqlDocStaffDateAttachment($id,$staff_array,$date,$data_array,$filename)){
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
        echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."提供提單及帳單日期已成功填寫","./StaffBookingOrderList.php?schedule=3",true,"StaticWidowMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"提單核對日期修改失敗","./StaffBookingOrderList.php?schedule=3",true,"StaticWidowMessage");
    }
  }
  if($data_array['schedule']==4 && $state=="collection_date"){
    $financial_staff_date=$date;
    list($result,$message)=getBookingOrderStaffDateCutOffDateOnboardDateDecide($data_array,$data_array['cut_off_date'],$data_array['onboard_date'],$data_array['cs_staff_date'],$data_array['doc_staff_date'],$financial_staff_date,false);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"StaticWidowMessage");
      exit;
    }
    if(sqlUpdateBookingOrderFinancialStaffDate($id,$staff_array['staff_id'],$date,$filename)){
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)  && sqlUpdateBookingOrderSchedule($id,5)){
        echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."收款日期已成功填寫，此案轉為等待結案","./StaffBookingOrderList.php?schedule=4",true,"StaticWidowMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"收款日期修改失敗","./StaffBookingOrderList.php?schedule=4",true,"StaticWidowMessage");
    }
  }
  if($state=="case_closed_date" && $data_array['schedule']==5){
    list($result,$message)=getBookingOrderStaffDateCutOffDateOnboardDateDecide($data_array,$data_array['cut_off_date'],$data_array['onboard_date'],$data_array['cs_staff_date'],$data_array['doc_staff_date'],$data_array['financial_staff_date'],$date);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"StaticWidowMessage");
      exit;
    }
    if(sqlUpdateBookingOrderCaseClosedStaffDate($id,$staff_array['staff_id'],$date)){
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial_number."結案日期已成功填寫，此案轉為已結案","./StaffBookingOrderList.php?schedule=6",true,"StaticWidowMessage");
    }else{
      echo PopupStaticWidowHref($title,"結案日期修改失敗","./StaffBookingOrderList.php?schedule=5",true,"StaticWidowMessage");
    }
  }
}elseif($state=="recieve"){
  if($data_array['schedule']==1){
    if(sqlUpdateStaffBookingOrderCsStaffIdSchedule($id,$staff_array['staff_id'],2)){
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
        echo PopupStaticWidowHref($title,$staff_array['ename']." ".$staff_array['elastname']."已成為訂艙編號:".$serial_number."客服人員","./StaffBookingOrderList.php?schedule=2",true,"StaticWidowMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"編號:".$serial_number."修改訂艙單客服人員失敗","./StaffBookingOrderList.php?schedule=1",true,"StaticWidowMessage");
    }
  }else{
    echo PopupStaticWidowHref($title,"編號:".$serial_number.$text."訂艙單資料接案失敗，此訂艙並不是待處理狀態。","./StaffBookingOrderList.php?schedule=1",true,"StaticWidowMessage");
  }
}elseif($state=="document_check"){
  if($data_array['schedule']==3){
    if(sqlUpdateStaffBookingOrderDocStaffId($id,$staff_array['staff_id'])){
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);      
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
        echo PopupStaticWidowHref($title,$staff_array['ename']." ".$staff_array['elastname']."已成為訂艙編號:".$serial_number."提單核對人員","./StaffBookingOrderList.php?schedule=3",true,"StaticWidowMessage");
      }
    }else{
      echo PopupWidowHref($title,"編號:".$serial_number."修改訂艙單提單核對人員失敗","./StaffBookingOrderList.php?schedule=3",true,"StaticWidowMessage");
    }
  }else{
    echo PopupStaticWidowHref($title,"編號:".$serial_number.$text."訂艙單資料失敗，此訂艙並不是等待提供S/O。","./StaffBookingOrderList.php?schedule=3",true,"StaticWidowMessage");
  }
}elseif($state=="collection"){
  if($data_array['schedule']==4){
    if(sqlUpdateStaffBookingOrderFinancialStaffId($id,$staff_array['staff_id'])){
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
        echo PopupStaticWidowHref($title,$staff_array['ename']." ".$staff_array['elastname']."已成為訂艙編號:".getSerialCombinationStr($data_array)."收款人員","./StaffBookingOrderList.php?schedule=4",true,"StaticWidowMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"編號:".$serial_number."修改訂艙單收款人員失敗","./StaffBookingOrderList.php?schedule=4",true,"StaticWidowMessage");
    }
  }else{
    echo PopupStaticWidowHref($title,"編號:".$serial_number.$text."訂艙單資料修改失敗，此訂艙並不是等待收款。","./StaffBookingOrderList.php?schedule=4",true,"StaticWidowMessage");
  }
}elseif($state=="cancel"){
  if($staff_array['staff_id']==$_SESSION['staff_id'] || strpos($data_array['position'],"總經理")!==false){
    if(sqlUpdateBookingOrderSchedule($id,8)){
      echo PopupStaticWidowHref($title,"編號:".$serial_number.$text."取消訂艙單資料完成","./StaffBookingOrderList.php?schedule=8",true,"StaticWidowMessage");
    }else{
      echo PopupStaticWidowHref($title,"編號:".$serial_number.$text."訂艙單資料取消失敗，請聯絡公司IT人員或者請再重新操作一次。","./StaffBookingOrderList.php?schedule=1",true,"StaticWidowMessage");
    }
  }else{
    echo PopupStaticWidowHref($title,"編號:".$serial_number.$text."訂艙單資料取消失敗，此訂艙並不是您處理或者不是最大權限。","./StaffBookingOrderList.php?schedule=2",true,"StaticWidowMessage");
  }
}elseif($state=="reply"){
  $schedule=$data_array["schedule"];
  $reduce_schedule=$schedule-1;
  if(getBookingOrderDepartmentPositionSchedulePriorityReturn($schedule,$staff_array,true)){
    list($result,$message)=getBookingOrderStaffIdStaffDateStaffAchmentPriorityMessage($data_array);
    if($result){
      if(getBookingOrderUpdateSqlReplySchedule($id,$reduce_schedule)){
        echo PopupStaticWidowHref($title,"將編號:".$serial_number."訂艙狀態還原至".getBookingOrderScheduleShowName($reduce_schedule),"back",true,"StaticWidowMessage");
        exit;
      }
      echo PopupStaticWidowHref($title,"編號:".$serial_number."訂艙狀態還原失敗，請連絡相關IT人員","back",true,"StaticWidowMessage");
      exit;
    }
    echo PopupStaticWidowHref($title,$message,"back",true,"StaticWidowMessage");
    exit;
  }
  echo PopupStaticWidowHref($title,"此人員無權限，請連絡相關IT人員","back",true,"StaticWidowMessage");
  exit;
}elseif($state=="delfile" && isset($_GET['key'])){
  $key=$_GET['key'];
  $serial=getSerialCombinationStr($data_array);
  $attachments=explode(";",$data_array['attachments']);
  if(isset($attachments[$key])){
    $filename=$attachments[$key];
    $path=getBookingOrderAttachPath($data_array).$filename;
    unset($attachments[$key]);
    $attachments=implode(";",$attachments);
    if(unlink($path) && sqlUpdateBookingOrderAttachments($id,$attachments)){
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial."已刪除".$filename."附檔。","back",true,"StaticWidowMessage");
    }else{
      echo PopupStaticWidowHref($title,"訂艙編號:".$serial."刪除失敗","back",true,"StaticWidowMessage");
    }
  }else{
    echo PopupStaticWidowHref($title,"訂艙編號:".$serial."無此附檔","back",true,"StaticWidowMessage");
  }
}
?>
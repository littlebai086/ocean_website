<?php
session_start();
require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../model/EmailNotificationMessage.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/EmailNotificationMessageController.php");
require_once("../../controllers/MemberController.php");
$table="";
$title="測試海運網";
if (isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,2,$id,false);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
list($result,$message)=getStaffPagePriorityReturn(2);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
<?php 
  echo TESTransportStaffCommonHtmlHead("測試海運網後台",true);
?>
<script language="javascript">
$(document).ready(function(){
  SelectMarqueeContentChangTextareaMessage();
  $('#inputGroupSelectContent').change(function(){
    SelectMarqueeContentChangTextareaMessage();
  })
});

function SelectMarqueeContentChangTextareaMessage(){
  if($("#inputGroupSelectContent").val()==1){
    $("#TextareaContent").val($("#TextareaDefaultContent").val());
    $("#TextareaContent").attr('readonly','readonly');
  }else if($("#inputGroupSelectContent").val()==2){
    $("#TextareaContent").val("");
     $("#TextareaContent").removeAttr('readonly');
  }
}
</script>
   </head>
  <body>

<?php
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(true,"StaticWidowMessage");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
?> 
<form action='' method='post' enctype='multipart/form-data'>
  <?php
    echo getStaffMemberSendMailNotificaionMessageForm($id,$state);
  ?>
</form>
  <?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['subject'])){
  if($state=="send_add"){
    $subject=addslashes(trim($_POST['subject']));
    $send_message=getTextareaChangeEnterSymbol(addslashes($_POST['message']));
    $path=getEmailNotificationMessageAttachPath(false);
    list($result,$message,$attachments)=getMultipleUploadFileAttachmentsArray("attachments",$path);
    $filename=implode(";",$attachments);
    if(!$result){
      echo $message;
      echo PopupStaticWidowHref($title,"錯誤","back",true,"StaticWidowMessage");
      exit;
    }
    $id=sqlInsertEmailNotificationMessage($subject,$send_message,$filename);
    if($id){
      if($filename){
        //請記得一定要判斷是否有檔名上傳否則會造成虛擬主機上錯誤
        CopyDirectory($path,getEmailNotificationMessageAttachPath(getEmailNotificationMessageId($id)));//將文件資料夾更改至資料庫時間點的資料夾
      }
      echo PopupStaticWidowHref($title,"請關閉此視窗後，再確認一次寄件相關訊息是否有誤，若為正確請點寄送","./StaffMemberSendMailNotificationMessage.php?state=send&id=".$id,true,"StaticWidowMessage");
      exit;
    }else{
      echo PopupStaticWidowHref($title,"新增失敗，請聯絡資訊相關人員","back",true,"StaticWidowMessage");
      exit;
    }
  }elseif($state=="send"){
    list($account,$auth)=getAccountAuth();
    $emailname="測試海運網";
    $data_array=getEmailNotificationMessageId($id);
    $subject=$data_array['subject'];
    $msg="<span style='font-family:Microsoft JhengHei;'>".$data_array['message']."</span>";
    $path=getEmailNotificationMessageAttachPath($data_array);
    $attach_array=array();
    if($data_array['filename']){
      $filenames=explode(";",$data_array['filename']);
      foreach($filenames as $key=>$filename){
        array_push($attach_array,$path.$filename);
      }
    }
    $buf=getAllSendMailDataDecide("member_all",false,false);
    $member_id_array=array();
    foreach($buf as $row){
      $recipients=getSendMailRecipientsArray($row['contact_name'],$row['contact_email']);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,false)){
        array_push($member_id_array,$row['member_id']);
        // 寄信成功....
      }else{
        // 寄信失敗，直接跳離迴圈....
        $member_id=implode(";", $member_id_array);
        sqlUpdateEmailNotificationMessageMemeberIdArrayPass($id,$member_id,2);
        echo PopupStaticWidowHref($title,"寄信失敗，請聯絡資訊部人員","./StaffMemberSendMailNotificationMessage.php",true,"StaticWidowMessage");
        exit;
      }
    }
    $member_id=implode(";", $member_id_array);
    sqlUpdateEmailNotificationMessageMemeberIdArrayPass($id,$member_id,1);
    echo PopupStaticWidowHref($title,"寄信成功全部寄完","./StaffMemberEmailNotificationMessageList.php",true,"StaticWidowMessage");
  }
}
?>
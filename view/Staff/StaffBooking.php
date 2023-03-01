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
if (isset($_GET['id'])){$id=$_GET['id'];}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state="add";}

if(isset($_POST['emp_booking'])){
  $title=$text."訂艙單";
  list($error,$data_array,$sum,$submit)=getStaffMemberCommonBookingOrderDataArray($state,$id,false,true);
}elseif($state=="update"){
  $title="修改".$text."訂艙單";
  list($error,$data_array,$sum,$submit)=getStaffMemberCommonBookingOrderDataArray($state,$id,false,false);
  $table=getBookingOrderFormHtml("staff",$state,$data_array);
}
if($data_array['trading']=="export"){
  $text="出口";
}else{
  $text="進口";
}
?>
<!doctype html>
<html lang="en">
  <head>
<?php 
  echo TESTransportStaffCommonHtmlHead("測試海運網後台",true,true);
?>
    <script src="../../js/BookingOrder.js"></script>
   </head>
  <body class="text-center">

<?php
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false,false,1);
  echo TESTransportStaffHeader(true);
  echo PopupCloseWidowHref("測試海運網","確認是否要刪除此檔案?","確認","取消","",false,1);
?> 
  <form method="post" action="" id="loginForm" enctype="multipart/form-data">
    <input type="text" name="trading" value="<?php echo $data_array['trading'];?>" hidden>
    <input type="text" name="schedule" value="<?php echo $data_array['schedule'];?>" hidden>
    <input type="text" id="error" value="<?php echo $error;?>" hidden>
    <input type="text" id="booking_order_id"  name="booking_order_id" value="<?php echo $data_array['booking_order_id'];?>" hidden>
  <div class="container-fluid" >
   <div class="row justify-content-md-center">
      <div class="col col-md-12" style="text-align:center">
        <h1 class="h3 mb-3 fw-normal"><?php echo $title;?></h1>
      </div>
    </div>
      <?php echo $table;?>
    <input type="submit" name="emp_booking" class="btn btn-success" value="<?php echo $submit;?>">
    <input type="button" value="回訂艙列表" onclick="history.back()" class="btn btn-secondary">
    <p class="mt-5 mb-3 text-muted"></p>
  </div>
  </form>

  <?php echo TESTransportStaffFooter();?>
</body>
</html>

<?php
if(isset($_POST['emp_booking'])){
  list($account,$auth)=getAccountAuth();
  $emailname="[聯絡訊息]測試海運網";
  if($state=="update"){
    $title="修改".$text."單";
  }
  $data_array['remark']=addslashes($data_array['remark']);
  list($result,$message)=getBookingOrderDecide($sum,$data_array);
  if(!$result){
    PopupWidowHref($title,$message,false,true,false);
    exit;
  }

  // if($state=="update"){
  //   list($result,$message,$data_array['attachments'])=getStaffMemberCommonBookingOrderAttachments($state,$id,false);
  //   if(!$result){
  //     echo PopupWidowHref($title,$message,"back",true,false);
  //     exit;
  //   }
  //   if(sqlUpdateBookingOrder($id,$data_array)){
  //     $booking_order_array=getBookingOrderId($id);
  //     $serial=$booking_order_array["serial_head"].$booking_order_array["serial_number"];
  //     if($booking_order_array['schedule']==2){
  //       $subject="測試中-【TEST測試物聯網】訂單狀態：訂單修改";
  //       $msg=getSendMailBookingOrderUpdateMsg(2,$booking_order_array);
  //       $attach_array=getBookingOrderSendMailAttachArray($serial,$booking_order_array['attachments']);
  //       $recipients=getSendMailRecipientsArray($booking_order_array['contact_name'],$booking_order_array['contact_email']);
  //       $cc=sqlSelectEmailAddressBookEmail("test;test_cc");
  //       if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
  //         echo PopupWidowHref($title,"修改".$text."訂艙單資料完成","./StaffBookingOrderList.php?schedule=".$booking_order_array['schedule'],true,false);
  //       }
  //     }
  //   }else{
  //     echo PopupWidowHref($title,"修改".$text."訂艙單資料失敗，請聯絡公司相關IT人員",false,true,false);
  //   }
  // }
}
?>

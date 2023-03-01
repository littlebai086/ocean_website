<?php
session_start();
//require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/BookingOrder.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/BookingController.php");

if (isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state="add";}
if (isset($_GET['trading'])){$trading=$_GET['trading'];}else{$trading="export";}
if($trading=="export"){
  $text="出口";
}else{
  $text="進口";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo TESTransportCommonHtmlHead("測試海運網訂艙");?>
    <script src="../../js/BookingOrder.js"></script>
    <script language="javascript">
    window.onload=function(){
    //讀取sessionStorage物件中的內容
      var myhtml= sessionStorage.getItem("myhtml");
    //不為空表示是返回上一步進入該頁面的。
      //console.log(myhtml);
      if($('#state').val()=="update"){
        sessionStorage.clear();
      }else if(myhtml!=null && $('#error').val()!="1"){
        //將sessionStorage物件中儲存的頁面新增到頁面中
        $("form").html(myhtml);

        //清空sessionStorage物件的內容。
        //console.log(myhtml);
        sessionStorage.clear();
        //console.log(myhtml);
      }
    }

// $(function(){
// window.addEventListener("popstate", function(e) {
//   var myhtml= sessionStorage.getItem("myhtml");
//   if(myhtml!=null){
//     //將sessionStorage物件中儲存的頁面新增到頁面中
//     $("form").html(myhtml);
//     //清空sessionStorage物件的內容。
//     //sessionStorage.clear();
//   }
// }, false);
// });

    </script>
    <link href="../../css/signin.css" rel="stylesheet">
   </head>
  <body class="text-center">
<?php
  echo PopupWidowScriptHiddenButton(false,21,"DeleteFileMessage");
  echo PopupWidowScriptHiddenButton(false,"ErrorMessage");
  echo PopupCloseWidowHref("測試海運網","確認是否要刪除此檔案?","確認","取消","",false,"DeleteFileMessage");
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  $member_array=getMemberUsername("alex@test.com");
  if(isset($_POST['emp_booking'])){
    $title=$text."訂艙單";
    list($error,$data_array,$sum,$submit)=getStaffMemberCommonBookingOrderDataArray($state,$id,$member_array,true);
    $form="";
  }elseif($state=="add"){
    $title="新增".$text."訂艙單";
    list($error,$data_array,$sum,$submit)=getStaffMemberCommonBookingOrderDataArray($state,$id,$member_array,false);
    $data_array['trading']=$trading;
    $form=getBookingOrderFormHtml("customer",$state,$data_array);
  }elseif($state=="update"){
    $title="修改".$text."訂艙單";
    list($error,$data_array,$sum,$submit)=getStaffMemberCommonBookingOrderDataArray($state,$id,$member_array,false);
    $form=getBookingOrderFormHtml("customer",$state,$data_array);
    if($member_array['member_id']!=$data_array['member_id']){
    echo PopupWidowHref($title,"請勿修改非自己的訂單編號","./MemberBookingOrderList.php",true,false);
    exit;
    }
  }
?>
  <form method="post" action="" enctype="multipart/form-data">
    <input type="text" name="trading" value="<?php echo $data_array['trading'];?>" hidden>
    <input type="text" id="error" value="<?php echo $error;?>" hidden>
    <input type="text" id="booking_order_id"  name="booking_order_id" value="<?php echo $data_array['booking_order_id'];?>" hidden>
  <div class="container-fluid" >
   <div class="row justify-content-md-center">
      <div class="col col-md-12" style="text-align:center">
        <h1 class="h3 mb-3 fw-normal"><?php echo $title;?></h1>
      </div>
    </div>
      <?php echo $form;?>
    <input type="submit" name="emp_booking" class="btn btn-success" value="<?php echo $submit;?>">
    <input type="button" value="回訂艙列表" onclick="location.href='./MemberBookingOrderList.php'" class="btn btn-secondary">
    <p class="mt-5 mb-3 text-muted"></p>
  </div>
  </form>
<div class="footer">
  <?php echo TESTransportStaffFooter();?>
</div>
</body>
</html>

<?php
if($member_array['pass']==0){
  echo PopupStaticWidowHref($title,"待會員證審查通過，才可使用此功能。","../index.php",true,"NotPassFunction");
}
if(isset($_POST['emp_booking'])){
  list($account,$auth)=getAccountAuth();
  $emailname="測試海運網";
  if ($state=="add"){
    $title="新增".$text."單";
  }elseif($state=="update"){
    $title="修改".$text."單";
  }
  $data_array['remark']=addslashes($data_array['remark']);
  list($result,$message)=getBookingOrderDecide($sum,$data_array);

  if(!$result){
    echo PopupStaticWidowHref($title,$message,"back",true,"ErrorMessage");
    exit;
  }

  if ($state=="add"){
    list($data_array['serial_head'],$data_array['serial_number'])=getSerialNumber();
    list($result,$message,$data_array['attachments'])=getStaffMemberCommonBookingOrderAttachments($state,$data_array);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"ErrorMessage");
      exit;
    }
    $id=sqlInsertBookingOrder($member_array,$data_array);
    if ($id){
      $recipients=getAllSendMailDataDecide("staff","cs",false);
      list($subject,$msg,$attach_array,$cc)=getSendBookingOrderSubjectMsgAttachCC($id,$state);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,$attach_array,$recipients,$cc)){
        echo PopupStaticWidowHref($title,$text."訂艙單完成，待等服務人員處理","./MemberBookingOrderList.php",true,21);
      }
    }else{
      echo PopupStaticWidowHref($title,$text."訂艙單失敗，請聯絡公司相關IT人員","back",true,"ErrorMessage");
    }
  }elseif($state=="update"){
    $booking_order_array=getBookingOrderId($id);
    list($result,$message,$data_array['attachments'])=getStaffMemberCommonBookingOrderAttachments($state,$booking_order_array);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"ErrorMessage");
      exit;
    }
    if($booking_order_array['schedule']==1 || $booking_order_array['schedule']==2){
      if(sqlUpdateBookingOrder($data_array['booking_order_id'],$data_array)){
        echo PopupStaticWidowHref($title,"修改".$text."訂艙單資料完成","./MemberBookingOrderList.php",true,21);
      }else{
        echo PopupStaticWidowHref($title,"修改".$text."訂艙單資料失敗，請聯絡公司相關IT人員","back",true,"ErrorMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"修改".$text."訂艙單資料失敗，狀態錯誤","./MemberBookingOrderList.php",true,"ErrorMessage");
    }
  }
}
?>

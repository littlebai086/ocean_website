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
?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo TESTransportCommonHtmlHead("測試海運網訂艙單");?>
    <link href="../../css/signin.css" rel="stylesheet">
   </head>
  <body class="text-center">
<?php
  echo TESTransportCommonHtmlBody();
  echo PopupWidowScriptHiddenButton(false);
  list($result,$html)=TESTransportHeader(true,false);
  echo $html;
  if(!$result){exit;}
  $member_array=getMemberUsername($_SESSION['username']);
  if($state=="information"){
    $title="詳細資訊";
    $error=false;
    $data_array=getBookingOrderId($id);
    if($data_array){
      if($member_array['member_id']==$data_array['member_id']){
        $table=getBookingOrderInformationTable($data_array,true,$_SESSION['identity'],false);
      }
    }
  }elseif($state=="cancel"){
    $title="取消訂單";
    $data_array=getBookingOrderId($id);
    if($data_array['trading']=="export"){
      $text="出口";
    }else{
      $text="進口";
    }
  }elseif($state=="delfile"){
    $title="刪除檔案";
    $data_array=getBookingOrderId($id);
  }
  if($member_array['member_id']!=$data_array['member_id']){
    echo PopupWidowHref($title,"請勿查詢非自己的訂艙編號","./MemberBookingOrderList.php",true,false);
    exit;
  }
  
  echo $table;
?> 
 <input type="button" value="回訂艙列表" onclick="location.href='./MemberBookingOrderList.php'" class="btn btn-secondary">
<div class="footer">
  <?php echo TESTransportFooter();?>
</div>
</body>
</html>

<?php
if($member_array['pass']==0){
  echo PopupStaticWidowHref($title,"待會員證審查通過，才可使用此功能。","../index.php",true,"NotPassFunction");
}
if($state=="information" && !$data_array){
  echo PopupWidowHref($title,"資料出現錯誤，請聯絡相關IT人員","./MemberBookingOrderList.php",true,false);
}elseif($state=="information" && ($data_array['member_id']!=$member_array['member_id'])){
  echo PopupWidowHref($title,"資料出現錯誤","./MemberBookingOrderList.php",true,false);
}elseif($state=="cancel"){
  if (($data_array['schedule']==1 || $data_array['schedule']==2 ) && $data_array['member_id']==$member_array['member_id']){
    if(sqlUpdateBookingOrderSchedule($id,7)){
      echo PopupWidowHref($title,"取消".$text."訂艙單資料完成","./MemberBookingOrderList.php",true,false);
    }else{
      echo PopupWidowHref($title,"取消".$text."訂艙單資料失敗，請聯絡公司IT人員或者請再重新操作一次。","./MemberBookingOrderList.php",true,false);
    }
  }
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
      echo PopupWidowHref($title,"訂單編號:".$serial."已刪除".$filename."附檔。","back",true,false);
    }else{
      echo PopupWidowHref($title,"訂單編號:".$serial."刪除失敗","back",true,false);
    }
  }else{
    echo PopupWidowHref($title,"訂單編號:".$serial."無此附檔","back",true,false);
  }
}
?>
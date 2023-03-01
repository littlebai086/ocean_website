<?php
session_start();
require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../model/BookingOrder.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/BookingController.php");
require_once("../../controllers/MemberController.php");
if(isset($_GET['state'])){$state=$_GET['state'];}elseif(isset($_POST['state'])){$state=$_POST['state'];}else{$state=false;}
if(isset($_GET['id'])){$staff_id=$_GET['id'];}else{$staff_id=false;}
if(isset($_GET['pass'])){$pass=$_GET['pass'];}else{$pass=false;}
list($result,$message)=getStaffStatePriorityReturn($state,2,$staff_id,false);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}

$form="";
$table="";
$button_html="";
if(isset($_POST['emp_edit_send'])){
  $id=$_GET['id'];
  $title="會員修改";
  $submit="修改";
  $data_array=getMemberId($id);
}elseif($state=="add_blacklist" || $state=="remove_blacklist"){
  $id=$_GET['id'];
  $title="黑名單";
  $submit="";
  $data_array=getMemberId($id);
}elseif($state=="information" || $state=="pass" || $state=="information_statistics"){
  $id=$_GET['id'];
  $title="會員資訊";
  $submit="";
  $data_array=getMemberId($id);
  $form=getMemberInformationForm($state,$_SESSION['identity'],$data_array,$pass);
  if($state=="information_statistics"){
    $table=getStaffMemberStatisticsInformationTable($id);
  }
}elseif($state=="update"){
  $id=$_GET['id'];
  $title="會員修改";
  $submit="修改";
  $data_array=getMemberId($id);
  $form=getMemberInformationForm($state,$_SESSION['identity'],$data_array,$pass);
}
?>
<!doctype html>
<html lang="en">
  <head>
  <?php 
    echo TESTransportStaffCommonHtmlHead("測試海運網後台",true);
  ?>
<script src="../../js/MemberRegisterInformation.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>
<script language="javascript">
function ajax_member_statistics(){
    $.ajax({
      type: 'POST',
      url: '../../Action/MemberAction.php',
      async:false,
      data: {
        action: 'statistics',
        member_id: $("#member_id").val(),
        dataType: "json" 
      },
      success:function(item){
        item=JSON.parse(item);
        $("#statistics").val(item);
      },
      error:function(item){
        item=false;
      }
    });
}
window.onload = function() {
  if($("#state").val()=="information_statistics"){
    ajax_member_statistics();
    item=$("#statistics").val();
    var ctx = document.getElementById("chart-area");
    //標籤若超過兩個要用陣列表示，若沒有就是字串表示
    var myChart = new Chart(ctx, {
    type: "line", //圖表類型
    "data": {
      "labels": item["year_month_array"],
      "datasets": [{
        "label": "登入次數",
        "data": item["login_statistics_array"],
        "fill": false,
        "borderColor": "red",
        "lineTension": 0.1
      },{
        "label": "下單次數",
        "data": item["booking_order_statistics_array"],
        "fill": false,
        "borderColor": "blue",
        "lineTension": 0.1
      }]
    },
    "options": {
      scales: {
        yAxes: [{
          ticks: {
            stepSize: 1,
              min:0
            }
        }]
      }
    }
  });
  }
}
$(document).ready(function(){
  SelectPassChangTextareaMessage();
  $('#inputGroupSelectPass').change(function(){
    SelectPassChangTextareaMessage();
  })
});

function SelectPassChangTextareaMessage(){
  if($("#inputGroupSelectPass").val()==1){
    $("#TextareaPassMessage").val("您所輸入的公司統一編號，本公司無法查到此統一編號有辦理商工登記，所以沒有通過您的會員註冊申請。");
     $("#TextareaPassMessage").attr('readonly','readonly');
  }else if($("#inputGroupSelectPass").val()==2){
    $("#TextareaPassMessage").val("TEST 測試海運網尚未開放給同行使用，所以沒有通過您的會員註冊申請。");
    $("#TextareaPassMessage").attr('readonly','readonly');
  }else if($("#inputGroupSelectPass").val()==3){
    $("#TextareaPassMessage").val("");
     $("#TextareaPassMessage").removeAttr('readonly');
  }
}
function ButtonUpdatePassFrom(){
  if($("form")[0].reportValidity()){
    $("form").submit();
  }
}

</script>

<style>

</style>
</head>
  <body>
<?php
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false,"StaffAuditMemberMessageResult");
?>
<!-- Modal -->
  <form method="post" action="" >
    <input type="text" id="state" name="state" value="<?php echo $state;?>" hidden>
    <input type="text" id="member_id" name="member_id" value="<?php echo $data_array['member_id'];?>" hidden>
    <div id='statistics' hidden></div>
    <div class="container-fluid">
      <div class="row justify-content-md-center">
        <div class="col-auto">
          <?php 
          if($state=="information_statistics"){
            echo '<canvas id="chart-area" ></canvas>';
          }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-5">
        </div>
        <div class="col-auto">
          <?php echo $table;?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h1 class="h3 mb-3 fw-normal text-center"><?php echo $title;?></h1>
        </div>
      </div>
      <?php echo $form;?>
    </div>
    <?php 
    if($submit){
    $button_html.= '<input type="submit" name="emp_edit_send" class="btn btn-success" value="'.$submit.'"> ';
    }
    if($state=="information" && $data_array['pass']==0){
      $button_html.= "<input type='button' value='修改會員資訊' class='btn btn-primary' onclick=\"location.href='./StaffMemberInformation.php?state=update&id=".$id."'\">
      <input type='button' value='審核通過' class='btn btn-success' onclick=\"location.href='./StaffMemberInformation.php?state=pass&pass=1&id=".$id."'\">
      <input type='button' value='審核不通過' class='btn btn-danger' onclick=\"location.href='./StaffMemberInformation.php?state=pass&pass=2&id=".$id."'\">";
    }elseif($state=="pass"){
      if($pass==1){$button="審核通過";$class="btn btn-success";}elseif($pass==2){$button="審核不通過";$class="btn btn-danger";}
      $button_html.= "<input type='text' id='pass' name='pass' value='".$pass."' hidden>";
      $button_html.= "<input type='button' value='".$button."' class='".$class."' onclick=\"ButtonUpdatePassFrom()\">";
    }
    if($state=="information_statistics"){
      $button_html.="<input type='button' value='回會員統計列表' onclick=\"location.href='./StaffMemberDataStatisticsList.php'\" class='btn btn-secondary'>";
    }else{
      $button_html.='<input type="button" value="回會員列表" onclick="location.href=\'./StaffMemberList.php?pass=1\'" class="btn btn-secondary">';
      //$button_html.='<input type="button" value="回上一頁" onclick="history.back()" class="btn btn-secondary">';
    }
    echo "<p class='text-center'>".$button_html."</p>";
    ?>
    
  </div>
  </form>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php
          getStaffMemberBookingOrderMonthNum($id);
        ?>
      </div>
    </div>
  </div>
  <?php echo TESTransportStaffFooter();?>
  </body>
  
</html>
<?php
if($state=="add_blacklist"){
  if(sqlUpdateMemberIdPass($id,3,"")){
    echo PopupStaticWidowHref($title,$data_array['username']."帳號成功加入黑名單","./StaffMemberList.php?pass=3",true,"StaffAuditMemberMessageResult");
    exit;
  }else{
    echo PopupStaticWidowHref($title,$data_array['username']."帳號加入黑名單失敗","./StaffMemberList.php?pass=1",true,"StaffAuditMemberMessageResult");
    exit;
  }
}elseif($state=="remove_blacklist"){
  if(sqlUpdateMemberIdPass($id,1,"")){
    echo PopupStaticWidowHref($title,$data_array['username']."帳號成功移除黑名單","./StaffMemberList.php?pass=1",true,"StaffAuditMemberMessageResult");
    exit;
  }else{
    echo PopupStaticWidowHref($title,$data_array['username']."帳號移除黑名單失敗","./StaffMemberList.php?pass=3",true,"StaffAuditMemberMessageResult");
    exit;
  }
}
if(isset($_POST['pass'])){
  $pass=$_POST['pass'];
  $pass_message=addslashes(nl2br($_POST['pass_message']));
  if($pass==1){$message="通過";$subject="【TEST測試海運網】會員註冊成功";}elseif($pass==2){$message="沒有通過";$subject="【TEST測試海運網】會員註冊審核沒有通過";}
  list($account,$auth)=getAccountAuth();
  $emailname="測試海運網";
  $recipients=array(array("email"=>$data_array['username'],"name"=>$data_array['contact_name']));
  $msg=getSendMailMemberPassMsg($pass,$pass_message);
  if(sqlUpdateMemberIdPass($id,$pass,$pass_message)){
    if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,false,$recipients,false)){
      echo PopupStaticWidowHref($title,$data_array['username']."帳號審核".$message,"./StaffMemberList.php?pass=".$pass,true,"StaffAuditMemberMessageResult");
      exit;
    }
  }else{
    echo PopupWidowHref($title,"修改會員資料失敗，請聯絡公司相關IT人員",false,true,false);
    exit;
  }
}elseif(isset($_POST['emp_edit_send'])){
  if ($state=="update"){
    $title="測試會員修改";
    $data_array['company_chinese']=$_POST['company_chinese'];
    $data_array['company_english']=$_POST['company_english'];
    $data_array['area_id']=$_POST['area_id'];
    $data_array['company_address']=trim($_POST['company_address']);
    list($result,$message)=getStaffMemberCommonDecide($data_array);
    if(!$result){
      echo PopupStaticWidowHref($title,$message,"back",true,"StaffAuditMemberMessageResult");
      exit;
    }
    if(sqlUpdateMemberCompanyChineseCompanyEnglish($id,$data_array['company_chinese'],$data_array['company_english'],$data_array['area_id'],$data_array['company_address'])){
      echo PopupStaticWidowHref($title,"修改會員資料完成","./StaffMemberInformation.php?state=information&id=".$id,true,"StaffAuditMemberMessageResult");
    }else{
      echo PopupStaticWidowHref($title,"修改會員資料失敗，請聯絡公司相關IT人員","back",true,"StaffAuditMemberMessageResult");
    }
  }
}
?>

<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Staff.php");
require_once("../../model/BookingOrder.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/StaffController.php");
require_once("../../controllers/BookingController.php");
require_once("../../controllers/StaffBookingOrderTransferController.php");
if(isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
if(isset($_GET['id'])){$staff_id=$_GET['id'];}else{$staff_id=false;}
list($result,$message)=getStaffStatePriorityReturn($state,1,$staff_id,false);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$title="移交人員變更";
$staff_array=getStaffListStaffId($staff_id);
if(isset($_POST["schedule"])){$schedule=$_POST["schedule"];}else{$schedule=getStaffBookingOrderTransferDefaultSchedule($staff_array);}
?>
<!doctype html>
<html lang="en">
  <head>
<?php 
  echo QATransportStaffCommonHtmlHead("測試海運網後台",true);
?>
   </head>
  <body class="text-center">
<script type="text/javascript" language="javascript">
function CustmerTransferCheckedLengthSubmitDisabled(){
  if($("input[name='customer_transfer[]']:checked").length>0){
    $("#submitTransfer").prop('disabled', false);
  }else{
    $("#submitTransfer").prop('disabled', true);
  }
}
$(document).ready(function(){
  $('#selectSchedule').change(function(){
   $("#formSchedule").submit();
  })

  $("#checked").click(function () {
    if(this.checked){
      $("input[name='customer_transfer[]']").prop("checked", true);
    }else{
      $("input[name='customer_transfer[]']").prop("checked", false);
    }
    CustmerTransferCheckedLengthSubmitDisabled();
  });

  customer_transfer=$("input[name='customer_transfer[]']");
  customer_transfer.prop('required', true);
  customer_transfer.on('click', function(){
    if (customer_transfer.is(':checked')) {
      customer_transfer.prop('required', false);
    } else {
      customer_transfer.prop('required', true);
    }
    CustmerTransferCheckedLengthSubmitDisabled();
  });
});
</script>
<?php
  list($result,$html)=QATransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false,"TransferMessage");
?>

  <div class="container-fluid">
    <div class="row">
      <div class="col col d-flex align-items-center">
        <form action="" method="post" id="formSchedule">
        <select name="schedule" id="selectSchedule" class="form-select">
          <?php 
            if($state=="transfer"){
              echo getStaffBookingOrderTransferScheduleSelect($staff_array,$schedule);
            }
          ?>
        </select>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col col-auto d-flex align-items-center">
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">
          <?php 
            echo $staff_array['cname'];
          ?>
          客戶移交至
          </span>
          <form action="" method="post" id="formTransferStaff">
          <input type='text' name="schedule" class="form-select" value="<?php echo $schedule;?>" hidden>
          <select name="transfer_staff_id" class="form-select">
            <?php 
              if($state=="transfer"){
                echo getStaffBookingOrderTransferStaffIdSelect($staff_id,$schedule);
              }
            ?>
          </select>
        </div>
      <div class="col col-lg-2">
        <input type="submit" class="btn btn-success" id='submitTransfer' name='emp_edit_send' value='移交' disabled="disabled">
      </div>
    </div>

    <table class="table table-success table-striped table-hover caption-top">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">訂艙編碼</th>
      <th scope="col">中文名稱</th>
      <th scope="col">產品性質</th>
      <th scope="col">訂單內容</th>
      <th scope="col">交櫃地點</th>
      <th scope="col" colspan="2">目的港</th>
      <th scope="col">訂單建立日期</th>
      <th scope="col"><input type="checkbox" class="form-check-input" id='checked'></th>
    </tr>
  </thead>
  <?php 
  if($state=="transfer"){
    if(getBookingOrderCsDocFinancialStaffId($staff_id,$schedule)){
      $table=getStaffBookingOrderTransferTable($staff_id,$schedule);
    }else{
      $table= "<tr><td colspan='10'>目前已沒有處理中案件</td></tr>";
    }
    echo $table;
  }
  ?>
</table>
  </div>
</form>
  <?php echo QATransportStaffFooter();?>
</body>
</html>
<?php
if($state=="resign" || $state=="furlough" || $state=="reinstatement"){
  $staff_state_id=$_GET['staff_state_id'];
  if ($state=="resign"){
    $message="離職";
    if(getStaffBookingOrderTransferCassInProcessDecide($staff_array)){
      echo PopupStaticWidowHref($title,$staff_array['cname']."目前尚有客戶正在處理訂單中，請將客戶移交再把人員變更為".$message."人員","./StaffList.php",true,"TransferMessage");
      exit;
    }
  }elseif($state=="furlough"){
    $message="留職停薪";
    if(getStaffBookingOrderTransferCassInProcessDecide($staff_array)){
      echo PopupStaticWidowHref($title,$staff_array['cname']."目前尚有客戶正在處理訂單中，請將客戶移交再把人員變更為".$message."人員","./StaffList.php",true,"TransferMessage");
      exit;
    }
  }elseif($state=="reinstatement"){
    $message="在職";
  }
  if(sqlUpdateStaffListStaffStateId($staff_id,$staff_state_id)){
    if($state=="resign" || $state=="furlough"){
      if(sqlDeleteStaffAccountListStaffId($staff_id)){
        echo PopupStaticWidowHref($title,$staff_array['cname']."已變為".$message."人員","./StaffList.php",true,"TransferMessage");
      }else{
        echo PopupStaticWidowHref($title,"員工編號".$staff_id."刪除帳戶失敗","./StaffList.php",true,"TransferMessage");
      }
    }elseif($state=="reinstatement"){
      list($username,$password)=getAccountPassword($staff_id);
      if (sqlInsertStaffAccountList($staff_id,$username,$password)){
          echo PopupStaticWidowHref($title,$staff_array['cname']."已變為".$message."人員","./StaffList.php",true,"TransferMessage");
      }else{
          echo PopupStaticWidowHref($title,"員工編號".$staff_id."帳戶新增失敗","./StaffList.php",true,"TransferMessage");
      }
    }
  }else{
    echo PopupStaticWidowHref($title,$staff_array['cname']."變更資料失敗","./StaffList.php",true,"TransferMessage");
  }
}

if(isset($_POST['emp_edit_send'])){
  if(sqlUpdateBookingOrderStaffId($schedule,$_POST['transfer_staff_id'],$_POST['customer_transfer'])){
    echo PopupWidowHref($title,"移交人員更換成功","./StaffList.php",true,false);
  }else{
    echo PopupWidowHref($title,"修改移交人員失敗",false,true,false);
  }
}
?>
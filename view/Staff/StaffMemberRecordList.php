<?php
require_once("../../model/CommonSql.php");
require_once("../../model/IpLog.php");
require_once("../../model/Member.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/IpLogController.php");
session_start();
$form="";
list($result,$message)=getStaffPagePriorityReturn(7);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$search_fields=array();
$fields=array("start_date","end_date");
foreach ($fields as $field){
  if (isset($_POST[$field])){
    $search_fields[$field]=trim($_POST[$field]);
  }else{
    $search_fields[$field]=date("Y-m-d",strtotime("-1 day"));
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <?php 
    echo QATransportStaffCommonHtmlHead("測試海運網後台",true);
  ?>
</head>
<body>
<?php 
  list($result,$html)=QATransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false,"StaffMemberRecordLogMessage");
  $table=getStaffMemberRecordSearchTable($search_fields);
?>
<div class="container-fluid">
<form action="" method="post">
  <input type="text" id="page" name="page" value="<?php echo $page;?>" hidden>
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputStartDate" class="control-label">開始日期</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center" >
        <input type="date" class="form-control" id="inputStartDate" name="start_date" value="<?php echo $search_fields['start_date'];?>" max="<?php echo date("Y-m-d",strtotime("-1 day"));?>">
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputEndDate" class="control-label">結束日期</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center" >
        <input type="date" class="form-control" id="inputEndDate" name="end_date" value="<?php echo $search_fields['end_date'];?>" max="<?php echo date("Y-m-d",strtotime("-1 day"));?>">
      </div>
    </div>
<!--       <div class="col col-lg-1 d-flex align-items-center">   
        <span class="text-nowrap">選擇查看項目</span>
      </div>
      <div class="col col d-flex align-items-center" > -->
        <?php
          // $ids=array("inlineRadioMemberIp","inlineRadioBookingOrderDownload","inlineRadioRegister","inlineRadioBookingOrderBrowse");
          // $values=array("member_ip","booking_order_download","register","booking_order_browse");
          // $labels=array("不同IP登入","下載報價單","註冊及驗證碼會員","訂艙頁面瀏覽");
          // echo getHtmlFormCheckInlineInputRadio("select_item",$ids,$values,$labels,$search_fields['select_item']);
        ?>
<!--         
      </div> -->
      
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="submit" value="查詢" class="btn btn-success">
      </div>
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="button" value="清除查詢" id='test1' onclick="location.href='./StaffMemberRecordList.php'" class="btn btn-secondary">
      </div>
      <div class="col">
      </div>
    </div>
  </div>
</form>
<table class="table table-success table-striped table-hover caption-color-dark caption-top text-start">
  <caption style="font-size: 20px;font-weight:bold;">統計紀錄列表</caption>
   <thead>
    <tr>
      <th scope="col">日期</th>
      <th scope="col">不同IP登入</th>
      <th scope="col">下載報價單</th>
      <th scope="col">驗證碼</th>
      <th scope="col">註冊會員</th>
      <th scope="col">有驗證碼無註冊會員</th>
      <th scope="col">訂艙頁面瀏覽</th>
      <th scope="col">訂艙瀏覽E-Mail</th>
      
    </tr>
  </thead>
  <?php
    echo $table;
  ?>
</table>

</div>
<?php echo QATransportStaffFooter();?>
</body>
</html>

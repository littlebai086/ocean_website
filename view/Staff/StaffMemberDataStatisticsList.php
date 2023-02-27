<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");
list($result,$message)=getStaffPagePriorityReturn(2);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$search_fields=array();
$fields=array("start_date","end_date","member_login_sort","booking_order_sort","main_sort");
foreach ($fields as $field){
  if (isset($_POST[$field])){
    $search_fields[$field]=trim($_POST[$field]);
  }
}
if(!isset($_POST['member_login_sort'])){
  $search_fields['member_login_sort']="asc";
  $search_fields['booking_order_sort']="asc";
  $search_fields['main_sort']="member_login";
  $search_fields['start_date']='2022-06';
  $search_fields['end_date']=date("Y-m");
}
$page_total=count(sqlSelectMemberLoginLogDataStatisticsList($search_fields,false,false));
if (isset($_POST['page'])){$page= intval(trim($_POST['page']));}else{$page=1;}
list($page_text,$page,$start,$per)=getListPageText($page,$page_total);
$table=getStaffMemberDataStatisticsListSearchTable($search_fields,$start,$per);

?>
<!doctype html>
<html lang="en">
  <head>
    <?php 
      echo QATransportStaffCommonHtmlHead("測試海運網後台",true);
    ?>
      <script language="javascript">

        $(document).ready(function(){
          $('input[type=radio]').click(function(){
            $("form").submit();
          })
          $('input[type=checkbox]').click(function(){
            if(this.checked){
              $('input[type=checkbox]').not(this).prop("checked",false);
              $("form").submit();
            }
          })

        });
    </script>
   </head>
  <body>
<?php
  list($result,$html)=QATransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false);
?>
<form action="" method="post">
  <input type="text" id="page" name="page" value="<?php echo $page;?>" hidden>
  <input type="text" name="pass" value="<?php echo $pass;?>" hidden>
  <div class="container-fluid">
    <div class="row">
      <div class="col col-lg-2 d-flex align-items-center" >
        <label for="inputUsername" class="control-label">開始日期</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="month" class="form-control" id="DateMonthStartDate" min='2022-06' value="<?php echo $search_fields['start_date'];?>" name="start_date" >
      </div>
      <div class="col col-lg-2 d-flex align-items-center" >
        <label for="inputUsername" class="control-label">結束日期</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="month" class="form-control" id="DateMonthEndDate" name="end_date" min='2022-06' max="<?php echo date("Y-m");?>" value="<?php echo $search_fields['end_date'];?>">
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-2 d-flex align-items-center" >
        <label for="inputUsername" class="control-label">會員登入次數排序</label>
      </div>
      <div class="col col-lg-3 d-flex align-items-center">
        <?php
          $ids=array("inlineRadioMemberLoginSortAsc","inlineRadioMemberLoginSortDesc");
          $values=array("asc","desc");
          $labels=array("小-大","大-小");
          echo getHtmlFormCheckInlineInputRadio("member_login_sort",$ids,$values,$labels,$search_fields['member_login_sort']);
          echo getHtmlFormCheckInlineInputCheckBoxCheckedOne("main_sort","member_login","主排序",$search_fields['main_sort']);
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-2 d-flex align-items-center" >
        <label for="inputUsername" class="control-label">會員訂艙次數</label>
      </div>
      <div class="col col-lg-3 d-flex align-items-center">
        <?php
          $ids=array("inlineRadioBookingOrderSortAsc","inlineRadioBookingOrderSortDesc");
          echo getHtmlFormCheckInlineInputRadio("booking_order_sort",$ids,$values,$labels,$search_fields['booking_order_sort']);
          echo getHtmlFormCheckInlineInputCheckBoxCheckedOne("main_sort","booking_order","主排序",$search_fields['main_sort']);
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="submit" value="查詢" class="btn btn-success">
      </div>
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="button" value="清除查詢" onclick="location.href='./StaffMemberDataStatisticsList.php'" class="btn btn-secondary">
      </div>
      <div class="col">
      </div>
    </div>
  </div>
</form>
<table class="table table-success table-striped table-hover caption-top">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">使用者帳號</th>
      <th scope="col">公司中文名稱</th>
      <th scope="col">公司英文名稱</th>
      <th scope="col">統一編號</th>
      <th scope="col">聯絡人名稱</th>
      <th scope="col">會員登入次數</th>
      <th scope="col">會員訂艙次數</th>
      <th scope="col">編輯</th>
    </tr>
  </thead>
  <?php

  echo $table;
  ?>
</table>
<?php 
  echo $page_text;
?>

  <?php echo QATransportStaffFooter();?>
</body>
</html>

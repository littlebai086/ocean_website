<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../model/BookingOrder.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");
require_once("../../controllers/BookingController.php");
if(isset($_GET['schedule'])){$schedule=$_GET['schedule'];}elseif(isset($_POST['schedule'])){$schedule=$_POST['schedule'];}else{$schedule=1;}
list($result,$message)=getStaffPagePriorityReturn(6);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$search_fields=array();
$fields=array("serial_head","serial_number","username","tax_id_number","company_chinese","contact_email","destination_country_id","destination_id","purchase_order_no","create_time");

foreach ($fields as $field){
  if (isset($_POST[$field])){
    $search_fields[$field]=trim($_POST[$field]);
  }else{
    $search_fields[$field]="";
  }
}
$search_fields["schedule"]=$schedule;
$page_total=count(sqlSelectStaffBookingOrderSchedule($search_fields,false,false));
if (isset($_POST['page'])){$page= intval(trim($_POST['page']));}else{$page=1;}
list($page_text,$page,$start,$per)=getListPageText($page,$page_total);


?>
<!doctype html>
<html lang="en">
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
  echo getBookingOrderCommonListPopupButtonWidowHref();
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  $table=getStaffBookingOrderScheduleSearchTable("single",$_SESSION['staff_id'],$search_fields,$start,$per);
?>
<div class="container-fluid">
<form action="" method="post">
  <input type="text" id="page" name="page" value="<?php echo $page;?>" hidden>
  <input type="text" name="schedule" value="<?php echo $schedule;?>" hidden>
  
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputSerialNumber" class="control-label">訂艙編號</label>
      </div>
      <div class="col col-lg-2" >
        <div class="input-group d-flex align-items-center">
          <select class="form-control" id="SelectSerialHead" name="serial_head"><?php echo getBookingOrderSerialHeadSelect($search_fields['serial_head']);?></select>
          <input type="text" class="form-control w-25" id="inputSerialNumbere" name="serial_number" value="<?php echo $search_fields['serial_number'];?>">
        </div>
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
<!--         <label for="inputCompanyChinese" class="control-label">公司中文名稱</label>
 -->        
       <span class="text-nowrap">公司中文名稱</span> 
      </div>
      <div class="col col-lg-2 d-flex align-items-center" >
        <input type="text" class="form-control" id="inputCompanyChinese" name="company_chinese" value="<?php echo $search_fields['company_chinese'];?>">
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
       <label for="inputPurchaseOrderNo" class="control-label">貴公司訂艙編號</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="text" class="form-control" id="inputPurchaseOrderNo" name="purchase_order_no" value="<?php echo $search_fields['purchase_order_no'];?>">
      </div>
      <div class="col">
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputCreateTime" class="control-label">訂艙日期</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="month" class="form-control" id="inputCreateTime" name="create_time" value="<?php echo $search_fields['create_time'];?>">
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputDestination" class="control-label">目的地</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <select class="form-select" id="DestinationCountryDestinationAll" name="destination_country_id">
          <option value="all">ALL</option>
           <?php
            echo getCountryNotDelOptionCountryEnglishValueCountryId($search_fields['destination_country_id']);
           ?>
          </select>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
       <select class="form-select" id="Destination" name="destination_id">
          <?php
          if($search_fields['destination_country_id']!="all"){
            echo "<option value='all'>ALL</option>";
            echo getDestinationOptionDestinationEnglishValueId($search_fields['destination_country_id'],$search_fields['destination_id']);
          }
          ?>
       </select>
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="submit" value="查詢" class="btn btn-success">
      </div>
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="button" value="清除查詢" id='test1' onclick="location.href='./StaffBookingOrderList.php?schedule=<?php echo $schedule;?>'" class="btn btn-secondary">
      </div>
      <div class="col">
      </div>
    </div>
  </div>
</form>
<table class="table table-success table-striped table-hover caption-color-dark caption-top text-start">
  <caption style="font-size: 20px;font-weight:bold;"><?php echo getBookingOrderScheduleShowName($schedule);?></caption>
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">訂艙編號</th>
      <th scope="col">公司名稱</th>
      <th scope="col">貴公司訂艙編號</th>
      <th scope="col">產品性質</th>
      <th scope="col">訂艙內容</th>
      <th scope="col">交櫃地點</th>
      <th scope="col" colspan="2" width="10%">目的地</th>
      <th scope="col">訂艙建立日期</th>
      <th scope="col" width="auto"></th>
    </tr>
  </thead>
  <?php

  echo $table;
  ?>
</table>

<?php 
  echo $page_text;
?>
</div>
<?php echo QATransportStaffFooter();?>

</body>
</html>
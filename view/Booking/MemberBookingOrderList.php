<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/BookingOrder.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/BookingController.php");

$search_fields=array();
$fields=array("serial_head","serial_number","dangerous_goods","cut_off_place_id","country_id","destination_id","order_statue","create_time");
foreach ($fields as $field){
  if (isset($_POST[$field])){
    $search_fields[$field]=trim($_POST[$field]);
  }elseif($field=="dangerous_goods"){
    $search_fields[$field]=true;
  }else{
    $search_fields[$field]="";
  }
}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
if (isset($_POST['page'])){$page= intval(trim($_POST['page']));}else{$page=1;}
if($state=="update"){
  $caption_text="訂艙修改";
}elseif($state=="cancel"){
  $caption_text="訂艙取消";
}else{
  $caption_text="線上訂艙進度";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo TESTransportCommonHtmlHead("測試海運網訂艙單");?>
  </head>
  <body class="text-center">
<?php
  echo TESTransportCommonHtmlBody();
  echo PopupWidowScriptHiddenButton(false,false,1);
  echo PopupCloseWidowHref("測試海運網","是否要將此訂單取消?","確認","取消","",false,1);
  list($result,$html)=TESTransportHeader(true,false);
  echo $html;
  if(!$result){exit;}
  $member_array=getMemberUsername($_SESSION['username']);
  $page_total=count(sqlSelectBookingOrderMemberIdList($member_array['member_id'],$search_fields,false,false,$state));
  list($page_text,$page,$start,$per)=getListPageText($page,$page_total);
  $table=getBookingOrderMemberIdSearchTable($member_array['member_id'],$search_fields,$start,$per,$state);
?>
<form action="" method="post">
  <input type="text" id="page" name="page" value="<?php echo $page;?>" hidden>
  <div class="container-fluid">
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputSerialNumber" class="control-label">訂艙號碼</label>
      </div>
      <div class="col col-lg-3 d-flex align-items-center" >
        <div class="input-group mb-3">
          <select class="form-control" id="SelectSerialHead" name="serial_head">
            <?php echo getBookingOrderSerialHeadSelect($search_fields['serial_head']);?>
          </select>
          <input type="text" class="form-control w-50" id="inputSerialNumbere" name="serial_number" value="<?php echo $search_fields['serial_number'];?>">
        </div>
      </div>
      <div class="col">
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputHsCode" class="control-label">產品性質</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center" >
        <select class="form-select" id="inputDangerousGoods" name="dangerous_goods" aria-label="Default select example" required="required">
          <option value="all">ALL</option>
           <?php
             echo getDangerousGoodsSelect($search_fields['dangerous_goods']);
           ?>
         </select>
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputHsCode" class="control-label">交櫃地點</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
          <select class="form-select" id="inputDeliveryPlace" name="cut_off_place_id" aria-label="Default select example">
            <option value="all">ALL</option>
            <?php
              echo getCutOffPlaceOptionCityChineseValueCityId($search_fields['cut_off_place_id']);
            ?>
          </select>
      </div>
      <div class="col d-flex align-items-center" >
        
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputDestination" class="control-label">目的地</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <select class="form-select" id="DestinationCountry" name="country_id">
          <option value="all">ALL</option>
           <?php
            echo getCountryNotDelOptionCountryEnglishValueCountryId($search_fields['country_id']);
          ?>
          </select>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
       <select class="form-select" id="Destination" name="destination_id">
          <?php
          if($search_fields['country_id']!="all"){
            echo "<option value='all'>ALL</option>";
            echo getDestinationOptionDestinationEnglishValueId($search_fields['country_id'],$search_fields['destination_id']);
          }
          ?>
       </select>
      </div>
      <?php
      if($state!="update" && $state!="cancel"){
        echo '<div class="col col-lg-1 d-flex align-items-center">
       <label for="selectOrderStatus" class="control-label">訂單狀態</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
       <select class="form-select" id="selectOrderStatus" name="order_statue">
        <option value="all">ALL</option>'.getBookingOrderScheduleSelect($search_fields['order_statue']).'
        </select>
      </div>';
      }
      ?>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputCreateTime" class="control-label">訂單日期</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="month" class="form-control" id="inputCreateTime" name="create_time" value="<?php echo $search_fields['create_time'];?>">
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
      </div>
    </div>
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="submit" value="查詢" class="btn btn-success">
      </div>
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="button" value="清除查詢" onclick="location.href='./MemberBookingOrderList.php'" class="btn btn-secondary">
      </div>
      <div class="col">
      </div>
    </div>
  </div>
</form>
<table class="table table-success table-striped table-hover caption-top text-start">
  <caption style="font-size: 20px;font-weight:bold;"><?php echo $caption_text;?></caption>
   <thead>
    <tr>
      <th scope="col" class="text-nowrap">#</th>
      <th scope="col" class="text-nowrap">訂艙編號</th>
      <th scope="col" class="text-nowrap">產品性質</th>
      <th scope="col" class="text-nowrap" style="min-width:100px;">訂單內容</th>
      <th scope="col" class="text-nowrap">貿易條件</th>
      <th scope="col" class="text-nowrap">交櫃地點</th>
      <th scope="col" class="text-nowrap">預計出貨日</th>
      <th scope="col" colspan="2">目的地</th>
      <th scope="col" class="text-nowrap">訂單狀態</th>
      <th scope="col" class="text-nowrap">訂單建立日期</th>
      <th scope="col" width="5%"></th>
    </tr>
  </thead>
  <?php

  echo $table;
  ?>
</table>
<?php 
  echo $page_text;
?>


<div class="footer">
  <?php echo TESTransportFooter();?>
</div>
</body>
</html>
<?php 
if($member_array['pass']==0){
  echo PopupStaticWidowHref($title,"待會員證審查通過，才可使用此功能。","../index.php",true,"NotPassFunction");
}
?>
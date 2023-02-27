<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/City.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CityController.php");
list($result,$message)=getStaffPagePriorityReturn(4);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$title="洋宏海運網";
$search_fields=array();
$fields=array("country_id","city_english","city_chinese");
foreach ($fields as $field){
  if (isset($_POST[$field])){
    $search_fields[$field]=$_POST[$field];
  }else{
    $search_fields[$field]="";
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
<?php 
  echo QATransportStaffCommonHtmlHead("洋宏海運網後台",true);
?>
   </head>
  <body class="text-center">
<script type="text/javascript" language="javascript">
</script>
<?php
  list($result,$html)=QATransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false,false,"city_del");
  echo PopupWidowScriptHiddenButton(false,false,"city_reply");
  echo PopupCloseWidowHref("洋宏後台海運網","確認是否將此城市刪除?","確認","取消","",false,"city_del");
  echo PopupCloseWidowHref("洋宏後台海運網","確認是否將此城市還原至未刪除?","確認","取消","",false,"city_reply");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  $table=getCitySearchTable($search_fields);
?>
<form action="" method="post">
  <div class="container-fluid">
    <div class="row">
      <div class="col col-auto d-flex align-items-center">
        <label for="selectOceanExportId" class="control-label">國家</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
       <select class="form-select" id="Country" name="country_id">
          <?php
          if($search_fields['destination_country_id']!="all"){
            echo "<option value='all'>ALL</option>";
            echo getCountryNotDelOptionCountryEnglishValueCountryId($search_fields['country_id']);
          }
          ?>
       </select>
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputCityEnglish" class="control-label">城市英文</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type='text' class="form-control" name="city_english" value="<?php echo $search_fields['city_english'];?>">
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputCityChinese" class="control-label">城市中文</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type='text' class="form-control" name="city_chinese" value="<?php echo $search_fields['city_chinese'];?>">
      </div>
      <div class="col col-auto d-flex align-items-center">
        <input type='submit'  class="btn btn-success"value="查詢">
      </div>
    </div>
  </div>
</form>
<table class="table table-success table-striped table-hover caption-top text-start">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">國家</th>
      <th scope="col">城市英文</th>
      <th scope="col">城市中文</th>
      <th scope="col">狀態</th>
      <th scope="col">編輯</th>
    </tr>
  </thead>
  <?php 
  echo $table;
  ?>
</table>
  <?php echo QATransportStaffFooter();?>
</body>
</html>
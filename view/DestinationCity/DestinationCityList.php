<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Country.php");
require_once("../../model/DestinationCity.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CountryController.php");
require_once("../../controllers/DestinationCityController.php");
list($result,$message)=getStaffPagePriorityReturn(4);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$title="測試海運網";
$search_fields=array();
$fields=array("city_english");
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
  echo TESTransportStaffCommonHtmlHead("測試海運網後台",true);
?>
   </head>
  <body class="text-center">
<script type="text/javascript" language="javascript">
</script>
<?php
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false,false,"destination_city_del");
  echo PopupWidowScriptHiddenButton(false,false,"destination_city_reply");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此貨櫃目的地刪除?","確認","取消","",false,"destination_city_del");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此貨櫃目的地還原至未刪除?","確認","取消","",false,"destination_city_reply");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  $table=getDestinationCitySearchTable($search_fields);
?>
<form action="" method="post">
  <div class="container-fluid">
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputCityEnglish" class="control-label">城市英文</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type='text' class="form-control" name="city_english" value="<?php echo $search_fields['city_english'];?>">
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
      <th scope="col">國家英文</th>
      <th scope="col">目的地城市英文</th>
      <th scope="col">狀態</th>
      <th scope="col">編輯</th>
    </tr>
  </thead>
  <?php 
  echo $table;
  ?>
</table>
  <?php echo TESTransportStaffFooter();?>
</body>
</html>
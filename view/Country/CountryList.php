<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Country.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CountryController.php");
list($result,$message)=getStaffPagePriorityReturn(4);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$title="測試海運網";
$search_fields=array();
$fields=array("ocean_export_id","country_english","country_chinese");
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
  echo PopupWidowScriptHiddenButton(false,false,"country_del");
  echo PopupWidowScriptHiddenButton(false,false,"country_reply");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此國家刪除?","確認","取消","",false,"country_del");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此國家還原至未刪除?","確認","取消","",false,"country_reply");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  $table=getCountrySearchTable($search_fields);
?>
<form action="" method="post">
  <div class="container-fluid">
    <div class="row">
      <div class="col col-auto d-flex align-items-center">
        <label for="selectOceanExportId" class="control-label">海運航線報價</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <select class="form-select" name="ocean_export_id">
          <option value="all">ALL</option>
           <?php
              echo getOceanExportIdSelect($search_fields['ocean_export_id']);
           ?>
          </select>
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputCountryEnglish" class="control-label">國家英文</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type='text' class="form-control" name="country_english" value="<?php echo $search_fields['country_english'];?>">
      </div>
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputCountryChinese" class="control-label">國家中文</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type='text' class="form-control" name="country_chinese" value="<?php echo $search_fields['country_chinese'];?>">
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
      <th scope="col">海運航線</th>
      <th scope="col">國家英文</th>
      <th scope="col">國家中文</th>
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
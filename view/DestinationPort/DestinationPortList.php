<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/DestinationPort.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/DestinationPortController.php");
list($result,$message)=getStaffPagePriorityReturn(4);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$title="測試海運網";
$search_fields=array();
$fields=array("destination_country_id");
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
$(document).ready(function(){
  $('#DestinationCountry').change(function(){
   $("form").submit();
  })
});
</script>
<?php
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(false,false,"destination_port_del");
  echo PopupWidowScriptHiddenButton(false,false,"destination_port_reply");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此目的港刪除?","確認","取消","",false,"destination_port_del");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此目的港還原至未刪除?","確認","取消","",false,"destination_port_reply");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  $table=getDestinationPortSearchTable($search_fields);
?>
<form action="" method="post">
  <div class="container-fluid">
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center">
        <label for="inputDestination" class="control-label">目的港</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <select class="form-select" id="DestinationCountry" name="destination_country_id">
          <option value="all">ALL</option>
           <?php
            echo getDestinationCountryOptionDestinationCountryEnglishValueCountryId($search_fields['destination_country_id']);
           ?>
          </select>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
      </div>
    </div>
  </div>
</form>
<table class="table table-success table-striped table-hover caption-top text-start">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">國家</th>
      <th scope="col">港口</th>
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
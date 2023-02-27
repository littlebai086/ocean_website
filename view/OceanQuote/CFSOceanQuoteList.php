<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CFSOceanPriceController.php");
list($result,$message)=getStaffPagePriorityReturn(5);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$table=getStaffMemberCFSOceanExportListSearchTable();
?>
<!doctype html>
<html lang="en">
  <head>
    <?php 
      echo QATransportStaffCommonHtmlHead("洋宏海運網後台",true);
    ?>
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
</form>
<table class="table table-success table-striped table-hover caption-top" style="width:auto;">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">海運航線</th>
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
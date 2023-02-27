<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
if(isset($_GET['ocean_export_id'])){$ocean_export_id=$_GET['ocean_export_id'];}else{$ocean_export_id=false;}
$data_array=getOceanExportInnerOceanExportDateDeadlineOceanExportId($ocean_export_id,"CY");
// list($result,$message)=getStaffPagePriorityReturn(5);
// if(!$result){
//   echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
//   echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
//   exit;
// }
$table=getStaffOceanExportPriceListTable($ocean_export_id);

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
<h3><?php echo $data_array['start_date']."至".$data_array['end_date'];?></h3>
<h4><?php echo $data_array['quote_route'];?>-報價都美金計價</h4>
<table class="table table-bordered table-success table-striped table-hover">

  <?php
  echo $table;
  //echo getOceanExportPriceLocalChargeTable(98);
  //echo getOceanExportPriceLocalChargeTable(92);
  ?>
</table>
<?php echo QATransportStaffFooter();?>
</body>
</html>
<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../model/CFSOceanPrice.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
require_once("../../controllers/CFSOceanPriceController.php");
if(isset($_GET['ocean_export_id'])){$ocean_export_id=$_GET['ocean_export_id'];}else{$ocean_export_id=false;}
$data_array=getOceanExportInnerOceanExportDateDeadlineOceanExportId($ocean_export_id,"CFS");
// list($result,$message)=getStaffPagePriorityReturn(5);
// if(!$result){
//   echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
//   echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
//   exit;
// }
$table=getStaffCFSOceanPricePriceListTable($ocean_export_id);

?>
<!doctype html>
<html lang="en">
  <head>
    <?php 
      echo TESTransportStaffCommonHtmlHead("測試海運網後台",true);
    ?>
   </head>
  <body>
<?php
  list($result,$html)=TESTransportStaffHeader(true);
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
<?php echo TESTransportStaffFooter();?>
</body>
</html>
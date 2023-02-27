<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
if(isset($_GET['pass'])){$pass=$_GET['pass'];}elseif(isset($_POST['pass'])){$pass=$_POST['pass'];}else{$pass=1;}
list($result,$message)=getStaffPagePriorityReturn(5);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$page_total=count(sqlSelectOceanExportList());
if (isset($_POST['page'])){$page= intval(trim($_POST['page']));}else{$page=1;}
list($page_text,$page,$start,$per)=getListPageText($page,$page_total);
$table=getStaffMemberOceanExportListSearchTable();

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
      <th scope="col">附檔</th>
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
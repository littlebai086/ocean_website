<?php
session_start();
require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../model/EmailNotificationMessage.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/EmailNotificationMessageController.php");
require_once("../../controllers/MemberController.php");
list($result,$message)=getStaffPagePriorityReturn(2);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$search_fields=array();
$page_total=count(sqlSelectEmailNotificationMessageList(false,false));
if (isset($_POST['page'])){$page= intval(trim($_POST['page']));}else{$page=1;}
list($page_text,$page,$start,$per)=getListPageText($page,$page_total);
$table=getStaffMemberEmailNotificationMessageListSearchTable($start,$per);

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
  echo PopupWidowScriptHiddenButton(false);
?>
<form action="" method="post">
  <input type="text" id="page" name="page" value="<?php echo $page;?>" hidden>
</form>
<table class="table table-success table-striped table-hover caption-top">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">信件主旨</th>
      <th scope="col">寄信狀態</th>
      <th scope="col">寄信時間</th>
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

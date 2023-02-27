<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");
if(isset($_GET['pass'])){$pass=$_GET['pass'];}elseif(isset($_POST['pass'])){$pass=$_POST['pass'];}else{$pass=1;}
list($result,$message)=getStaffPagePriorityReturn(2);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$search_fields=array();
$fields=array("username","tax_id_number","company_chinese","company_english","contact_name","contact_email");
foreach ($fields as $field){
  if (isset($_POST[$field])){
    $search_fields[$field]=trim($_POST[$field]);
  }else{
    $search_fields[$field]="";
  }
}

$page_total=count(sqlSelectMemberPassList($pass,$search_fields,false,false));
if (isset($_POST['page'])){$page= intval(trim($_POST['page']));}else{$page=1;}
list($page_text,$page,$start,$per)=getListPageText($page,$page_total);
$table=getStaffMemberListSearchTable($pass,$search_fields,$start,$per);

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
  echo PopupWidowScriptHiddenButton(false,false,"add_blacklist");
  echo PopupWidowScriptHiddenButton(false,false,"remove_blacklist");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此客戶加入為黑名單","確認","取消","",false,"add_blacklist");
  echo PopupCloseWidowHref("測試後台海運網","確認是否將此客戶移除黑名單","確認","取消","",false,"remove_blacklist");
?>
<form action="" method="post">
  <input type="text" id="page" name="page" value="<?php echo $page;?>" hidden>
  <input type="text" name="pass" value="<?php echo $pass;?>" hidden>
  <div class="container-fluid">
    <div class="row">
      <div class="col col-lg-2 d-flex align-items-center" >
        <label for="inputUsername" class="control-label">使用者帳號</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="text" class="form-control" id="inputUsername" name="username" value="<?php echo $search_fields['username'];?>">
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <label for="inputCompanyChinese" class="control-label">公司中文名稱</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center" >
        <input type="text" class="form-control" id="inputCompanyChinese" name="company_chinese" value="<?php echo $search_fields['company_chinese'];?>">
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <label for="inputTaxIdNumber" class="control-label">統一編號</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="text" class="form-control" id="inputTaxIdNumber" name="tax_id_number" value="<?php echo $search_fields['tax_id_number'];?>">
      </div>

    </div>
    <div class="row">
      <div class="col col-lg-2 d-flex align-items-center">
        <label for="inputContactName" class="control-label">聯絡人名稱</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="text" class="form-control" id="inputContactName" name="contact_name" value="<?php echo $search_fields['contact_name'];?>">
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
       <label for="inputContactEmail" class="control-label">聯絡人郵件</label>
      </div>
      <div class="col col-lg-2 d-flex align-items-center">
        <input type="text" class="form-control" id="inputContactEmail" name="contact_email" value="<?php echo $search_fields['contact_email'];?>">
      </div>
      
    </div>
    <div class="row">
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="submit" value="查詢" class="btn btn-success">
      </div>
      <div class="col col-lg-1 d-flex align-items-center" >
        <input type="button" value="清除查詢" onclick="location.href='./StaffMemberList.php?pass=<?php echo $pass;?>'" class="btn btn-secondary">
      </div>
      <div class="col">
      </div>
    </div>
  </div>
</form>
<table class="table table-success table-striped table-hover caption-top">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">使用者帳號</th>
      <th scope="col">公司中文名稱</th>
      <th scope="col">公司英文名稱</th>
      <th scope="col">統一編號</th>
      <th scope="col">聯絡人名稱</th>
      <th scope="col">聯絡人E-MAIL</th>
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
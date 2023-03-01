<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Marquee.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
$table="";
$title="測試海運網";
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,3,false,false);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
list($result,$message)=getStaffPagePriorityReturn(3);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$data_array=getMarqueeMarqueeFirst();
?>
<!doctype html>
<html lang="en">
  <head>
<?php 
  echo TESTransportStaffCommonHtmlHead("測試海運網後台",true);
?>
<script language="javascript">
$(document).ready(function(){
  SelectMarqueeContentChangTextareaMessage();
  $('#inputGroupSelectContent').change(function(){
    SelectMarqueeContentChangTextareaMessage();
  })
});

function SelectMarqueeContentChangTextareaMessage(){
  if($("#inputGroupSelectContent").val()==1){
    $("#TextareaContent").val($("#TextareaDefaultContent").val());
    $("#TextareaContent").attr('readonly','readonly');
  }else if($("#inputGroupSelectContent").val()==2){
    $("#TextareaContent").val("");
     $("#TextareaContent").removeAttr('readonly');
  }
}
</script>
   </head>
  <body>

<?php
  list($result,$html)=TESTransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}
  echo PopupWidowScriptHiddenButton(true,"StaticWidowMessage");
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
?> 
<form action='' method='post'>
  <div class='row'>
    <div class='col col-lg-3'>
    </div>
    <div class='col col-lg-2'>
      原跑馬燈內容
    </div>
    <div class='col col-lg-5'>
      <?php
        echo $data_array['marquee_content'];
      ?>
    </div>
  </div>
  <div class='row'>
    <div class='col col-lg-3'>
    </div>
    <div class='col col-lg-2'>
      <div class='input-group mb-3'>
      <label class='form-control'>跑馬燈內容</label>
        <select class='form-select' id='inputGroupSelectContent' >
            <option value='1'>預設</option>
            <option value='2'>其他</option>
        </select>
      </div>
    </div>
    <div class='col col-lg-5'>
      <textarea class='form-control' id='TextareaContent' rows='3' name='content' required='required'></textarea>
      <textarea class='form-control' id='TextareaDefaultContent' rows='3' readonly='readonly' hidden><?php echo getMarqueeMarqueeDefaultSelectContent();?></textarea>
    </div>
  </div>
 <p class='text-center'>
  <input type='submit' class='btn btn-success' value='修改'>
  </p>
</form>
  <?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['content'])){
  $content=getTextareaChangeEnterSymbolN12br(addslashes(trim($_POST['content'])));
  $content=str_replace("<br>", "",$content);
  if(sqlInsertMarquee($content)){
    echo PopupStaticWidowHref($title,"修改跑馬燈內容成功","./Marquee.php?state=add",true,"StaticWidowMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"修改跑馬燈內容失敗","back",true,"StaticWidowMessage");
    exit;
  }
}
?>
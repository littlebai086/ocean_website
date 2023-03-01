<?php
require_once("../../model/CommonSql.php");
require_once("../../model/BookingOrder.php");
require_once("../../model/Destination.php");
require_once("../../model/DestinationCity.php");
require_once("../../model/DestinationContainerDepot.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/DestinationController.php");
require_once("../../controllers/DestinationCityController.php");
require_once("../../controllers/DestinationCityController.php");
require_once("../../controllers/DestinationContainerDepotController.php");
session_start();
$form="";
$title="測試海運網";
$submit="";
if(isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,4,$id,false);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
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
	echo PopupWidowScriptHiddenButton(false,"DestinationCityMessage");
?>
<main class="container-fluid" >
  <form method="post" action="" id="loginForm">
    <?php
      echo $form;
    ?>
    
    <div class="row">
        <div class="col col-lg-5">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <?php 
          if($submit){
            echo '<input type="submit" name="emp_edit_send" class="btn btn-success" value="'.$submit.'">';
          }
          ?>
         </div>
     </div>
  </form>
</main>
<?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if($state=="destination_city_change_del" || $state=="destination_city_del"){
  $data_array=getDestinationCityId($id);
  list($result,$array,$text)=getDestinationCityDelDecide($id);
  if($result){
    if($state=="destination_city_change_del"){
      if(sqlUpdateDestinationCityDestinationCityDelDestinationCityId($id)){
        echo PopupStaticWidowHref($title,"目的地城市已變更為刪除","./DestinationCityList.php",true,"DestinationCityMessage");
        exit;
      }
    }elseif($state=="destination_city_del"){
      if(sqlDeleteDestinationCityDestinationCityId($id)){
        echo PopupStaticWidowHref($title,"目的地城市已從資料庫刪除","./DestinationCityList.php",true,"DestinationCityMessage");
        exit;
      }
    }
  }else{
    $msg="目前目的地城市:".$data_array['city_english']."不能刪除<br>以下".$text."尚在資料庫使用".implode(",",$array);
    echo PopupStaticWidowHref($title,$msg,"back",true,"DestinationCityMessage");
    exit;
  }
  echo PopupStaticWidowHref($title,"系統錯誤，無法刪除","back",true,"DestinationCityMessage");
  exit;
}elseif($state=="destination_city_reply"){
  $data_array=getDestinationCityId($id);
  if(sqlUpdateDestinationCityDestinationCityNotDelDestinationCityId($id)){
    echo PopupStaticWidowHref($title,"目的地城市已還原為未刪除","./DestinationCityList.php",true,"DestinationCityMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"系統錯誤，無法還原成未刪除","back",true,"DestinationCityMessage");
    exit;
  }

}
?>

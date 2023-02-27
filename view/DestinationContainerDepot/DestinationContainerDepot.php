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
require_once("../../controllers/DestinationContainerDepotController.php");
session_start();
$form="";
$title="洋宏海運網";
$submit="";
if(isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,4,$id,false);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
list($result,$message)=getStaffPagePriorityReturn(4);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$items=array("destination_city_id","container_depot_english");
if(isset($_POST['emp_edit_send'])){
  if($state=="destination_container_depot_merge"){
    $destination_container_depot_id=$_POST['destination_container_depot_id'];
  }else{
    foreach ($items as $item){
      $data_array[$item]=trim($_POST[$item]);
    }
  }
}elseif($state=="destination_container_depot_add"){
  foreach ($items as $item){
    $data_array[$item]="";
  }
  $form=getDestinationContainerDepotForm($state,$data_array);
}elseif($state=="destination_container_depot_update"){
  $data_array=getDestinationContainerDepotDestinationContainerDepotId($id);
  $form=getDestinationContainerDepotForm($state,$data_array);
}elseif($state=="destination_container_depot_merge"){
  $data_array=getDestinationContainerDepotDestinationContainerDepotId($id);
  $form=getDestinationContainerDepotForm($state,$data_array);
}
if($state=="destination_container_depot_add"){
  $title="貨櫃目的地新增";
  $submit="新增";
}elseif($state=="destination_container_depot_update"){
  $title="貨櫃目的地修改";
  $submit="修改";
}elseif($state=="destination_container_depot_merge"){
  $title="貨櫃目的地合併";
  $submit="合併";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
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
	echo PopupWidowScriptHiddenButton(false,"DestinationContainerDepotMessage");
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
          <input type="submit" name="emp_edit_send" class="btn btn-success" value="<?php echo $submit;?>">
         </div>
        <div class="col col-lg-1 d-flex align-items-center">
            <input type="button" value="回貨櫃目的地列表" onclick="history.back()" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo QATransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send']) && $state=="destination_container_depot_merge"){
  $destination_array=getDestinationDestinationContainerDepotId($id);
  $old_destination_id=$destination_array['destination_id'];
  $destination_array=getDestinationDestinationContainerDepotId($destination_container_depot_id);
  $new_destination_id=$destination_array['destination_id'];
  if(sqlUpdateDestinationContainerDepotDelDestinationContainerDepotId($id) &&
  sqlUpdateBookingOrderDestinationId($old_destination_id,$new_destination_id)){
    echo PopupStaticWidowHref($title,"貨櫃目的地id已進行全部更改","./DestinationContainerDepotList.php",true,"DestinationContainerDepotMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"貨櫃目的地id更改失敗","back",true,"DestinationContainerDepotMessage");
    exit;
  }

}elseif(isset($_POST['emp_edit_send'])){
  $data_array['container_depot_english']=trim(strtoupper($data_array['container_depot_english']));
  if (!CompanyEnglishFormat($data_array['container_depot_english'])){
    echo PopupStaticWidowHref($title,"貨櫃目的地名稱應為英文，不該有中文及一些特殊符號","back",true,"DestinationContainerDepotMessage");
    exit;
  }
  $destination_container_depot_array=getDestinationContainerDepotDestinationContainerDepotEnglish($data_array['container_depot_english']);
  if($destination_container_depot_array && $id!=$destination_container_depot_array['destination_container_depot_id']){
    echo PopupStaticWidowHref($title,"已有此貨櫃目的地英文名稱","back",true,"DestinationContainerDepotMessage");
    exit;
  }
  if ($state=="destination_container_depot_add"){
    $id=sqlInsertDestinationContainerDepot($data_array);
  	if ($id && sqlInsertDestinationDestinationContainerDepotId($id)){
      echo PopupStaticWidowHref($title,"貨櫃目的地新增完成","./DestinationContainerDepotList.php",true,"DestinationContainerDepotMessage");
    }else{
      echo PopupStaticWidowHref($title,"貨櫃目的地新增失敗","back",true,"DestinationContainerDepotMessage");
    }
  }elseif($state=="destination_container_depot_update"){
    if(sqlUpdateDestinationContainerDepot($id,$data_array)){
      echo PopupStaticWidowHref($title,"修改貨櫃目的地完成","./DestinationContainerDepotList.php",true,"DestinationContainerDepotMessage");
      exit;
    }else{
      echo PopupStaticWidowHref($title,"修改貨櫃目的地失敗，請聯絡公司相關IT人員","back",true,"DestinationContainerDepotMessage");
      exit;
    }
  }
}elseif($state=="destination_container_depot_change_del" || 
  $state=="destination_container_depot_del"){
  $data_array=getDestinationContainerDepotDestinationContainerDepotId($id);
  list($result,$array,$text)=getDestinationContainerDepotDelDecide($id);
  if($result){
    if($state=="destination_container_depot_change_del"){
      if(sqlUpdateDestinationContainerDepotDestinationContainerDepotDelDestinationContainerDepotId($id)){
        echo PopupStaticWidowHref($title,"貨櫃目的地已變更為刪除","./DestinationContainerDepotList.php",true,"DestinationContainerDepotMessage");
        exit;
      }
    }elseif($state=="destination_container_depot_del"){
      if(sqlDeleteDestinationContainerDepotDestinationContainerDepotId($id) &&
      sqlDeleteDestinationDestinationContainerDepotId($id)){
        echo PopupStaticWidowHref($title,"貨櫃目的地已從資料庫刪除","./DestinationContainerDepotList.php",true,"DestinationContainerDepotMessage");
        exit;
      }
    }
  }else{
    $msg="目前貨櫃目的地:".$data_array['city_english']."不能刪除<br>以下".$text."尚在資料庫使用".implode(",",$array);
    echo PopupStaticWidowHref($title,$msg,"back",true,"DestinationContainerDepotMessage");
    exit;
  }
  echo PopupStaticWidowHref($title,"系統錯誤，無法刪除","back",true,"DestinationContainerDepotMessage");
  exit;
}elseif($state=="destination_container_depot_reply"){
  $data_array=getDestinationContainerDepotDestinationContainerDepotId($id);
  if(sqlUpdateDestinationContainerDepotDestinationContainerDepotNotDelDestinationContainerDepotId($id)){
    echo PopupStaticWidowHref($title,"貨櫃目的地已還原為未刪除","./DestinationContainerDepotList.php",true,"DestinationContainerDepotMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"系統錯誤，無法還原成未刪除","back",true,"DestinationContainerDepotMessage");
    exit;
  }

}
?>

<?php
require_once("../../model/CommonSql.php");
require_once("../../model/BookingOrder.php");
require_once("../../model/DestinationPort.php");
require_once("../../model/Destination.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../model/DestinationPort.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/DestinationController.php");
require_once("../../controllers/DestinationPortController.php");
session_start();
$form="";
$submit="";
$title="測試海運網";
if(isset($_GET['id'])){$id=$_GET['id'];}else{$id=false;}
if (isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
list($result,$message)=getStaffStatePriorityReturn($state,4,$id,false);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
list($result,$message)=getStaffPagePriorityReturn(4);
if(!$result){
  echo TESTransportStaffPageHeadDecideErrorImportHtml("測試海運網後台",true);
  echo PopupStaticWidowHref("測試海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$items=array("country_id","destination_port_english","port_code","port_code_1");
if(isset($_POST['emp_edit_send'])){
  if($state=="destination_port_merge"){
    $destination_port_id=$_POST['destination_port_id'];
  }else{
    foreach ($items as $item){
      $data_array[$item]=trim($_POST[$item]);
    }
  }
}elseif($state=="destination_port_add"){
  foreach ($items as $item){
    $data_array[$item]="";
  }
  $form=getDestinationPortForm($state,$data_array);
}elseif($state=="destination_port_update"){
  $data_array=getDestinationPortDestinationPortId($id);
  $form=getDestinationPortForm($state,$data_array);
}elseif($state=="destination_port_merge"){
  $data_array=getDestinationPortDestinationPortId($id);
  $form=getDestinationPortForm($state,$data_array);
}
if($state=="destination_port_add"){
  $title="目的港新增";
  $submit="新增";
}elseif($state=="destination_port_update"){
  $title="目的港修改";
  $submit="修改";
}elseif($state=="destination_port_merge"){
  $title="目的港合併";
  $submit="合併";
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
	echo PopupWidowScriptHiddenButton(false,"DestinationPortMessage");
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
            <input type="button" value="回目的港列表" onclick="history.back()" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send']) && $state=="destination_port_merge"){
  $destination_array=getDestinationDestinationPortId($id);
  $old_destination_id=$destination_array['destination_id'];
  $destination_array=getDestinationDestinationPortId($destination_port_id);
  $new_destination_id=$destination_array['destination_id'];
  if(sqlUpdateDestinationPortDestinationPortDelDestinationPortId($id) &&
  sqlUpdateOceanExportPriceDestinationPortId($id,$destination_port_id) &&
  sqlUpdateBookingOrderDestinationId($old_destination_id,$new_destination_id)){
    echo PopupStaticWidowHref($title,"目的港id已進行全部更改","./DestinationPortList.php",true,"DestinationPortMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"目的港id更改失敗","back",true,"DestinationPortMessage");
    exit;
  }

}elseif(isset($_POST['emp_edit_send'])){
  $data_array['destination_port_english']=trim(strtoupper($data_array['destination_port_english']));

  if (!PlaceEnglishFormat($data_array['destination_port_english'])){
    echo PopupStaticWidowHref($title,"目的港名稱應為英文，不該有中文及一些特殊符號","back",true,"DestinationPortMessage");
    exit;
  }
  $destination_port_array=getDestinationPortDestinationPortEnglish($data_array['destination_port_english']);
  if($destination_port_array && $id!=$destination_port_array['destination_port_id']){
    echo PopupStaticWidowHref($title,"已有此目的港英文名稱","back",true,"DestinationPortMessage");
    exit;
  }
  if ($state=="destination_port_add"){
    $destination_port_id=sqlInsertDestinationPort($data_array);
  	if ($destination_port_id && sqlInsertDestinationDestinationPortId($destination_port_id)){
      echo PopupStaticWidowHref($title,"目的港新增完成","./DestinationPortList.php",true,"DestinationPortMessage");
    }else{
      echo PopupStaticWidowHref($title,"目的港新增失敗","back",true,"DestinationPortMessage");
    }
  }elseif($state=="destination_port_update"){
    if(sqlUpdateDestinationPort($id,$data_array)){
      echo PopupStaticWidowHref($title,"修改目的港完成","./DestinationPortList.php",true,"DestinationPortMessage");
      exit;
    }else{
      echo PopupStaticWidowHref($title,"修改目的港失敗，請聯絡公司相關IT人員","back",true,"DestinationPortMessage");
      exit;
    }
  }
}elseif($state=="destination_port_change_del" || 
  $state=="destination_port_del"){
  $data_array=getDestinationPortDestinationPortId($id);
  list($result,$array,$text)=getDestinationPortDelDecide($id);
  if($result){
    if($state=="destination_port_change_del"){
      if(sqlUpdateDestinationPortDestinationPortDelDestinationPortId($id)){
        echo PopupStaticWidowHref($title,"目的港已變更為刪除","./DestinationPortList.php",true,"DestinationPortMessage");
        exit;
      }
    }elseif($state=="destination_port_del"){
      if(sqlDeleteDestinationPortDestinationPortId($id) &&
      sqlDeleteDestinationDestinationPortId($id)){
        echo PopupStaticWidowHref($title,"目的港已從資料庫刪除","./DestinationPortList.php",true,"DestinationPortMessage");
        exit;
      }
    }
  }else{
    $msg="目前目的港:".$data_array['destination_port_english']."不能刪除<br>以下".$text."尚在資料庫使用".implode(",",$array);
    echo PopupStaticWidowHref($title,$msg,"back",true,"DestinationPortMessage");
    exit;
  }
  echo PopupStaticWidowHref($title,"系統錯誤，無法刪除","back",true,"DestinationPortMessage");
  exit;
}elseif($state=="destination_port_reply"){
  $data_array=getDestinationPortDestinationPortId($id);
  if(sqlUpdateDestinationPortDestinationPortNotDelDestinationPortId($id)){
    echo PopupStaticWidowHref($title,"目的港已還原為未刪除","./DestinationPortList.php",true,"DestinationPortMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"系統錯誤，無法還原成未刪除","back",true,"DestinationPortMessage");
    exit;
  }

}
?>

<?php
require_once("../../model/CommonSql.php");
require_once("../../model/Area.php");
require_once("../../model/City.php");
require_once("../../model/CutOffPlace.php");
require_once("../../model/DestinationPort.php");
require_once("../../model/DestinationCity.php");
require_once("../../model/DestinationContainerDepot.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CityController.php");
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
$items=array("country_id","city_english","city_chinese","city_abbreviation");
if(isset($_POST['emp_edit_send'])){
  if($state=="city_merge"){
    $city_id=$_POST['city_id'];
  }else{
    foreach ($items as $item){
      $data_array[$item]=trim($_POST[$item]);
    }
  }
}elseif($state=="city_add"){
  $data_array["city_id"]=0;
  foreach ($items as $item){
    $data_array[$item]="";
  }
  $form=getCityForm($state,$data_array);
}elseif($state=="city_update"){
  $data_array=getCityId($id);
  $form=getCityForm($state,$data_array);
}elseif($state=="city_merge"){
  $data_array=getCityId($id);
  $form=getCityForm($state,$data_array);
}
if($state=="city_add"){
  $title="城市新增";
  $submit="新增";
}elseif($state=="city_update"){
  $title="城市修改";
  $submit="修改";
}elseif($state=="city_merge"){
  $title="城市合併";
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
	echo PopupWidowScriptHiddenButton(false,"CityMessage");
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
            <input type="button" value="回城市列表" onclick="history.back()" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send']) && $state=="city_merge"){
  $new_destination_city_id=false;
  $destination_city_array=getDestinationCityCityId($id);
  if($destination_city_array){
    $old_destination_city_id=$destination_city_array['destination_city_id'];
    $destination_city_array=getDestinationCityCityId($city_id);
    $new_destination_city_id=$destination_city_array['destination_city_id'];
  }
  
  if(sqlUpdateCityCityDelCityId($id) && 
    sqlUpdateAreaCityId($id,$city_id) && 
    sqlUpdateCutOffPlaceCityId($id,$city_id)){
    if($new_destination_city_id){
      if(!sqlUpdateDestinationContainerDepotDestinationCityId($old_destination_city_id,$new_destination_city_id)){
        echo PopupStaticWidowHref($title,"目的地城市id更改失敗","back",true,"CityMessage");
        exit;
      }
    }
    echo PopupStaticWidowHref($title,"城市id已進行全部更改","./CityList.php",true,"CityMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"城市id更改失敗","back",true,"CityMessage");
    exit;
  }
}elseif(isset($_POST['emp_edit_send'])){
  $destination_city_result=$_POST['destination_city_result'];
  $data_array['city_english']=trim(strtoupper($data_array['city_english']));
  if (!CompanyEnglishFormat($data_array['city_english'])){
    echo PopupStaticWidowHref($title,"城市英文名稱應為英文，不該有中文及一些特殊符號","back",true,"CityMessage");
    exit;
  }
  $city_array=getCityCityEnglish($data_array['city_english']);
  if($city_array && $id!=$city_array['city_id']){
    echo PopupStaticWidowHref($title,"已有城市英文名稱","back",true,"CityMessage");
    exit;
  }
  if ($state=="city_add"){
    $id=sqlInsertCity($data_array);
  	if ($id){
      if($destination_city_result=="yes"){
        if(!sqlInsertDestinationCityCityId($id)){
          echo PopupStaticWidowHref($title,"目的地城市新增失敗","back",true,"CityMessage");
          exit;
        }
      }
      echo PopupStaticWidowHref($title,"城市新增完成","./CityList.php",true,"CityMessage");
    }else{
      echo PopupStaticWidowHref($title,"城市新增失敗","back",true,"CityMessage");
    }
  }elseif($state=="city_update"){
    $destination_city_array=getDestinationCityCityId($id);
    if(!$destination_city_array && $destination_city_result=="yes"){
      if(!sqlInsertDestinationCityCityId($id)){
        echo PopupStaticWidowHref($title,"目的地城市新增失敗","back",true,"CityMessage");
        exit;
      }
    }elseif($destination_city_array && $destination_city_result=="yes"){
      if(!sqlUpdateDestinationCityDestinationCityNotDel($id)){
        echo PopupStaticWidowHref($title,"目的地城市修改成未刪除失敗","back",true,"CityMessage");
        exit;
      }
    }elseif($destination_city_array && $destination_city_result=="no"){
      if(!sqlUpdateDestinationCityDestinationCityDel($id)){
        echo PopupStaticWidowHref($title,"目的地城市修改成刪除失敗","back",true,"CityMessage");
        exit;
      }
    }
    if(sqlUpdateCity($id,$data_array)){
      echo PopupStaticWidowHref($title,"修改城市完成","./CityList.php",true,"CityMessage");
      exit;
    }else{
      echo PopupStaticWidowHref($title,"修改城市失敗，請聯絡公司相關IT人員","back",true,"CityMessage");
      exit;
    }
  }
}elseif($state=="city_change_del" || $state=="city_del"){
  $data_array=getCityId($id);
  list($result,$array,$text)=getCityDelDecide($id);
  if($result){
    if($state=="city_change_del"){
      if(sqlUpdateCityCityDelCityId($id)){
        echo PopupStaticWidowHref($title,"城市已變更為刪除","./CityList.php",true,"CityMessage");
        exit;
      }
    }elseif($state=="city_del"){
      if(sqlDeleteCityCityId($id)){
        echo PopupStaticWidowHref($title,"城市已從資料庫刪除","./CityList.php",true,"CityMessage");
        exit;
      }
    }
  }else{
    $msg="目前城市:".$data_array['city_english']."不能刪除<br>以下".$text."尚在資料庫使用".implode(",",$array);
    echo PopupStaticWidowHref($title,$msg,"back",true,"CityMessage");
    exit;
  }
  echo PopupStaticWidowHref($title,"系統錯誤，無法刪除","back",true,"CityMessage");
  exit;
}elseif($state=="city_reply"){
  $data_array=getCityId($id);
  if(sqlUpdateCityCityNotDelCityId($id)){
    echo PopupStaticWidowHref($title,"城市已還原為未刪除","./CityList.php",true,"CityMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"系統錯誤，無法還原成未刪除","back",true,"CityMessage");
    exit;
  }

}
?>

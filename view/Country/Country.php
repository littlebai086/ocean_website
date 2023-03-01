<?php
require_once("../../model/CommonSql.php");
require_once("../../model/Country.php");
require_once("../../model/City.php");
require_once("../../model/DestinationPort.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CountryController.php");
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
$items=array("ocean_export_id","country_english","country_chinese","country_abbreviation");
if(isset($_POST['emp_edit_send'])){
  if($state=="country_merge"){
    $country_id=$_POST['country_id'];
  }else{
    foreach ($items as $item){
      $data_array[$item]=trim($_POST[$item]);
    }
  }
}elseif($state=="country_add"){
  foreach ($items as $item){
    $data_array[$item]="";
  }
  $form=getCountryForm($state,$data_array);
}elseif($state=="country_update"){
  $data_array=getCountryCountryId($id);
  $form=getCountryForm($state,$data_array);
}elseif($state=="country_merge"){
  $data_array=getCountryCountryId($id);
  $form=getCountryForm($state,$data_array);
}
if($state=="country_add"){
  $title="國家新增";
  $submit="新增";
}elseif($state=="country_update"){
  $title="國家修改";
  $submit="修改";
}elseif($state=="country_merge"){
  $title="國家合併";
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
	echo PopupWidowScriptHiddenButton(false,"CountryMessage");
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
            <input type="button" value="回國家列表" onclick="history.back()" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
<?php echo TESTransportStaffFooter();?>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send']) && $state=="country_merge"){
  if(sqlUpdateCountryCountryDelCountryId($id) &&
  sqlUpdateCityCountryId($id,$country_id) &&
  sqlUpdateDestinationPortCountryId($id,$country_id)){
    echo PopupStaticWidowHref($title,"國家id已進行全部更改","./CountryList.php",true,"CountryMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"國家id更改失敗","back",true,"CountryMessage");
    exit;
  }

}elseif(isset($_POST['emp_edit_send'])){
  $data_array['country_english']=trim(strtoupper($data_array['country_english']));

  if (!CompanyEnglishFormat($data_array['country_english'])){
    echo PopupStaticWidowHref($title,"國家英文名稱應為英文，不該有中文及一些特殊符號","back",true,"CountryMessage");
    exit;
  }
  $country_array=getCountryCountryEnglish($data_array['country_english']);
  if($country_array && $id!=$country_array['country_id']){
    echo PopupStaticWidowHref($title,"已有國家英文名稱","back",true,"CountryMessage");
    exit;
  }
  $data_array['ocean_export_id']=getDataZeroTransferNullSaveSql($data_array['ocean_export_id']);
  if ($state=="country_add"){
  	if (sqlInsertCountry($data_array)){
      echo PopupStaticWidowHref($title,"國家新增完成","./CountryList.php",true,"CountryMessage");
    }else{
      echo PopupStaticWidowHref($title,"國家新增失敗","back",true,"CountryMessage");
    }
  }elseif($state=="country_update"){
    if(sqlUpdateCountry($id,$data_array)){
      echo PopupStaticWidowHref($title,"修改國家完成","./CountryList.php",true,"CountryMessage");
      exit;
    }else{
      echo PopupStaticWidowHref($title,"修改國家失敗，請聯絡公司相關IT人員","back",true,"CountryMessage");
      exit;
    }
  }
}elseif($state=="country_change_del" || $state=="country_del"){
  $data_array=getCountryCountryId($id);
  list($result,$array,$text)=getCountryDelDecide($id);
  if($result){
    if($state=="country_change_del"){
      if(sqlUpdateCountryCountryDelCountryId($id)){
        echo PopupStaticWidowHref($title,"國家已變更為刪除","./CountryList.php",true,"CountryMessage");
        exit;
      }
    }elseif($state=="country_del"){
      if(sqlDeleteCountryCountryId($id)){
        echo PopupStaticWidowHref($title,"國家已從資料庫刪除","./CountryList.php",true,"CountryMessage");
        exit;
      }
    }
  }else{
    $msg="目前國家:".$data_array['country_english']."不能刪除<br>以下".$text."尚在資料庫使用".implode(",",$array);
    echo PopupStaticWidowHref($title,$msg,"back",true,"CountryMessage");
    exit;
  }
  echo PopupStaticWidowHref($title,"系統錯誤，無法刪除","back",true,"CountryMessage");
  exit;
}elseif($state=="country_reply"){
  $data_array=getCountryCountryId($id);
  if(sqlUpdateCountryCountryNotDelCountryId($id)){
    echo PopupStaticWidowHref($title,"國家已還原為未刪除","./CountryList.php",true,"CountryMessage");
    exit;
  }else{
    echo PopupStaticWidowHref($title,"系統錯誤，無法還原成未刪除","back",true,"CountryMessage");
    exit;
  }

}
?>

<?php
require_once("../../model/CommonSql.php");
require_once("../../model/Staff.php");
require_once("../../model/StaffListDepartment.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/StaffController.php");
session_start();
if(isset($_GET['state'])){$state=$_GET['state'];}else{$state=false;}
if(isset($_GET['id'])){$staff_id=$_GET['id'];}else{$staff_id=false;}
list($result,$message)=getStaffStatePriorityReturn($state,1,$staff_id,false);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
list($result,$message)=getStaffPagePriorityReturn(1);
if(!$result){
  echo QATransportStaffPageHeadDecideErrorImportHtml("洋宏海運網後台",true);
  echo PopupStaticWidowHref("洋宏海運網",$message,"../StaffIndex.php",true,"StaffPriorityMessage");
  exit;
}
$items=array("cname","gender","elastname","ename","email","email_address","birthday","extension","department_ids","position_id","staff_state_id");
if(isset($_POST['emp_edit_send'])){
  $error=true;
  foreach ($items as $item){
    if($item=="department_ids"){
      $data_array[$item]=$_POST[$item];
    }else{
      $data_array[$item]=trim($_POST[$item]);
    }
    
  }
}elseif($state=="add"){
  $error=false;
  foreach ($items as $item){
    if($item=="department_ids"){
      $data_array[$item]=array();
    }else{
      $data_array[$item]="";
    }
  }
}elseif($state=="update"){
  $error=false;
  $data_array=getStaffListStaffId($staff_id);
	list($data_array['email'],$data_array['email_address'])=getEmailEmailAddress($data_array['email']);
}
if($state=="add"){
  $title="新增員工資料";
  $submit="新增";
}elseif($state=="update"){
  $title="修改員工資料";
  $submit="修改";
}
$data_array['ename']=ucfirst(strtolower($data_array['ename']));
$data_array['elastname']=ucfirst(strtolower($data_array['elastname']));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<?php 
  echo QATransportStaffCommonHtmlHead("洋宏海運網後台",true);

?>
</head>

<style>

</style>
<body>
<?php 
  list($result,$html)=QATransportStaffHeader(true);
  echo $html;
  if(!$result){exit;}

	echo PopupWidowScriptHiddenButton(1);
?>
<main class="container-fluid" >
  <form method="post" action="" id="loginForm">
    <input type="text" id="error" value="<?php echo $error;?>" hidden>
    <input type="text" id="id"  name="staff_id" value="<?php echo $staff_id;?>" hidden>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <label for="inputChineseName" class="control-label">中文名字</label>
        </div>
        <div class="col col-lg-2 d-flex align-items-center">
   			<input type='text' class='form-control' id='inputChineseName' name='cname' placeholder='請填寫中文姓名' value="<?php echo $data_array['cname'];?>" required="required">
        </div>
        <div class="col col-lg-2 d-flex align-items-center">
          		<?php
          			echo getHtmlRadio("gender","form-check-input mt-0",$data_array["gender"],array("male","female"),array("先生","小姐"));
          		?>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <label for="inputELastName" class="control-label">英文姓氏</label>
        </div>
        <div class="col col-lg-2">
          <input type='text' class='form-control' id='inputELastName' name='elastname' placeholder='請填寫英文姓氏' value="<?php echo $data_array['elastname'];?>" required="required">
        </div>
        <div class="col col-lg-1">
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <label for="inputEName" class="control-label">英文名字</label>
        </div>
        <div class="col col-lg-2">
          <input type='text' class='form-control' id='inputEName' name='ename' placeholder='請填寫英文姓名' value="<?php echo $data_array['ename'];?>" required="required">
        </div>
        <div class="col col-lg-1">
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <label for="inputBirthday" class="control-label">生日</label>
        </div>
        <div class="col col-lg-2">
          <input type="date" id="inputBirthday" name="birthday" class="form-control" value="<?php echo $data_array['birthday'];?>" required="required">
        </div>
        <div class="col col-lg-1">
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <label for="inputEmail" class="control-label">公司E-MAIL</label>
        </div>
        <div class="col col-lg-3">
        	<div class="input-group">
          		<input type="text" class="form-control"  id="inputEmail" name="email" value="<?php echo $data_array['email'];?>"  placeholder="請填寫E-MAIL"  required="required">
          		<select name="email_address" class="form-control">
          			<?php 
          			 echo getEmailAddressOptionEmailAddress($data_array['email_address']);
          			?>
          		</select>
        	</div>
        </div>
        <div class="col col-lg-1">
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <label for="selectDepartmentId" class="control-label">部門</label>
        </div>
        <div class="col col-lg-2">
          <select  class="form-select" name="department_ids[]"multiple="multiple" id="department_id">
          	<?php
          		echo getDepartmentOptionDepartmentValueIds($data_array['department_ids']);
          	?>
          </select>
         </div>
        <div class="col col-lg-1">
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <label for="selectPostitionId" class="control-label">職位</label>
        </div>
        <div class="col col-lg-2">
          <select id="selectPositionId" name="position_id" class="form-select">>
          	<?php
          		echo getPositionOptionPositionValueId($data_array['position_id']);
          	?>
          </select>
         </div>
        <div class="col col-lg-1">
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-1 d-flex align-items-center">
          <label for="inputExtension" class="control-label">分機</label>
         </div>
        <div class="col col-lg-2 d-flex align-items-center">
          <input type='text' class='form-control' id='inputExtension' name='extension' value="<?php echo $data_array['extension'];?>" placeholder='請填寫分機' required="required">
        </div>
    </div>
    <?php 
    $content="";
    if ($state=="add"){
    $content='<div class="row">
        <div class="col col-lg-4">
        </div>	
        <div class="col col-1 d-flex align-items-center">
          <label for="selectStaffState" class="control-label">員工為</label>
         </div>
        <div class="col col-lg-1 d-flex align-items-center">
          <select name="staff_state_id" class="form-select">
          	'.getStaffStateOptionStateValueId($data_array['staff_state_id']).'
          </select>
        </div>
    </div>';
    }elseif($state=="update"){
      $content.='<select name="staff_state_id" class="form-select" hidden>
            '.getStaffStateOptionStateValueId($data_array['staff_state_id']).'
          </select>';
    }
    echo $content
    ?>
    <div class="row">
        <div class="col col-lg-5">
        </div>	
        <div class="col col-lg-1 d-flex align-items-center">
          <input type="submit" name="emp_edit_send" class="btn btn-success" value="<?php echo $submit;?>">
         </div>
        <div class="col col-lg-1 d-flex align-items-center">
            
            <input type="button" value="回員工列表" onclick="history.back()" class="btn btn-secondary">
        </div>
     </div>
  </form>
</main>
        <?php echo QATransportStaffFooter();?>
        <script src="../../js/BsMultiSelect.js"></script>
        <script>
            var $management = $('#department_id');
            $management.bsMultiSelect({
              setSelected: function(option /*element*/, value /*true|false*/){
                  if (value) 
                      option.setAttribute('selected','');
                  else  
                      option.removeAttribute('selected');
                  option.selected = value;
              }
          }); 
        </script>
</body>
</html>
<?php
if(isset($_POST['emp_edit_send'])){
	$data_array['email']=strtolower($data_array['email']);
  $data_array['ename']=ucfirst(strtolower($data_array['ename']));
  $data_array['elastname']=ucfirst(strtolower($data_array['elastname']));
  $data_array['email']=$data_array['email'].$data_array['email_address'];
   if (!EmailFormat($data_array['email'])){
      echo PopupWidowHref($title,"E-MAIL格式錯誤",false,true,false);
      exit;
   }

  if (!AllNumberFormat($data_array['extension'])){
    echo PopupWidowHref($title,"分機格式錯誤，分機應為數字",false,true,false);
    exit;
  }
  if (!ChineseFormat($data_array['cname'])){
    echo PopupWidowHref($title,"中文名稱應為中文，不該包含英文及數字和特殊符號空白...等",false,true,false);
    exit;
  }
  if (!EnglishFormat($data_array['ename'])){
    echo PopupWidowHref($title,"英文姓氏應為英文，不該有中文及一些特殊符號",false,true,false);
    exit;
  }
  if (!EnglishFormat($data_array['elastname'])){
    echo PopupWidowHref($title,"英文名稱應為英文，不該有中文及一些特殊符號",false,true,false);
    exit;
  }

  if ($state=="add"){
    $id=sqlInsertStaffList($data_array);
    if ($id){
      list($username,$password)=getAccountPassword($id);
      if (!sqlInsertStaffAccountList($id,$username,$password)){
        echo PopupWidowHref($title,"帳戶新增失敗",false,true,false);
        exit;
      }
      foreach($data_array["department_ids"] as $department_id){
        if(!sqlInsertStaffListDepartment($id,$department_id)){
          echo PopupWidowHref($title,"部門新增失敗，請用修改去修改部門",false,true,false);
          exit;
        }
      }
      echo PopupWidowHref($title,"基本資料及帳戶新增完成","./StaffList.php",true,false);
      exit;
    }
    echo PopupWidowHref($title,"基本資料新增失敗",false,true,false);
    exit;
  }elseif($state=="update"){
    if(sqlUpdateStaffList($staff_id,$data_array)){
      if(sqlDeleteStaffListDepartmentStaffId($staff_id)){
        foreach($data_array["department_ids"] as $department_id){
          if(!sqlInsertStaffListDepartment($staff_id,$department_id)){
            echo PopupWidowHref($title,"部門新增失敗，請用修改去修改部門",false,true,false);
            exit;
          }
        }
        echo PopupWidowHref($title,"修改基本資料完成","./StaffList.php",true,false);
        exit;
      }
      echo PopupWidowHref($title,"修改部門失敗，請聯絡公司相關IT人員",false,true,false);
      exit;
    }
    echo PopupWidowHref($title,"修改基本資料失敗，請聯絡公司相關IT人員",false,true,false);
    exit;
  }
}
?>

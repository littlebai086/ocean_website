<?php
session_start();
require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");
$state=$_GET['state'];
$form="";
$items=array("member_id","username","tax_id_number","company_chinese","company_english","contact_name","gender","contact_cellphone","contact_company_phone","contact_company_extension","contact_company_fax","contact_email","city_id","area_id","company_address");

if(isset($_POST['emp_edit_send'])){
  if($state=="add"){
    $title="測試海運網會員註冊";
    $submit="註冊";
  }elseif($state=="update"){
    $title="測試海運網會員修改";
    $submit="修改";
  }
  $error=true;
  if(!isset($_POST['area_id'])){$data_array["area_id"]=0;}
  foreach ($items as $item){
    if($item=="area_id"){
      if(!isset($_POST[$item])){
        $data_array[$item]=0;
        continue;
      }
    }
    $data_array[$item]=trim($_POST[$item]);
  }

}elseif($state=="add"){
  $title="測試海運網會員註冊";
  $submit="註冊";
  $error=false;
  foreach ($items as $item){
    if ($item=="member_id"){
      $data_array[$item]=0;
    }else{
      $data_array[$item]="";
    }
  }
  $form=getMemberInformationForm($state,"customer",$data_array);
}elseif($state=="update"){
  $title="測試海運網會員修改";
  $submit="修改";
  $error=false;
  $row=getMemberUsername($_SESSION['username']);
  if($row['area_id']){
    $area_array=getAreaId($row['area_id']);
    $row['city_id']=$area_array['city_id'];
  }else{
    $row['city_id']=0;
  }
  foreach ($items as $item){
    $data_array[$item]=$row[$item];
  }
  $form=getMemberInformationForm($state,$_SESSION['identity'],$data_array);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo TESTransportCommonHtmlHead("測試海運網登入");?>
    <script src="../../js/MemberRegisterInformation.js"></script>
    <script language="javascript">

    window.onload=function(){
    //讀取sessionStorage物件中的內容
      var myhtml= window.sessionStorage.getItem("myhtml");
    //不為空表示是返回上一步進入該頁面的。
      if(myhtml!=null){
        //將sessionStorage物件中儲存的頁面新增到頁面中
        $("form").html(myhtml);
        //清空sessionStorage物件的內容。
        window.sessionStorage.clear();
      }
    }
    </script>
  </head>
  <body class="text-center">
<?php
echo TESTransportCommonHtmlBody();
list($result,$html)=TESTransportHeader(true,true);
echo $html;
if(!$result){exit;}
echo PopupWidowScriptHiddenButton(false,"RegisterSuccessMessage");
echo PopupWidowScriptHiddenButton("verification_code","RegisterErrorMessage");
echo PopupWidowHref("測試海運網","請檢查帳號的信箱是否收到驗證信。",false,false,"verification_code");
?>
<!-- Modal -->
  <form method="post" action="MemberRegister.php?state=<?php echo $state;?>" id="loginForm"  class="form-inline" >
    <input type="text" id="error" value="<?php echo $error;?>" hidden>
    <input type="text" id="state" value="<?php echo $state;?>" hidden>
    <input type="text" id="member_id" name="member_id" value="<?php echo $data_array['member_id'];?>" hidden>
   <div class="row justify-content-md-center">
      <div class="col-md-12">
        <!--<img class="mb-4" src="../../assets/brand/TEST_log.jpg" alt="" width="200" height="100">-->
        <h1 class="h3 mb-3 fw-normal"><?php echo $title;?></h1>
      </div>
    </div>
      <?php echo $form;?>
    </div>
    <?php
    if($form){
      echo "<button type='submit' name='emp_edit_send' class='btn btn-success'>".$submit."</button>
    <button type='button' class='btn btn-secondary' onclick=\"location.href='../index.php'\">回首頁</button>";
    }
    ?>
    <!--<p class="mt-5 mb-3 text-muted">&copy; 2017–2021 </p>-->
  </form>
  <div class="footer">
    <?php echo TESTransportMemberRegisterFooter();?>
  </div>
  </body>
</html>
<?php
if(isset($_POST['emp_edit_send'])){
  if($state=="add"){
    $title="測試會員註冊";
    $data_array['password']=$_POST['password'];
    $data_array['confirm_password']=$_POST['confirm_password'];
    $data_array['username_verification_code']=$_POST['username_verification_code'];
    $member_log=getMemberLogRegisterUsername($data_array['username']);
  }elseif($state=="update"){
    $title="測試會員修改";
    $member_log=false;
  }
  $data_array['company_english']=strtoupper($data_array['company_english']);
  list($result,$message)=getMemberDecide($state,$data_array,$member_log);
  if(!$result){
    echo PopupStaticWidowHref($title,$message,"back",true,"RegisterErrorMessage");
    exit;
  }
  if ($state=="add"){
    $data_array['password'] = password_hash($data_array['password'], PASSWORD_DEFAULT);
    if (sqlInsertMember($data_array) && sqlUpdateMemberLogPass($member_log['member_log_id'],1)){
      list($account,$auth)=getAccountAuth();
      $emailname="測試海運網";
      $subject="【TEST測試海運網】新會員註冊通知";
      $recipients=getAllSendMailDataDecide("staff","jack;alex",false);
      $msg=getSendMailMemberPassMsg(0,false);
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,false,$recipients,false)){
        $_SESSION['username']=$data_array['username'];
        $_SESSION['pass']=0;
        $_SESSION['identity']='member';
        echo PopupStaticWidowHref($title,"註冊完成，待等管理人員驗證","../index.php",true,"RegisterSuccessMessage");
      }
    }else{
      echo PopupStaticWidowHref($title,"註冊失敗，請聯絡公司相關IT人員","back",true,"RegisterErrorMessage");
    }

  }elseif($state=="update"){
    if(sqlUpdateMember($data_array)){
      echo PopupStaticWidowHref($title,"修改會員資料完成","../index.php",true,"RegisterSuccessMessage");
    }else{
      echo PopupStaticWidowHref($title,"修改會員資料失敗，請聯絡公司相關IT人員","back",true,"RegisterErrorMessage");
    }
  }

}
?>

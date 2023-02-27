<?php
session_start();
require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");
$pass=0;
if(isset($_POST['username'])){
  $username=$_POST['username'];
  $row=getMemberUsername($username);
  if($row){
    $member_log=getMemberLogMemberId($row['member_id']);
    if(isset($member_log['pass']) && (isset($_POST['verification_code']) || isset($_POST['password']))){
      $pass=$member_log['pass'];
    }
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo QATransportCommonHtmlHead("洋宏海運網忘記密碼");?>
    <link href="../../css/signin.css" rel="stylesheet">
  <script type="text/javascript" language="javascript">
  $(document).ready(function(){
    $('#inputPassword').keyup(function(){
      return password_format(false);
    })
  $('#inputConfirmPassword').keyup(function(){
    return password_format(false);
  })
  $("form").submit(function(e){
    if($('#state').val()=="password"){
      if(password_format(false) && confirm_password_format(false)){
        return true;
      }else{
        return false;
      }
    }
  return true;
  });
});
</script>
    <style>
      #intro {
        background-image: url(../../images/login_bg.jpg);
        background-size: cover;
        height: 100vh;
      }
    </style>
    
   </head>
  <body class="text-center">
<?php
echo QATransportCommonHtmlBody();
echo PopupWidowScriptHiddenButton(1);
list($result,$html)=QATransportHeader(true,true);
  echo $html;
  if(!$result){exit;}
?> 
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form method="post" action="" class="bg-white  rounded-5 shadow-5-strong p-5">
                <!-- Email input -->
                <div class="mb-4">
                  <img class="mb-4" src="../../images/little_bai86.png" alt="" width="200" height="200">
                  <h1 class="h3 mb-3 fw-normal">測試海運網忘記密碼</h1>
                </div>
                <?php
                $content="";
                if(isset($_POST['verification_code']) && $pass==1){
                  $content.="
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='username' placeholder='user' readonly='readonly' value='".$username."'>
                  <label for='floatingInput'>帳號</label>
                </div>
                <div class='form-floating form-outline mb-4'>
                  <input type='password' class='form-control' id='inputPassword' name='password' placeholder='請輸入密碼' required='required'>
                  <label for='floatingInput'>密碼</label>
                </div>
                <span id='password_message' class='text-start'></span>
                <div class='form-floating form-outline mb-4'>
                  <input type='password' class='form-control' id='inputConfirmPassword' name='confirm_password' placeholder='請輸入密碼' required='required'>
                  <label for='floatingInput' class='text-start'>確認密碼</label>
                  <span id='confirm_password_message' class='text-start'></span>
                </div>
                
                <input type='text' id='state' name='state' value='password' hidden>
                  ";
                  $submit="變更密碼";
                }elseif(isset($_POST['username'])){
                  $content.="
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='username' placeholder='user' readonly='readonly' value='".$username."'>
                  <label for='floatingInput'>帳號</label>
                </div>
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='verification_code' placeholder='請輸入驗證碼' required='required'>
                  <label for='floatingInput'>驗證碼</label>
                </div>
                <input type='text' id='state' name='state' value='verification_code' hidden>
                  ";
                  $submit="驗證";
                }else{
                $content.="
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='username' placeholder='user' required='required'>
                  <label for='floatingInput'>帳號</label>
                </div>
                <input type='text' id='state' name='state' value='username' hidden>";
                $submit="重設密碼";
                }
                echo $content;
                ?>

                <input type="submit" name="emp" class="btn btn-success" value="<?php echo $submit;?>">
                <button type="button" class="btn btn-primary" onclick="location.href='./MemberLogin.php'">回登入頁面</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="footer">
  <?php echo QATransportFooter();?>
</div>
</body>
</html>

<?php
/*
    if(strtotime("+5 minute",strtotime($member_log['create_time']))>=strtotime("now")){
      echo PopupWidowHref("洋宏海運網","會員驗證碼時效已超過5分鐘，請在操作一次取得新的驗證碼。","./MemberForgetPassword.php",true,1);    
    }elseif($member_log['frequency']>5){
      echo PopupWidowHref("洋宏海運網","會員驗證次數已超過5次，請在操作一次取得新的驗證碼。","./MemberForgetPassword.php",true,1);
    }elseif (password_verify($verification_code, $member_log['verification_code'])){
      echo PopupWidowHref("洋宏海運網","會員驗證碼正確，請重新輸入密碼",false,true,1);
    }else{
      if(sqlUpdateMemberLogFrequency($member_log['id'],($member_log['frequency']+1))){
        echo PopupWidowHref("洋宏海運網","會員驗證碼錯誤",false,true,1);
      }
    }
*/
$title="洋宏海運網";
if(isset($_POST['password']) && $pass==1){
  echo $password=$_POST['password'];
  $confirm_password=$_POST['confirm_password'];
  if(strtotime("+30 minute",strtotime($member_log['create_time']))<=strtotime("now")){
    echo PopupWidowHref("洋宏海運網","會員修改密碼時效已超過30分鐘，請在操作一次。","./MemberForgetPassword.php",true,1);
  }
  if (!PasswordFormat($password)){
    echo PopupWidowHref($title,"會員密碼格式錯誤，請再重新輸入",false,true,false);
    exit;
  }
  if ($password!=$confirm_password){
    echo PopupWidowHref($title,"密碼與確認密碼不相同",false,true,false);
    exit;
  }
  $password = password_hash($password, PASSWORD_DEFAULT);
  if(sqlUpdateMemberIdPassword($row['member_id'],$password)){
    echo PopupWidowHref("洋宏海運網","會員密碼修改成功","./MemberLogin.php",true,1);
  }else{
    echo PopupWidowHref("洋宏海運網","會員密碼修改失敗，請聯絡公司相關IT人員",false,true,1);
  }
}elseif(isset($_POST['verification_code']) && $pass==0){
  $verification_code=$_POST['verification_code'];
  if($member_log){
    if(strtotime("+10 minute",strtotime($member_log['create_time']))<=strtotime("now")){
      echo PopupWidowHref("洋宏海運網","會員驗證碼時效已超過10分鐘，請在操作一次取得新的驗證碼。","./MemberForgetPassword.php",true,1);    
    }elseif($member_log['frequency']>=5){
      echo PopupWidowHref("洋宏海運網","會員驗證次數已超過5次，請在操作一次取得新的驗證碼。","./MemberForgetPassword.php",true,1);
    }elseif (password_verify($verification_code, $member_log['verification_code'])){
      if(sqlUpdateMemberLogPass($member_log['member_log_id'],1)){
        echo PopupWidowHref("洋宏海運網","會員驗證碼正確，請輸入新密碼","reload",true,1);
      }
    }else{
      if(sqlUpdateMemberLogFrequency($member_log['member_log_id'],($member_log['frequency']+1))){
        echo PopupWidowHref("洋宏海運網","會員驗證碼錯誤".($member_log['frequency']+1)."次",false,true,1);
      }
    }
  }
}elseif(isset($_POST['username']) && $pass==0){
  if($row){
    $verification_code=GetrandVerificationCode(4);
    $new_verification_code=password_hash($verification_code, PASSWORD_DEFAULT);
    if(sqlInsertMemberLog($row['member_id'],$new_verification_code)){
      list($account,$auth)=getAccountAuth();
      $emailname="[系統自動寄送]洋宏海運網";
      $subject="測試中-洋宏海運網會員忘記密碼";
      $recipients=array(array("email"=>$row['username'],"name"=>$row['contact_name']));
      $msg="<span style='font-family:Microsoft JhengHei;'>您的驗證碼是:".$verification_code."，此驗證碼為10分鐘效力，若超過時間則須再操作一次。</span>";
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,false,$recipients,false)){
        echo PopupWidowHref("洋宏海運網","會員驗證碼已寄送",false,true,1);
      }else{
        echo PopupWidowHref("洋宏海運網","會員驗證碼寄送失敗，請聯絡公司相關IT人員","./MemberForgetPassword.php",true,1);      
      }
    }else{
      echo PopupWidowHref("洋宏海運網","會員驗證失敗，請聯絡公司相關IT人員","./MemberForgetPassword.php",true,1);      
    }
  }else{
    echo PopupWidowHref("洋宏海運網","無此會員帳號","./MemberForgetPassword.php",true,1);
  }
}
?>

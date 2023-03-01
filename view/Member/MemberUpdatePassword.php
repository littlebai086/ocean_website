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

?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo TESTransportCommonHtmlHead("測試海運網修改密碼");?>
    <link href="../../css/signin.css" rel="stylesheet">
    <script type="text/javascript" language="javascript">
  $(document).ready(function(){
    console.log($('#state').val());
    $('#inputPassword').keyup(function(){
      return password_format(false);
    })
  $('#inputConfirmPassword').keyup(function(){
    console.log($('#inputConfirmPassword').val());
    return password_format(false);
  })
  $("form").submit(function(e){
    if($('#state').val()=="verification_code"){
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
        background-image: url(../../images/b6.jpg);
        background-size: cover;
        height: 100vh;
      }
    </style>
    
   </head>
  <body class="text-center">
<?php
  echo TESTransportCommonHtmlBody();
  echo PopupWidowScriptHiddenButton(1,1);
  list($result,$html)=TESTransportHeader(true,false);
  echo $html;
  if(!$result){exit;}
  $username=$_SESSION['username'];
  $member_array=getMemberUsername($username);
  if(isset($_POST['username'])){
    $username=$_POST['username'];
    $row=getMemberUsername($username);
  }
?> 
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form method="post" action="" class="bg-white  rounded-5 shadow-5-strong p-5">
                <!-- Email input -->
                <div class="mb-4">
                  <img class="mb-4" src="../../assets/brand/TEST_log.png" alt="" width="200" height="100">
                  <h1 class="h3 mb-3 fw-normal">測試海運網修改密碼</h1>
                </div>
                <?php
                $content="";
                if(isset($_POST['username'])){
                  $content.="
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='username' placeholder='user' readonly='readonly' value='".$username."'>
                  <label for='floatingInput'>帳號</label>
                </div>
                <div class='form-floating form-outline mb-4'>
                  <input type='password' class='form-control' id='inputPassword' name='password' placeholder='請輸入密碼' required='required'>
                  <label for='floatingInput'>新密碼</label>
                </div>
                <span id='password_message' class='text-start'></span>
                <div class='form-floating form-outline mb-4'>
                  <input type='password' class='form-control' id='inputConfirmPassword' name='confirm_password' placeholder='請輸入密碼' required='required'>
                  <label for='floatingInput' class='text-start'>確認新密碼</label>
                  <span id='confirm_password_message' class='text-start'></span>
                </div>
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='verification_code' placeholder='請輸入驗證碼' required='required'>
                  <label for='floatingInput'>驗證碼</label>
                </div>
                <input type='text' id='state' name='state' value='verification_code' hidden>
                  ";
                  $submit="驗證";
                }else{
                  $email_content="";
                  if($member_array['contact_email']!=$username){
                    $email_content="<div class='form-check'>
                        <input class='form-check-input' type='radio' name='email' id='flexRadioEmail1' value='".$username."'>
                        <label style='float:left;' class='form-check-label' for='flexRadioEmail1'>
                          ".$username."
                        </label>
                      </div>";
                  }
                $content.="
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='username' required='required' readonly='readonly' value='".$username."'>
                  <label for='floatingInput'>帳號</label>
                </div>
                <div class='form-floating form-outline mb-4'>
                  <input type='text' class='form-control' name='password' required='required' value=''>
                  <label for='floatingInput'>目前密碼</label>
                </div>
                
                <p class='text-start'>寄送信箱</p>
                
                ".$email_content."
                <div class='form-check'>
                  <input class='form-check-input' type='radio' name='email' id='flexRadioEmail2' value='".$member_array['contact_email']."'checked>
                  <label style='float:left;' class='form-check-label' for='flexRadioEmail2'>
                    ".$member_array['contact_email']."
                  </label>
                </div>
                <input type='text' id='state' name='state' value='username' hidden>";
                $submit="驗證碼寄送";
                }
                echo $content;
                ?>
                <input type="submit" name="emp" class="btn btn-success" value="<?php echo $submit;?>">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<div class="footer">
  <?php echo TESTransportFooter();?>
</div>
</body>
</html>

<?php

$title="測試海運網";
if(isset($_POST['verification_code'])){
  $password=$_POST['password'];
  $confirm_password=$_POST['confirm_password'];
  $verification_code=$_POST['verification_code'];
  $member_log=getMemberLogMemberId($row['member_id']);
  if($member_log){
    if (!PasswordFormat($password)){
      echo PopupWidowHref($title,"會員密碼格式錯誤，請再重新輸入",false,true,false);
      exit;
    }
    if ($password!=$confirm_password){
      echo PopupWidowHref($title,"密碼與確認密碼不相同",false,true,false);
      exit;
    }
    if(strtotime("+10 minute",strtotime($member_log['create_time']))<=strtotime("now")){
      echo PopupWidowHref("測試海運網","會員驗證碼時效已超過10分鐘，請在操作一次取得新的驗證碼。","./MemberUpdatePassword.php",true,1);    
    }elseif($member_log['frequency']>=5){
      echo PopupWidowHref("測試海運網","會員驗證次數已超過5次，請在操作一次取得新的驗證碼。","./MemberUpdatePassword.php",true,1);
    }elseif (password_verify($verification_code, $member_log['verification_code'])){
      $password = password_hash($password, PASSWORD_DEFAULT);
      if(sqlUpdateMemberLogPass($member_log['member_log_id'],1) && sqlUpdateMemberIdPassword($row['id'],$password)){
        echo PopupStaticWidowHref("測試海運網","會員密碼修改成功，請重新登入","../MemberLogout.php",true,1);
      }
    }else{
      if(sqlUpdateMemberLogFrequency($member_log['member_log_id'],($member_log['frequency']+1))){
        echo PopupWidowHref("測試海運網","會員驗證碼錯誤".($member_log['frequency']+1)."次",false,true,1);
      }
    }
  }
}elseif(isset($_POST['username'])){
  $password=$_POST['password'];
  $email=$_POST['email'];
  if($row){
    if (password_verify($password, $row['password'])) {
      $verification_code=GetrandVerificationCode(4);
      $new_verification_code=password_hash($verification_code, PASSWORD_DEFAULT);
      if(sqlInsertMemberLog($row['member_id'],$new_verification_code)){
        list($account,$auth)=getAccountAuth();
        $emailname="[系統自動寄送]測試海運網";
        $subject="測試中-測試海運網會員修改密碼";
        $recipients=array(array("email"=>$email,"name"=>$row['contact_name']));
        $msg="<span style='font-family:Microsoft JhengHei;'>您的驗證碼是:".$verification_code."，此驗證碼為10分鐘效力，若超過時間則須再操作一次。</span>";
        if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,false,$recipients,false)){
          echo PopupWidowHref("測試海運網","會員驗證碼已寄送",false,true,1);
        }else{
          echo PopupStaticWidowHref("測試海運網","會員驗證碼寄送失敗，請聯絡公司相關IT人員","./MemberUpdatePassword.php",true,1);      
        }
      }else{
        echo PopupStaticWidowHref("測試海運網","會員驗證失敗，請聯絡公司相關IT人員","./MemberUpdatePassword.php",true,1);      
      }
    }else{
      echo PopupStaticWidowHref("測試海運網","密碼錯誤","./MemberUpdatePassword.php",true,1);
    }
  }
}
?>

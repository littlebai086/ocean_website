<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo TESTransportCommonHtmlHead("測試海運網登入");?>
    <link href="../../css/signin.css" rel="stylesheet">
    <style>
      #intro {
        background-image: url(../../images/login_bg.jpg);
        background-size: cover;
        height: 100vh;
      }
    </style>
    <link href="../../css/signin.css" rel="stylesheet">
   </head>
  <body class="text-center">

<?php
  echo TESTransportCommonHtmlBody();
  echo PopupWidowScriptHiddenButton(2,1);
  list($result,$html)=TESTransportHeader(true,true);
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
                  <h1 class="h3 mb-3 fw-normal">測試海運網登入</h1>
                </div>
                <div class="form-floating form-outline mb-4">
                  <input type="text" class="form-control" id="user" name="username" placeholder="user" required="required">
                  <label for="floatingInput">帳號</label>
                </div>

                <!-- Password input -->
                <div class="form-floating form-outline mb-4">
                  <input type="password" class="form-control" id="pswd" name="password"placeholder="Password" required="required">
                  <label for="floatingPassword">密碼</label>
                </div>
                <input type="submit" name="emp_login" class="btn btn-success" value="會員登入">
                <button type="button" class="btn btn-primary" onclick="location.href='./MemberRegister.php?state=add'">註冊會員</button>
                <button type="button" class="btn btn-secondary" onclick="location.href='./MemberForgetPassword.php'">忘記密碼</button>
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

if(isset($_POST['emp_login'])){
  $title="測試會員登入";
  $username=$_POST['username'];
  $password=$_POST['password'];
  $row=getMemberUsername($username);
  if($row){
    if (password_verify($password, $row['password'])) {
      $_SESSION['member_id']=$row['member_id'];
      $_SESSION['username']=$username;
      $_SESSION['identity']='customer';
      $_SESSION['pass']=$row['pass'];
      $message=$row['contact_name'].getGenderChinese($row['gender'])."您好，歡迎登入測試海運網";
      if($row['pass']==0){
        $message.="，目前會員資訊正在審核中";
      }elseif($row['pass']==1){
        if(sqlInsertMemberLoginLog($row['member_id'])){
          "新增登入紀錄成功";
        }
      }elseif($row['pass']==2){
        $message="會員註冊失敗，煩請貴司聯繫我司相關人員協助 (02)1234-5678。";
      }
      if($row['pass_message']){
        $message.="<br>".$row['pass_message'];
      }
      if(getIpCommonHeadDecideInsert($row['member_id'],true)){
        "Ip已成功更新紀錄";
      }
      ini_set('session.gc_maxlifetime',600);
      echo PopupStaticWidowHref($title,$message,"../index.php",true,1);
    } else {
      echo PopupWidowHref($title,"密碼錯誤，密碼為英文數字混合至少8位數到16位數",false,true,2);
    }
  }else{
      echo PopupWidowHref($title,"無此會員帳號資訊",false,true,2);
  }
}
?>

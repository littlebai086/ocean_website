<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");
require_once("../../view/CommonPage.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>洋宏海運網後台登入</title>
    <link href="../../css/menu.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <link href="../../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="shortcut icon" href="../../images/ico.png">
    <link rel="icon" href="../../images/ico.png" type="image/ico" />
    <!-- Bootstrap core CSS -->


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../../css/signin.css" rel="stylesheet">
    <script src="../../js/CommonPage.js"></script>
   </head>
  <body class="text-center">

<?php
//echo PopupWidowScriptHiddenButton(2);
//echo QATransportHeader(true);
?> 

<main class="form-signin">    
      <form method="post" action="" id="loginForm">
    <img class="mb-4" src="../../assets/brand/qat_log.jpg" alt="" width="200" height="100">
    <h1 class="h3 mb-3 fw-normal">洋宏海運網後台登入</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="user" name="username" placeholder="user" 
        required="required">
      <label for="floatingInput">帳號</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="pswd" name="password"placeholder="Password"   
      required="required">
      <label for="floatingPassword">密碼</label>
    </div>

    <div class="checkbox mb-3">
    </div>
    <input type="submit" name="emp_login" class="btn btn-success" value="會員登入">
    <button type="button" class="btn btn-primary" onclick="location.href='./MemberRegister.php?state=add'">註冊會員</button>
    <!--<p class="mt-5 mb-3 text-muted">&copy; 2017–2021 </p>-->
  </form>
</main>
<div class="footer">
  <?php //echo QATransportFooter();?>
</div>
</body>
</html>

<?php
if(isset($_POST['emp_login'])){
  $title="洋宏會員登入";
  $username=$_POST['username'];
  $password=$_POST['password'];
  $row=getMemberUsername($username);
  if($row){
    if (password_verify($password, $row['password'])) {
      $_SESSION['username']=$username;
      $_SESSION['pass']=$row['pass'];
      $message=$row['company_chinese']."的".$row['contact_name'].getGenderChinese($row['gender'])."您好，歡迎登入洋宏海運網";
      if($row['pass']==0){
        $message.="，目前會員資訊正在審核中";
      }
      echo PopupWidowHref($title,$message,"../Index.php",true,2);
    } else {
      echo PopupWidowHref($title,"密碼錯誤，密碼為英文數字混合至少8位數到16位數",false,true,2);
    }
  }else{
      echo PopupWidowHref($title,"無此會員帳號資訊",false,true,2);
  }
}
?>

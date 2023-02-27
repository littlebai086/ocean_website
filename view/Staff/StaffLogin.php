<?php
session_start();
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../model/Staff.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");

?>
<!doctype html>
<html lang="en">
  <head>
  <?php 
  echo QATransportStaffCommonHtmlHead("測試海運網後台登入",true,false);
  ?>
  <link href="../../css/signin.css" rel="stylesheet">
  </head>
  <style>
    #intro {
      background-image: url(../../images/login_bg.jpg);
      background-size: cover;
      height: 100vh;
    }
  </style>
  <body class="text-center">
<?php
echo PopupWidowScriptHiddenButton("StaffNotLoginMessage","StaffLoginMessage");
?> 
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100"style="background-color: rgba(0, 0, 0, 0.4);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form method="post" action=""class="bg-white  rounded-5 shadow-5-strong p-5">
                <!-- Email input -->
                <div class="mb-4">
                  <img class="mb-4" src="../../images/little_bai86.png" alt="" width="200" height="200">
                  <h1 class="h3 mb-3 fw-normal">測試海運網後台登入</h1>
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
                <input type="submit" name="emp_login" class="btn btn-success" value="登入">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php 
  echo getBoostrapBlundleJsImportEnd();
?>
</body>

</html>

<?php
if(isset($_POST['emp_login'])){
  $title="測試後台登入";
  $username=$_POST['username'];
  $password=$_POST['password'];
  $row=getStaffAccountListUsername($username);
  if($row){
    if (password_verify($password, $row['password'])) {
      $_SESSION['username']=$username;
      $_SESSION['staff_id']=$row['staff_id'];
      $_SESSION['identity']='staff';
      $staff_array=getStaffListStaffId($_SESSION['staff_id']);
      $message=ucfirst(strtolower($username)).getGenderChinese($staff_array['gender'])."您好，歡迎登入測試海運網後台管理";

      echo PopupStaticWidowHref($title,$message,"../StaffIndex.php",true,"StaffLoginMessage");
    }else {
      echo PopupWidowHref($title,"密碼錯誤，密碼為英文數字混合至少8位數到16位數",false,true,"StaffNotLoginMessage");
    }
  }else{
      echo PopupWidowHref($title,"無此會員帳號資訊",false,true,"StaffNotLoginMessage");
  }
}
?>
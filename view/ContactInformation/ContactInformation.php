<?php
session_start();
require_once("../../PHPMailer/class.phpmailer.php");
require_once("../../model/CommonSql.php");
require_once("../../model/Member.php");
require_once("../../model/IpBlackList.php");
require_once("../../model/ContactInformation.php");
require_once("../../model/ContactTextProhibited.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/MemberController.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo QATransportCommonHtmlHead("測試海運網聯絡我們");?>
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
echo QATransportCommonHtmlBody();
echo PopupWidowScriptHiddenButton(1);
  list($result,$html)=QATransportHeader(true,true);
  echo $html;
  if(!$result){exit;}
?>
  <div>
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form method="post" action="" class="bg-white  rounded-5 shadow-5-strong p-5">
                <!-- Email input -->
                <div class="mb-4">
                  <h1 class="h3 mb-3 fw-normal">聯絡我們</h1>
                </div>
                <div class="form-floating form-outline mb-4">
                  <input type="text" class="form-control" id="name" name="name" required="required">
                  <label for="floatingInput">姓名</label>
                </div>

                <div class="form-floating form-outline mb-4">
                  <input type="text" class="form-control" id="phone" name="phone" required="required">
                  <label for="floatingInput">電話</label>
                </div>

                <!-- Password input -->
                <div class="form-floating form-outline mb-4">
                  <input type="email" class="form-control" id="email" name="email"  required="required">
                  <label for="floatingEmail">郵件</label>
                </div>

                <div class="form-floating form-outline mb-4">
                  <textarea class="form-control" name="message"  style="height: 150px"  required></textarea>
                  <label for="floatingTextarea">訊息內容</label>
                </div>

                <!-- Submit button -->
                <input type="submit" name="emp_submit" class="btn btn-success" value="寄出訊息">
              </form>
            </div>
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
  if(isset($_POST['emp_submit'])){
    $name=trim($_POST['name']);
    $phone=trim($_POST['phone']);
    $email=trim($_POST['email']);
    $message=getTextareaChangeEnterSymbol(addslashes(trim($_POST['message'])));
    $buf = sqlSelectContactTextProhibited();
    foreach($buf as $row){
      if(strpos($name, $row["text_prohibited"])!==false ||
      strpos($phone, $row["text_prohibited"])!==false ||
      strpos($message, $row["text_prohibited"])!==false
      ){
        if(!getIpBlackListIp($_SESSION['ip'])){
          if(!sqlInsertIpBlackList($_SESSION['ip'])){
            echo "新增失敗";
          }
        }
        echo getErrorUrlPage();
        exit;
      }
    }
    
    
    if(sqlInsertContactInformation($_SESSION['ip'],$name,$phone,$email,$message)){
      list($account,$auth)=getAccountAuth();
      $emailname="測試海運網";
      $subject="測試海運網聯絡訊息";
      $recipients=getAllSendMailDataDecide("staff","cs",false);
      $cc=getSendMailRecipientsArray($name,$email);
      $msg="<span style='font-family:Microsoft JhengHei;'>姓名:".$name."<br>電話:".$phone."<br>E-MAIL:".$email."<br>留言訊息:<br>".$message."</span>";
      if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,false,$recipients,$cc)){
        echo PopupWidowHref("測試海運網","留言資訊已寄送",false,true,1);
      }else{
        echo PopupWidowHref("測試海運網","留言失敗，請聯絡公司相關IT人員",false,true,1);      
      }
    }else{
      echo PopupWidowHref("測試海運網","留言失敗，請聯絡公司相關IT人員",false,true,1);
    }
  }
?>
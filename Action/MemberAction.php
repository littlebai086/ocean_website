<?php
require_once("../PHPMailer/class.phpmailer.php");
require_once('../model/CommonSql.php');
require_once('../model/Member.php');
require_once('../controllers/CommonController.php');
require_once('../controllers/CommonSqlController.php');
require_once('../controllers/CommonHtmlController.php');
require_once('../controllers/MemberController.php');
header('Content-Type:text/html;charset=utf-8');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
if (isset($_POST['val'])) {
    $val = $_POST['val'];
}
if (isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];
}
switch ($action) {
    case 'statistics':
        $array=getStaffMemberStatisticsCounterArray($member_id);
        $content_text=json_encode($array);
        break;
   case 'username':
    $content_array=array();
    $row=getMemberUsername($val);
    if ($row && $row['member_id']!=$member_id){
        $content_text=json_encode("Y");
    }else{
        $content_text=json_encode("N");
    }
   break;
   case 'email':
    $content_array=array();
    $row=getMemberContactEmail($val);
    if ($row && $row['member_id']!=$member_id){
        $content_text=json_encode("Y");
    }else{
        $content_text=json_encode("N");
    }
   break;  
   case 'username_verification_code':
    list($account,$auth)=getAccountAuth();
    $emailname="[系統自動寄送]洋宏海運網";
    $subject="【QAT洋宏海運網】電子信箱審核通知";
    $verification_code=GetrandVerificationCode(4);
    $recipients=array(array("email"=>$val,"name"=>$val));
    $cc=false;
    $msg="<span style='font-family:Microsoft JhengHei;'>
    親愛的客戶<br><br>
    您好<br><br>
    您的驗證碼為:".$verification_code."<br>
    此驗證碼有效期為10分鐘，<br>
    如果超過10分鐘，<br>
    請再重新點擊取得驗證碼。<br><br>
    謝謝。</span>";
    if(sqlInsertMemberLogRegisterUsername($val,password_hash($verification_code, PASSWORD_DEFAULT))){
        if(sendMailLetter($account,$auth,$account,$emailname,$subject,$msg,false,false,$recipients,$cc)){
            $content_text=json_encode("Y");
        }else{
            $content_text=json_encode("N");
        }
    }else{
        $content_text=json_encode("N");
    }
   break;  
}
echo $content_text;
?>
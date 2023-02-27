<?php
/**
 * 1.拿取寄件訊息EmailNotificationMessage的Id編號資料
 *
 * @author Peter Chang
 *
 * @param integer  $id  寄件訊息的ID
 *
 * @return array
 */
function getEmailNotificationMessageId($id){
	$buf=sqlSelectEmailNotificationMessageId($id);
	foreach ($buf as $row){
		return $row;
	}
}
/**
 * 1.此為寄送檔案上傳的路徑
 * 
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫EmailNotificationMessage的資料
 * 
 * @return string
 */
function getEmailNotificationMessageAttachPath($data_array=false){
    $date=date("Y-m-d");
    if($data_array!==false){
        //$date=substr($data_array['send_time'],0,10);
        $date=str_replace(":","-",str_replace(" ","_",$data_array['send_time']));
    }
    return "../../upload/EmailNotificationMessage/".$date."/";
}
/**
 * 1.員工後台會員寄件歷史訊息的表格資料
 * 
 * @author Peter Chang
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return string
 */
function getStaffMemberEmailNotificationMessageListSearchTable($start,$per){
  $items=array("subject","email_notification_message_pass","send_time");
  $table="";
  $buf=sqlSelectEmailNotificationMessageList($start,$per);
  foreach ($buf as $key=>$row){
    $table.="<tr>";
    $table.="<td>".($start+$key+1)."</td>";
    foreach ($items as $item){
      if($item=="email_notification_message_pass"){
        if($row[$item]==0){
          $pass_show="尚未寄送";
        }elseif($row[$item]==1){
          $pass_show="<font color='green'>寄送成功</font>";
        }elseif($row[$item]==2){
          $pass_show="<font color='red'>寄送失敗</font>";
        }
        $table.="<td>".$pass_show."</td>";
      }else{
        $table.="<td>".$row[$item]."</td>";
      }
      
    }

    $table.="<td>
      <input type='button' value='詳細資訊' class='btn btn-primary' onclick=\"location.href='./StaffMemberSendMailNotificationMessage.php?state=view&id=".$row['email_notification_message_id']."'\">
      ";
    $table.="</td></tr>";
  }
  return $table;
}
/**
 * 1.此為寄送會員全體信的Form表單
 * 
 * @author Peter Chang
 * 
 * @param integer $id 為EmailNotificationMessage的id
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @return string
 */
function getStaffMemberSendMailNotificaionMessageForm($id,$state){
  $attachment_html="<div class='row'>";
  if($state=="send_add"){
    $subject="洋宏海運網";
    $message=getEnterSymbolChangeTextarea("Attn.: 洋宏海運網的會員<br><br>您好<br><br><br><br>謝謝。<br><br><a href='https://qat.com.tw/'>洋宏海運網</a>");
    $readonly="";
    $submit="寄送";
    for($i=0;$i<3;$i++){
      if($i==0){$div_html="<label>附檔</label>";}else{$div_html="";}
      $attachment_html.="
    <div class='col col-lg-3'>
    </div>
    <div class='col col-lg-2'>
      ".$div_html."
    </div>
    <div class='col col-lg-5'>
      <input type='file' class='form-control' name='attachments[]'>
    </div>";
    }
  }elseif($state=="send" || $state=="view"){
    if($state=="send"){$submit="確認寄送";}elseif($state=="view"){$submit=false;}
    $data_array=getEmailNotificationMessageId($id);
    $subject=$data_array['subject'];
    $message=getEnterSymbolChangeTextarea($data_array['message']);
    $filenames=explode(";",$data_array['filename']);
    $readonly="readonly='readonly'";
    
    foreach ($filenames as $key=>$filename){
      if($key==0){$div_html="<label>附檔</label>";}else{$div_html="";}
      if($filename){
        $div_filename=getHtmlButtonBookingOrderMemberAttachmentIcon(getEmailNotificationMessageAttachPath($data_array).$filename,$filename);
      }else{
          $div_filename="";
      }
      $attachment_html.="
    <div class='col col-lg-3'>
    </div>
    <div class='col col-lg-2'>
      ".$div_html."
    </div>
    <div class='col col-lg-5'>
      ".$div_filename."
    </div>";
    }
  }
  $attachment_html.="</div>";
  $table="";
  $table.="
  <div class='row'>
    <div class='col col-lg-3'>
    </div>
    <div class='col col-lg-2'>
      寄件主旨
    </div>
    <div class='col col-lg-2'>
      <input type='text' class='form-control' name='subject' required='required' value='".$subject."' ".$readonly.">
    </div>
  </div>
  <div class='row'>
    <div class='col col-lg-3'>
    </div>
    <div class='col col-lg-2'>
      <label>寄件內容</label>
    </div>
    <div class='col col-lg-5'>
      <textarea class='form-control' id='TextareaContent' rows='8' name='message' required='required' ".$readonly.">".$message."</textarea>
    </div>
  </div>".$attachment_html."
  <p class='text-center'>
  ";
  if($submit!==false){
    $table.="<input type='submit' class='btn btn-success' value='".$submit."'>";
  }
  $table.="</p>";
  return $table;
}
?>
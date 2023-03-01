<?php 
/**
 * 1.抓資料庫Member搜尋條件為會員聯絡的Email
 * 
 * @author Peter Chang
 * 
 * @param string $email 為聯絡Email
 * 
 * @return array
 */
function getMemberContactEmail($email){
  $buf=sqlSelectMemberContactEmail($email);
  foreach ($buf as $row){
    return $row;
  }
}
/**
 * 1.抓資料庫Member 會員指定年月及該會員登入次數及下單次數
 * 
 * @author Peter Chang
 * 
 * @param string $year_month 查詢年月
 * 
 * @param integer $member_id 會員id
 * 
 * @return array
 */
function getMemberLoginLogDataStatisticsMemberId($year_month,$member_id){
  $buf=sqlSelectMemberLoginLogDataStatisticsMemberId($year_month,$member_id);
  foreach ($buf as $row){
    return $row;
  }
}
/**
 * 1.員工後台會員資訊顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param integer $pass 會員審核的狀態
 * 
 * @param array $search_fields 為使用者搜尋的資訊
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return string
 */
function getStaffMemberListSearchTable($pass,$search_fields,$start,$per){
  $staff_array=getStaffListStaffId($_SESSION['staff_id']);
  $items=array("username","company_chinese","company_english","tax_id_number","contact_name","contact_email");
  $table="";
  $buf=sqlSelectMemberPassList($pass,$search_fields,$start,$per);
  foreach ($buf as $key=>$row){
    $table.="<tr>";
    $table.="<td>".($start+$key+1)."</td>";
    foreach ($items as $item){
      $table.="<td>".$row[$item]."</td>";
    }
    $table.="<td>".
    getHtmlAHrefInformationIcon("./StaffMemberInformation.php?state=information&id=".$row['member_id']);
    if(strpos($staff_array['department'],"資訊")!==false ||
            strpos($staff_array['position'],"總經理")!==false ||
            $staff_array['staff_id']==12){
      if($pass==1){
        $table.=getHtmlAHrefUpdateIcon("./StaffMemberInformation.php?state=update&id=".$row['member_id']);
        $table.=getHtmlAHrefAddBlackListIcon("#",
          "PopupCloseWidowClick(\"add_blacklist\",\"./StaffMemberInformation.php?state=add_blacklist&id=".$row['member_id']."\")");

      }elseif($pass==3){
        $table.=getHtmlAHrefRemoveBlackListIcon("#",
          "PopupCloseWidowClick(\"remove_blacklist\",\"./StaffMemberInformation.php?state=remove_blacklist&id=".$row['member_id']."\")");
      }
    }
    $table.="</td></tr>";
  }
  return $table;
}
/**
 * 1.員工後台單個會員統計資訊的陣列
 * 
 * @author Peter Chang
 * 
 * @param integer $member_id 為會員的id
 * 
 * @return string
 */
function getStaffMemberStatisticsCounterArray($member_id){
  $data_array=getMemberId($member_id);
  $start_date =substr($data_array['register_time'],0,7);
  //$end_date = date('Y-m');
  $end_date = "2022-12";
  $num=getMonthNum($start_date,$end_date);
  $array=array();
  for($i=0;$i<=$num;$i++){
    $year_month= date('Y-m', strtotime(' '.$i.' month', strtotime($start_date)));
    $data_array=getMemberLoginLogDataStatisticsMemberId($year_month,$member_id);
    $array["year_month_array"][$i]=$year_month;
    $array["login_statistics_array"][$i]=$data_array['member_login_statistics'];
    $array["booking_order_statistics_array"][$i]=$data_array['booking_order_statistics'];
  }
  return $array;
}
/**
 * 1.員工後台單個會員統計資訊的表格
 * 
 * @author Peter Chang
 * 
 * @param integer $member_id 為會員的id
 * 
 * @return string
 */
function getStaffMemberStatisticsInformationTable($member_id){
  $arrays=getStaffMemberStatisticsCounterArray($member_id);
  $table="
      <table class='table'>
  <thead>
    <tr>
      <th scope='col'>年月</th>
      <th scope='col'>登入次數</th>
      <th scope='col'>下單次數</th>
    </tr>
  </thead>
  <tbody>";
  foreach($arrays["year_month_array"] as $key => $value){
    $table.="
    <tr>
      <td>".$arrays["year_month_array"][$key]."</td>
      <td>".$arrays["login_statistics_array"][$key]."</td>
      <td>".$arrays["booking_order_statistics_array"][$key]."</td>
    </tr>";
  }
    $table.="</tbody>
</table>";
  return $table;
}


/**
 * 1.員工後台會員統計資訊顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param array $search_fields 為使用者搜尋的資訊
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return string
 */
function getStaffMemberDataStatisticsListSearchTable($search_fields,$start,$per){
  $items=array("username","company_chinese","company_english","tax_id_number","contact_name","member_login_statistics","booking_order_statistics");
  $table="";
  $buf=sqlSelectMemberLoginLogDataStatisticsList($search_fields,$start,$per);
  foreach ($buf as $key=>$row){
    $table.="<tr>";
    $table.="<td>".($start+$key+1)."</td>";
    foreach ($items as $item){
      $table.="<td>".$row[$item]."</td>";
    }

    $table.="<td>";
    $table.=getHtmlAHrefInformationIcon("./StaffMemberInformation.php?state=information_statistics&id=".$row['member_id']);
    $table.="</td></tr>";
  }
  return $table;
}
/**
 * 1.MemberList資料庫使用者搜尋的資訊做SQL判斷
 * 
 * @author Peter Chang
 * 
 * @param string $sql 先前SQL的資料
 * 
 * @param array $search_fields 使用者搜尋的資訊
 * 
 * @return string
 */
function getStaffMemberListSqlSearchWhere($sql,$search_fields){
  if ($search_fields!==false){
        foreach ($search_fields as $key => $value){
          if($value){
            $sql.=" and `".$key."` like '%".$value."%' ";
          }
        }
    }
    return $sql;
}
/**
 * 1.接收會員註冊資訊或修改判斷是否格式有誤
 * 
 * @author Peter Chang
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array POST到的資訊存入$data_array
 * 
 * @param array $member_log 此為資料庫MemberLog的資料
 * 
 * @return array(boolean,string)
 */
function getMemberDecide($state,$data_array,$member_log){
  if ($state=="add"){
    if (!EmailFormat($data_array['username'])){
      return array(false,"註冊會員E-MAIL格式錯誤");
    }
    if (getMemberUsername($data_array['username'])){
      return array(false,"會員已有此帳號");
    }
    if(strtotime("+10 minute",strtotime($member_log['create_time']))<=strtotime("now")){
      return array(false,"帳號驗證碼時效已超過10分鐘，請在操作一次取得新的驗證碼。");
    }elseif($member_log['frequency']>=5){
      return array(false,"帳號驗證次數已超過5次，請在操作一次取得新的驗證碼。");
    }elseif (!password_verify($data_array['username_verification_code'], $member_log['verification_code'])){
      if(sqlUpdateMemberLogFrequency($member_log['member_log_id'],($member_log['frequency']+1))){
        return array(false,"會員驗證碼錯誤".($member_log['frequency']+1)."次");
      }
    }
    if (!PasswordFormat($data_array['password'])){
      return array(false,"註冊會員密碼格式錯誤，請再重新輸入");
    }
    if ($data_array['password']!=$data_array['confirm_password']){
      return array(false,"密碼與確認密碼不相同");
    }
  }

  if (!NumberFormat(8,$data_array['tax_id_number'])){
    return array(false,"統編格式錯誤，統編應為數字8碼");
  }
  if (!ChineseFormat($data_array['company_chinese'])){
    return array(false,"公司中文名稱應為中文，不該包含英文及數字和特殊符號空白...等");  
  }
  list($result,$message)=getStaffMemberCommonDecide($data_array);
  if(!$result){
    return array(true,$message);
  }
  if (!LocalCellPhoneFormat($data_array['contact_cellphone']) && $data_array['contact_cellphone']){
    return array(false,"聯絡人電話應為數字10碼");
  }
  if (!LocalTelePhoneFormat($data_array['contact_company_phone'])){
    return array(false,"公司電話格式應類似為(02)1234-5678");
  }
  if (!LocalTelePhoneFormat($data_array['contact_company_fax']) && $data_array['contact_company_fax']){
    return array(false,"公司傳真格式應類似為(02)2715-0606");
  }
  $row=getMemberUsername($data_array['username']);
  if ($row && $row['member_id']!=$data_array['member_id']){
    return array(false,"此使用者帳號已申辦過");
  }
  if (!EmailFormat($data_array['contact_email'])){
    return array(false,"E-MAIL格式錯誤");
  }
  $row=getMemberContactEmail($data_array['contact_email']);
  if ($row && $row['member_id']!=$data_array['member_id']){
    return array(false,"此E-MAIL已申辦過");
  }
  return array(true,"資料格式全為正確");
}
/**
 * 1.接收會員資訊或修改判斷是否格式有誤
 * 
 * @author Peter Chang
 * 
 * @param array $data_array POST到的資訊存入$data_array
 * 
 * @return array(boolean,string)
 */
function getStaffMemberCommonDecide($data_array){
  if (!ChineseFormat($data_array['company_chinese'])){
    return array(false,"公司中文名稱應為中文，不該包含英文及數字和特殊符號空白...等");  
  }
  if (!CompanyEnglishFormat($data_array['company_english']) && trim($data_array['company_english'])!=""){
    return array(false,"公司英文名稱應為英文，不該有中文及一些特殊符號");
  }
  if ($data_array['area_id']){
    if (!getAreaId($data_array["area_id"])){
      return array(false,"無此公司地區或格式錯誤");
    }
    if($data_array["company_address"]){
      if (!$data_array["company_address"]){
        return array(false,"請填寫公司地址");
      }
    }
  }
  return array(true,"資料格式全為正確");
}
/**
 * 1.StaffList資料庫使用者搜尋的資訊做SQL判斷
 * 
 * @author Peter Chang
 * 
 * @param string $sql 先前SQL的資料
 * 
 * @param array $search_fields 使用者搜尋的資訊
 * 
 * @return string
 */
function getStaffMemberStatisticsListSqlOrderBy($sql,$search_fields){
  if ($search_fields!==false){
    if($search_fields["main_sort"]=="member_login"){
      $sql.=" ORDER BY `member_login_statistics` ".strtoupper($search_fields["member_login_sort"]).",`booking_order_statistics` ".strtoupper($search_fields["booking_order_sort"])." ";
    }elseif($search_fields["main_sort"]=="booking_order"){
      $sql.=" ORDER BY `booking_order_statistics` ".strtoupper($search_fields["booking_order_sort"]).",`member_login_statistics` ".strtoupper($search_fields["member_login_sort"])." ";
    }
  }
  return $sql;
}
?>
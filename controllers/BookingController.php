<?php
/**
 * 1.拿取訂艙單的Id編號資料
 *
 * @author Peter Chang
 *
 * @param integer  $id  訂艙資料庫的ID
 *
 * @return array
 */
function getBookingOrderId($id){
	$buf=sqlSelectBookingOrderId($id);
	foreach ($buf as $row){
        return getDestinationIdCountryIdArray($row);
	}
}
/**
 * 1.抓取資料為條件該員工為服務人員及符合步驟
 * 
 * @author Peter Chang
 * 
 * @param integer $staff_id 員工編號id
 * 
 * @param integer $schedules 步驟的編碼
 * 
 * @return array|false
 */
function getBookingOrderCsDocFinancialStaffId($staff_id,$schedule){
    $buf = sqlSelectBookingOrderCsDocFinancialStaffId($staff_id,$schedule);
    if($buf !==false){
        foreach ($buf as $row){
            return $row;
        }
    }
    return false;
}
/**
 * 1.此陣列為訂艙新增修改的Form Value欄位
 * 
 * @author Peter Chang
 * 
 * @return array
 */
function getBookingOrderFormBookingOrderArray(){
    $array=array("booking_order_id","member_id","shipment_type","purchase_order_no","lc_no","hs_code","cargo_weight","dangerous_goods","class","un_no","volume","cfs_quantity_unit_id","cabinet_volume","terms_of_trade","terms_of_trade_remark","cut_off_place_id","goods_date","cut_off_date","onboard_date","destination_country_id","destination_id","ocean_export_price_data","remark","trading");
    return $array;
}
/**
 * 1.此陣列為訂艙新增修改的Form Value會員欄位
 * 
 * @author Peter Chang
 * 
 * @return array
 */
function getBookingOrderFormMemberArray(){
    $array=array("company_chinese","contact_name","contact_company_phone","contact_company_extension","contact_company_fax","contact_email");
    return $array;
}
/**
 * 1.拿取危險品Html Select Option的資料
 * 
 * @author Peter Chang
 * 
 * @param string $value 是否有預設Select Option資料
 * 
 * @return string
 */
function getDangerousGoodsSelect($value){
	$result="";
	$buf=getDangerousDoodsArray();
	foreach ($buf as $row){
        if ($row===$value){
            $result.= "<option value='".$row."' selected>".$row."</option>";
        }elseif($row=="非危險品" && !$value){
            $result.= "<option value='".$row."' selected>".$row."</option>";
        }else{
            $result.= "<option value='".$row."'>".$row."</option>";
        }
	}
	return $result;
}
/**
 * 1.訂艙櫃子尺寸Html Div Input Name cabinet_volume[]的資料
 * 
 * @author Peter Chang
 * 
 * @param string $value 是否有資料庫的預設資料
 * 
 * @return string
 */
function getCabinetVolumeInput($value){
	$array=getBookingOrderCabinetVolumeStrToArray($value);
	$result="";
	$buf=getCabinetVolumeArray();
	foreach ($buf as $row){
		$result.="
		<div class='col align-items-center'>
           <input type='number' class='form-control' name='cabinet_volume[]' min=0  value=".$array[$row['sql_name']]." style='width: 70px;float:left;''>
          <p class='text-start'>&ensp;".$row['show_name']."</p>
        </div>";
	}
	return $result;
}
/**
 * 1.訂艙貿易條件Html Div Input Name terms_of_trade的資料
 *
 * @author Peter Chang
 * 
 * @param string $value 是否有勾選預設選項值
 * 
 * @return string
 */
function getTermsOfTradeRadio($value){
	$result="";
	$buf=getTermsOfTradeArray();
	foreach ($buf as $key=>$row){
		if ($value==$row){
			$result.="
		<div class='col' style='text-align:left'>
           <input type='radio' class='form-check-input' id='inputTermsOfTrade' name='terms_of_trade' value='".$row."' style='float:left;' checked>
            <p class='text-start'>".$row."</p>
        </div>";
		}elseif($key==0 && !$value){
			$result.="
		<div class='col' style='text-align:left'>
           <input type='radio' class='form-check-input' id='inputTermsOfTrade' name='terms_of_trade' value='".$row."' style='float:left;' checked>
            <p class='text-start'>".$row."</p>
        </div>";
    	}else{
			$result.="
		<div class='col' style='text-align:left'>
           <input type='radio' class='form-check-input' id='inputTermsOfTrade' name='terms_of_trade' value='".$row."' style='float:left;'>
            <p class='text-start'>".$row."</p>
        </div>";
    	}
	}
	return $result;
}
/**
 * 1.拿取員工訂艙列表相關共用彈跳視窗id及文字
 * 2.此文字必須配合jquery先行匯入及用jquery呼叫按鈕popup_id執行
 *
 * @author Peter Chang
 * 
 * @return string
 */
function getBookingOrderCommonListPopupButtonWidowHref(){
    $arrays=array(
        array("popup_id"=>1,"text"=>"是否要將此訂艙客服人員變成您?"),
        array("popup_id"=>2,"text"=>"是否成為此票提單核對人員?"),
        array("popup_id"=>3,"text"=>"是否成為此票財務收款人員?"),
        array("popup_id"=>11,"text"=>"填寫提供S/O日期?"),
        array("popup_id"=>12,"text"=>"填寫提供提單及帳單日期?"),
        array("popup_id"=>13,"text"=>"填寫收款日期?"),
        array("popup_id"=>14,"text"=>"填寫結案日期?"),
        array("popup_id"=>21,"text"=>"是否要將等待提單及收款單回復為等待S/O?"),
        array("popup_id"=>22,"text"=>"是否要將等待收款回復為等待提單及收款單?"),
        array("popup_id"=>23,"text"=>"是否要將等待等待結案回復為等待收款?"),
        array("popup_id"=>"cut_off_date","text"=>"是否要修改結關日?"),
        array("popup_id"=>"onboard_date","text"=>"是否要修改開航日?"),
        array("popup_id"=>"provide_so_pending","text"=>"此筆資料是否完成?"),
        array("popup_id"=>"document_check_pending","text"=>"此筆資料是否完成?")
    );
    $result="";
    $result.= PopupWidowScriptHiddenButton(true);
    foreach($arrays as $array){
        $result.= PopupWidowScriptHiddenButton(false,false,$array["popup_id"]);
        $result.= PopupCloseWidowHref("測試後台海運網",$array["text"],"確認","取消","",false,$array["popup_id"]);
    }
    return $result;
}
/**
 * 1.寄送訂艙列表相關資訊副本給客戶或是內部同仁
 * 2.將會根據客戶的訂艙資訊表顯示(會根據寄信略有判斷調整)
 * 3.寄信檔案會根據在哪個步驟的編碼為不同
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 *
 * @param string $state 訂艙單接收資訊的狀態
 * 
 * @return array
 */
function getSendBookingOrderSubjectMsgAttachCC($id,$state){
    $subject="";
    $cc=array();
    $cc_departments=false;
    $data_array=getBookingOrderId($id);
    $subject="【TEST測試海運網】訂艙編號：".getSerialCombinationStr($data_array);
    $attach_array=getBookingOrderSendMailAttachArray($state,$data_array);
    $msg=getSendMailOrderStatusMsg($data_array,$state);
    if($state=="cut_off_date"){
        $subject.="狀態：更改結關日期通知";
    }elseif($state=="onboard_date"){
        $subject.="狀態：更改開航日通知";
    }
    if($data_array['schedule']==1){
        $subject="【TEST測試海運網】客戶訂艙通知，訂艙編號：".getSerialCombinationStr($data_array);
    }elseif($data_array['schedule']==2){
        $staff_array=getStaffListId($data_array["cs_staff_id"]);
        if($state=="provide_so_pending"){
            $subject.="狀態：S/O已提供完成";
        }elseif($state=="provide_so_date"){
            $subject.="狀態：已經提供S/O，請參閱附件檔案";
            $cc_departments=getAllSendMailDataDecide("staff","doc",false);
        }elseif($state=="cut_off_date" || $state=="onboard_date"){
            $cc_departments=getAllSendMailDataDecide("staff","cs",false);
        }else{
            $subject.="狀態：等待提供S/O";
        }
    }elseif($data_array['schedule']==3){
        $staff_array=getStaffListId($data_array["doc_staff_id"]);
        if($state=="document_check_pending"){
            $subject.="狀態：提單及帳單已提供完成";
        }elseif($state=="document_check_date"){
            $subject.="狀態：已經提供提單及收款單，請參閱附件檔案";
            $cc_departments=getAllSendMailDataDecide("staff","financial",false);
        }elseif($state=="cut_off_date" || $state=="onboard_date"){
            $cc_departments=getAllSendMailDataDecide("staff","doc",false);
        }else{
            $subject.="狀態：等待提單及帳單";
        }
    }elseif($data_array['schedule']==4){
        $staff_array=getStaffListId($data_array["financial_staff_id"]);
        if($state=="collection_date"){
            $subject.="狀態：已收到款項";
            $cc_departments=getAllSendMailDataDecide("staff","jack",false);
        }else{
            $subject.="狀態：等待費用明細";
        }
    }elseif($data_array['schedule']==5){
        
    }
    if($data_array['schedule']!=1){
        $cc=getSendMailRecipientsArray(getTESTCompanySendShowName($staff_array),$staff_array['email']);
    }
    
    if($cc_departments!==false){
        foreach($cc_departments as $cc_department){
            array_push($cc,$cc_department);
        }
    }
    return array($subject,$msg,$attach_array,$cc);
}
/**
 * 1.為StaffBookingOrderInformation.php的狀態來回傳顯示頁面
 * 2.為員工上傳檔案及完成日期和結關或是開航日填寫
 *
 * @author Peter Chang
 *
 * @param string $state 訂艙單接收資訊的狀態
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return string
 */
function getBookingOrderFormDate($state,$data_array){
    $result="<form action='' method='post' enctype='multipart/form-data'>";
    $date_html="<input type='date' class='form-control' name='date' value='".date("Y-m-d")."' required='required' readonly='readonly'>";
    if($state=="provide_so_date"){
        $date_text="提供S/O日期";
        $attachment_text="S/O檔案上傳";
        if(!$data_array['cs_staff_date']){
            $result.=getStaffBookingOrderFieldShow("結關日","<input type='date' class='form-control' name='cut_off_date' min='".date("Y-m-d")."' value='".$data_array["cut_off_date"]."' required='required'>");
            $result.=getStaffBookingOrderFieldShow("開航日","<input type='date' class='form-control' name='onboard_date' min='".date("Y-m-d")."' value='".$data_array["onboard_date"]."' required='required'>");
        }
    }elseif($state=="document_check_date"){
        $date_text="提供提單及帳單日期";
        $attachment_text="帳單檔案上傳";        
    }elseif($state=="document_check_pending"){
        $date_text="提供提單及帳單日期";
        $attachment_text="帳單檔案上傳";
    }elseif($state=="collection_date"){
        $date_text="財務收款日期";
    }elseif($state=="case_closed_date"){
        $date_text="結案日期";
    }elseif($state=="cut_off_date"){
        $date_text="結關日期";
    }elseif($state=="onboard_date"){
        $date_text="開航日期";
    }
    if($state=="cut_off_date" || $state=="onboard_date"){
        $date_html="<input type='date' class='form-control' name='date' min='".date("Y-m-d")."' value='".$data_array[$state]."' required='required'>";
    }
    $result.= "
    <div class='row'>
        <div class='col col-lg-3'>
        </div>
        <div class='col col-lg-2'>
            ".$date_text."
        </div>
        <div class='col col-lg-2'>
            ".$date_html."
        </div>
    </div>";
    if($state=="provide_so_date" || $state=="document_check_date"){
        $result.=getStaffBookingOrderFieldShow($attachment_text,"<input type='file' class='form-control' name='attachments[]' id='inputAttachments' required='required'>");
    }
    if($state=="provide_so_date" && !$data_array['so_attachment']){
        for($i=0;$i<=1;$i++){
            $result.=getStaffBookingOrderFieldShow("","<input type='file' class='form-control' name='attachments[]'>");
        }
    }elseif($state=="document_check_date" && !$data_array['bill_of_lading_attachment'] && !$data_array['receive_bill_attachment']){
        $attachment_array=array("提單檔案上傳","其他檔案上傳");
        for($i=0;$i<=2;$i++){
            $required="";
            if(!isset($attachment_array[$i])){$attachment_array[$i]="";}
            if($i==0){$required="required='required'";}
            $result.=getStaffBookingOrderFieldShow($attachment_array[$i],"<input type='file' class='form-control' name='attachments[]' ".$required.">");
        }
    }elseif($state=="provide_so_date" && $data_array['so_attachment']){
        $result.=getStaffBookingOrderFieldShow("原檔案",$data_array['so_attachment']);
        $result.=getStaffBookingOrderUploadFileListShow();
    }elseif($state=="document_check_date" && $data_array['bill_of_lading_attachment'] && $data_array['receive_bill_attachment']){
        $result.=getStaffBookingOrderFieldShow("提單檔案上傳","<input type='file' class='form-control' name='attachments[]' required='required'>");
        $result.=getStaffBookingOrderFieldShow("原檔案",$data_array['bill_of_lading_attachment']);
        $result.=getStaffBookingOrderFieldShow("",$data_array['receive_bill_attachment']);
        $result.=getStaffBookingOrderUploadFileListShow();
    }
    
    $result.= "
    <div class='row'>
        <div class='col col-lg-5'>
        </div>
        <div class='col col-lg-1'>
            <input type='submit' class='btn btn-success' value='送出'>
        </div>
        <div class='cole col-auto'>
            <input type='button' value='回訂艙列表' onclick='history.back()' class='btn btn-secondary'>
        </div>
    </div>";
    return $result;
}
/**
 * 1.客服部上傳檔案使用
 * 2.根據StaffBookingOrderInformation.php 判斷為是否有S/O及上傳日期資料時進行上傳修改
 * 3.若沒有S/O檔案及上傳日，代表第一次上傳將去資料庫修改S/O檔案及附檔和上傳日期
 * 4.若有S/O檔案及上傳日，代表之前有上傳過資料庫只修改S/O檔案及上傳日期
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @param string $date 為接收客服部部上傳日期預設為當日
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @param string $filename 為上傳檔案的檔名，若第一次上傳第一個檔案為S/O剩餘為其他附件檔案，若先前有上傳過，$filename的檔案就只是S/O
 * 
 * @param $cut_off_date 為結關日
 * 
 * @param $onboard_date 為開航日
 * 
 * @return boolean 
 */
function getBookingOrderUpdateSqlCsStaffDateAttachment($id,$staff_array,$date,$data_array,$filename,$cut_off_date,$onboard_date){
    $data_array=getBookingOrderId($id);
    if(!$data_array['so_attachment'] && !$data_array['cs_staff_date']){
      $filenames=explode(";",$filename);
      $so=$filenames[0];
      $filename=implode(";",getArrayKeyDeleteKeyIndex($filenames,array(0)));
      return sqlUpdateBookingOrderCsStaffDateCsStaffAttchment($id,$staff_array['staff_id'],$cut_off_date,$onboard_date,$date,$so,$filename);
    }
    return sqlUpdateBookingOrderCsStaffDateSoAttachment($id,$staff_array['staff_id'],$date,$filename);
}
/**
 * 1.文件部上傳檔案使用
 * 2.根據StaffBookingOrderInformation.php 判斷為是否有提單及帳單和上傳日期資料時進行上傳修改
 * 3.若沒有提單及帳單檔案和上傳日期，代表第一次上傳將去資料庫修改提單及帳單檔案和其他附檔和上傳日期
 * 4.若有提單及帳單檔案及上傳日，代表之前有上傳過資料庫只修改提單及帳單檔案及上傳日期
 * 5.$filename共通為第一個檔案為帳單，第二個為提單檔案
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @param string $date 為接收文件部上傳日期預設為當日
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @param string $filename 為上傳檔案的檔名，若第一次上傳第一個檔案為帳單，第二個為提單檔案剩餘為其他附件檔案，若先前有上傳過，檔案就只是提單及帳單檔案
 * 
 * @return boolean 
 */
function getBookingOrderUpdateSqlDocStaffDateAttachment($id,$staff_array,$date,$data_array,$filename){
    $filenames=explode(";",$filename);
    $receive_bill=$filenames[0];
    $bill_of_lading=$filenames[1];
    if(!$data_array['receive_bill_attachment'] && !$data_array['bill_of_lading_attachment'] && !$data_array['doc_staff_date']){  
      $filename=implode(";",getArrayKeyDeleteKeyIndex($filenames,array(0,1)));
      return sqlUpdateBookingOrderDocStaffDateDocBillReceiveAttachment($id,$staff_array['staff_id'],$date,$bill_of_lading,$receive_bill,$filename);
    }
    return sqlUpdateBookingOrderDocStaffDateBillReceiveAttachment($id,$staff_array['staff_id'],$date,$bill_of_lading,$receive_bill);
}
/**
 * 1.有權限將資料庫修改schedule進行回到前一步且當時部門服務人員調成0
 * 2.此$schedule為回調到哪個步驟
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 * 
 * @param integer $schedules 步驟的編碼
 * 
 * @return boolean 
 */
function getBookingOrderUpdateSqlReplySchedule($id,$schedule){
    if($schedule==2){
        return sqlUpdateBookingOrderDocReplyCsSchedule($id,$schedule);
    }elseif($schedule==3){
        return sqlUpdateBookingOrderFinancialReplyDocSchedule($id,$schedule);
    }elseif($schedule==4){
        return sqlUpdateBookingOrderCasedCloseReplyFinancialSchedule($id);
    }
}
/**
 * 1.若只在客服部及文件部修改開航或結關日做判斷
 * 2.客服部修改的時候只修改開航或結關日
 * 3.文件部修改開航日時會將提單及帳單和上傳日期清空
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 *
 * @param integer $staff_id 員工編號id
 *
 * @param string $date 為開航日或結關日的日期
 * 
 * @param string $state 訂艙單接收資訊的狀態
 * 
 * @param integer $schedules 步驟的編碼
 * 
 * @return boolean 
 */
function getBookingOrderUpdateSqlStaffDateCutOffDateOnboardDate($id,$staff_id,$date,$state,$schedule){
    if($state=="cut_off_date"){
        $sql_name="cut_off_date";
    }elseif($state=="onboard_date"){
        $sql_name="onboard_date";
    }
    if($schedule==2){
        return sqlUpdateBookingOrderCsStaffDateCutOffDateOnBoardDate($id,$staff_id,$date,$sql_name);
    }elseif($schedule==3){
        return sqlUpdateBookingOrderDocStaffDateCutOffDateOnBoardDate($id,$staff_id,$date,$sql_name);
    }
    return false;
}
/**
 * 1.訂艙單判斷員工上傳日期及開航日或結關日的時間判斷
 * 2.開航日必為結關日之前
 * 3.日期順序財務>=文件>=客服
 * 4.客服<結關日,文件>=開航日
 *
 * @author Peter Chang
 *
 * @param array $data_array 此為資料庫BookingOrder的資料
 *
 * @param string|boolean $cut_off_date 為結關日
 * 
 * @param string|boolean $onboard_date 為開航日
 *
 * @param string $cs_staff_date 為客服上傳檔案日期 
 * 
 * @param string|boolean $doc_staff_date 為文件上傳檔案日期
 * 
 * @param string|boolean $financial_staff_date 為財務收到款項日期
 * 
 * @param string|boolean $case_closed_date 為結案日期
 *  
 * @return array(boolean,string)
 */
function getBookingOrderStaffDateCutOffDateOnboardDateDecide($data_array,$cut_off_date,$onboard_date,$cs_staff_date,$doc_staff_date,$financial_staff_date,$case_closed_date){
    $message="此訂艙單無誤";
    $result=true;
    $serial_number=getSerialCombinationStr($data_array);
    if($cut_off_date!="0000-00-00" && $cut_off_date && 
        $onboard_date!="0000-00-00" && $onboard_date){
        if(strtotime($cut_off_date)>strtotime($onboard_date)){
            $message="訂艙編號:".$serial_number."開航日期不可早於結關日期";
            $result=false;
        }elseif(strtotime($doc_staff_date)<strtotime($onboard_date) && $doc_staff_date){
            $message="訂艙編號:".$serial_number."開航日期不可早於文件核對日期";
            $result=false;
        }elseif(strtotime($cs_staff_date)>strtotime($cut_off_date) && $cs_staff_date){
            $message="訂艙編號:".$serial_number."結關日期不可早於S/O日期";
            $result=false;
        }elseif(strtotime($financial_staff_date)<strtotime($onboard_date) && $financial_staff_date){
            $message="訂艙編號:".$serial_number."開航日期不可早於收款日期";
            $result=false;
        }
    }
    if(strtotime($cs_staff_date)>strtotime($doc_staff_date) && $doc_staff_date && $cs_staff_date){
        $message="提單核對日期不可早於或等於提供S/O日期";
        $result=false;
    }elseif(strtotime($doc_staff_date)>strtotime($financial_staff_date) && $doc_staff_date && $financial_staff_date){
        $message="收款日期不可小於提供提單核對日期";
        $result=false;
    }elseif(strtotime($financial_staff_date)>strtotime($case_closed_date)  && $case_closed_date){
        $message="結案日期不可小於收款日期";
        $result=false;
    }
    return array($result,$message);
}
/**
 * 1.資料庫會員訂艙單表格顯示的資料
 *
 * @author Peter Chang
 *
 * @param integer $id 資料庫BookingOrder的id資料
 *
 * @param array $search_fields 使用者搜尋的資料
 * 
 * @param integer $start 開始的頁數
 *
 * @param integer $per 每頁幾筆
 * 
 * @param string $state 訂艙單接收資訊的狀態
 * 
 * @return boolean 
 */
function getBookingOrderMemberIdSearchTable($id,$search_fields,$start,$per,$state){
	$items=array("dangerous_goods","cabinet_volume","terms_of_trade","cut_off_place_id","goods_date","destination_country_english","schedule","create_time");
	$th="";
	$table="";
	$buf=sqlSelectBookingOrderMemberIdList($id,$search_fields,$start,$per,$state);
	foreach ($buf as $key=>$row){
        $row=getDestinationIdCountryIdArray($row);
  	    $table.="<tr>";
  	    $table.="<td>".($start+$key+1)."</td>";
        $table.="<td>".$row["serial_head"].$row["serial_number"]."</td>";
  		foreach ($items as $item){
    		if($item=="cabinet_volume"){
                if($row['shipment_type']=="CY"){
                    $table.="<td>".getCabinetVolumeText($row[$item])."</td>";
                }elseif($row['shipment_type']=="CFS"){
                    $table.="<td>".$row[$item]." ".$row['unit']."</td>";
                }
    		}elseif($item=="cut_off_place_id"){
      			$table.="<td>".CutOffPlaceIdFormat($row[$item])."</td>";
    		}elseif($item=="schedule"){
      			$table.="<td>".getBookingOrderScheduleShowName($row[$item])."</td>";
    		}elseif($item=="dangerous_goods"){
      			$table.="<td>".getDangerousGoodsText($row)."</td>";
    		}elseif($item=="create_time"){
    			$table.="<td>".date_format(date_create($row[$item]),'Y-m-d')."</td>";
    		}elseif($item=="destination_country_english"){
                $table.="<td colspan='2'>".$row["destination_country_english"]."/".$row["destination_english"]."</td>";
            }else{
      			$table.="<td>".$row[$item]."</td>";
    		}
  		}
  	$table.="<td>".getHtmlAHrefInformationIcon("./BookingOrderInformation.php?state=information&id=".$row['booking_order_id']);
        if(($row['schedule']==1 || $row['schedule']==2) && $_SESSION['pass']==1){
            $table.=getHtmlAHrefUpdateIcon("./Booking.php?state=update&id=".$row['booking_order_id']."&trading=export").getHtmlAHrefCancelIcon("#","PopupCloseWidowClick(1,\"./BookingOrderInformation.php?state=cancel&id=".$row['booking_order_id']."\")");
        }
  	$table.="</td></tr>";
	}
	return $table;
}
/**
 * 1.員工訂艙單表格顯示的ICON資訊及點選後的彈跳視窗
 * 2.$array的key=schedule步驟
 * 3.data_icon代表該步驟該上傳日期icon
 * 4.reply_icon代表回復上個步驟icon
 * 5.cut_off_date_icon結關日icon
 * 6.onboard_date_icon開航日icon
 * 7.confirm_href確認上傳的icon連結
 * 8.icon為該步驟接收成為服務人員icon
 * 9.若為false代表在該步驟不需要此功能
 * 10.各icon底下都會傳送state 
 *
 * @author Peter Chang
 *
 * @param integer $row 此為資料庫BookingOrder的資料
 * 
 * @return array
 */
function getBookingOrderTableIconArray($row){
    $array=array(
        1=>array("date_icon"=>false,
            "reply_icon"=>false,
            "cut_off_date_icon"=>false,
            "onboard_date_icon"=>false,
            "confirm_href"=>false,
           "icon"=> getHtmlAHrefRecieveBookingOrderIcon("#","PopupCloseWidowClick(1,\"./StaffBookingOrderInformation.php?state=recieve&id=".$row['booking_order_id']."\")")
        ),
        2=>array("date_icon"=>getHtmlAHrefBookingOrderDateIcon("#","PopupCloseWidowClick(11,\"./StaffBookingOrderInformation.php?state=provide_so_date&id=".$row['booking_order_id']."\")","provide_so_date"),
            "reply_icon"=>false,
            "cut_off_date_icon"=>getHtmlAHrefBookingOrderCutOffDateIcon("#","PopupCloseWidowClick(\"cut_off_date\",\"./StaffBookingOrderInformation.php?state=cut_off_date&id=".$row['booking_order_id']."\")"),
            "onboard_date_icon"=>getHtmlAHrefBookingOrderOnBoardDateIcon("#","PopupCloseWidowClick(\"onboard_date\",\"./StaffBookingOrderInformation.php?state=onboard_date&id=".$row['booking_order_id']."\")"),
            "confirm_href"=>getHtmlAHrefBookingOrderNextScheduleIcon("#","PopupCloseWidowClick(\"provide_so_pending\",\"./StaffBookingOrderInformation.php?state=provide_so_pending&id=".$row['booking_order_id']."\")","provide_so_pending"),
            "icon"=>false
        ),
        3=>array("date_icon"=>getHtmlAHrefBookingOrderDateIcon("#","PopupCloseWidowClick(12,\"./StaffBookingOrderInformation.php?state=document_check_date&id=".$row['booking_order_id']."\")","document_check_date"),
            "reply_icon"=>getHtmlAHrefBookingOrderScheduleReplyIcon("#","PopupCloseWidowClick(21,\"./StaffBookingOrderInformation.php?state=reply&id=".$row['booking_order_id']."\")","provide_so_reply"),
            "cut_off_date_icon"=>getHtmlAHrefBookingOrderCutOffDateIcon("#","PopupCloseWidowClick(\"cut_off_date\",\"./StaffBookingOrderInformation.php?state=cut_off_date&id=".$row['booking_order_id']."\")"),
            "onboard_date_icon"=>getHtmlAHrefBookingOrderOnBoardDateIcon("#","PopupCloseWidowClick(\"onboard_date\",\"./StaffBookingOrderInformation.php?state=onboard_date&id=".$row['booking_order_id']."\")"),
            "confirm_href"=>getHtmlAHrefBookingOrderNextScheduleIcon("#","PopupCloseWidowClick(\"document_check_pending\",\"./StaffBookingOrderInformation.php?state=document_check_pending&id=".$row['booking_order_id']."\")","document_check_pending"),
            "icon"=>getHtmlAHrefDocumentCheckBookingOrderIcon("#","PopupCloseWidowClick(2,\"./StaffBookingOrderInformation.php?state=document_check&id=".$row['booking_order_id']."\")")
        ),
        4=>array("date_icon"=>getHtmlAHrefBookingOrderDateIcon("#","PopupCloseWidowClick(13,\"./StaffBookingOrderInformation.php?state=collection_date&id=".$row['booking_order_id']."\")","collection_date"),
            "reply_icon"=>getHtmlAHrefBookingOrderScheduleReplyIcon("#","PopupCloseWidowClick(22,\"./StaffBookingOrderInformation.php?state=reply&id=".$row['booking_order_id']."\")","document_check_reply"),
            "cut_off_date_icon"=>false,
            "onboard_date_icon"=>false,
            "confirm_href"=>false,
            "icon"=>getHtmlAHrefCollectionBookingOrderIcon("#","PopupCloseWidowClick(3,\"./StaffBookingOrderInformation.php?state=collection&id=".$row['booking_order_id']."\")")
        ),
        5=>array("date_icon"=>getHtmlAHrefCaseClosedBookingOrderIcon("#","PopupCloseWidowClick(14,\"./StaffBookingOrderInformation.php?state=case_closed_date&id=".$row['booking_order_id']."\")"),
        "reply_icon"=>getHtmlAHrefBookingOrderScheduleReplyIcon("#","PopupCloseWidowClick(23,\"./StaffBookingOrderInformation.php?state=reply&id=".$row['booking_order_id']."\")","collection_reply"),
        "cut_off_date_icon"=>false,
        "onboard_date_icon"=>false,
        "confirm_href"=>false,
        "icon"=>false
        )
    );
    return $array;
}
/**
 * 1.資料庫員工訂艙單表格顯示的資料
 * 2.getBookingOrderDepartmentPositionSchedulePriorityReturn為判斷icon權限顯示步驟
 * 
 * @author Peter Chang
 *
 * @param string $list_state single為單個schedule,all為全部schedule資料
 * 
 * @param integer $staff_id 員工編號id
 *
 * @param array $search_fields 使用者搜尋的資料
 * 
 * @param integer $start 開始的頁數
 *
 * @param integer $per 每頁幾筆
 * 
 * @return string
 */
function getStaffBookingOrderScheduleSearchTable($list_state,$staff_id,$search_fields,$start,$per){
    $staff_array=getStaffListStaffId($staff_id);
    if($list_state=="single"){
	   $items=array("company_chinese","purchase_order_no","dangerous_goods","cabinet_volume","cut_off_place_id","destination_country_english","create_time");
    }elseif($list_state=="all"){
       $items=array("company_chinese","purchase_order_no","dangerous_goods","cabinet_volume","cut_off_place_id","destination_country_english","create_time","schedule");
    }
	$th="";
	$table="";
	$buf=sqlSelectStaffBookingOrderSchedule($search_fields,$start,$per);
	foreach ($buf as $key=>$row){
        $row=getDestinationIdCountryIdArray($row);
        $table.="<tr>";
  	    $table.="<td>".($start+$key+1)."</td>";
        $table.="<td>".$row["serial_head"].$row["serial_number"]."</td>";
  		foreach ($items as $item){
    		if($item=="cabinet_volume"){
                if($row['shipment_type']=="CY"){
                    $table.="<td>".getCabinetVolumeText($row[$item])."</td>";
                }elseif($row['shipment_type']=="CFS"){
                    $table.="<td>".$row[$item]." ".$row['unit']."</td>";
                }
    		}elseif($item=="cut_off_place_id"){
      			$table.="<td>".CutOffPlaceIdFormat($row[$item])."</td>";
    		}elseif($item=="schedule"){
      			$table.="<td>".getBookingOrderScheduleShowName($row[$item])."</td>";
    		}elseif($item=="dangerous_goods"){
      			$table.="<td>".getDangerousGoodsText($row)."</td>";
    		}elseif($item=="create_time"){
    			$table.="<td>".date_format(date_create($row[$item]),'Y-m-d')."</td>";
    		}elseif($item=="destination_country_english"){

                $table.="<td colspan='2'>".$row["destination_country_english"]."/".$row["destination_english"]."</td>";
            }else{
      			$table.="<td>".$row[$item]."</td>";
    		}
  		}
        $table.="<td>";
        $table.=getHtmlAHrefInformationIcon("./StaffBookingOrderInformation.php?state=information&id=".$row['booking_order_id']);
        $booking_order_shcedule_array=getBookingOrderSchedulePriorityShowArray($row);
        $table_icon_arrays=getBookingOrderTableIconArray($row);
        $schedule=$row['schedule'];
        if(isset($table_icon_arrays[$schedule])){
            $table_icon_array=$table_icon_arrays[$schedule];
            $booking_order_array=$booking_order_shcedule_array[$schedule];
            if(getBookingOrderDepartmentPositionSchedulePriorityReturn($schedule,$staff_array)){
                if($booking_order_array["staff_id"]==$staff_id &&
                (!$booking_order_array["staff_date"] || $table_icon_array["confirm_href"]!==true)){
                    if($table_icon_array["date_icon"]!==false){
                        $table.="  ".$table_icon_array["date_icon"];
                    }
                }elseif($table_icon_array["icon"]!==false &&
                    ($booking_order_array["staff_id"]===false || 
                    !$booking_order_array["staff_id"])){
                    $table.="  ".$table_icon_array["icon"];
                }elseif($table_icon_array["date_icon"]!==false &&
                strpos($booking_order_array["show_text"],"結案")!==false){
                    $table.="  ".$table_icon_array["date_icon"];
                }
                
                if($booking_order_array["staff_id"]==$staff_id && 
                    $table_icon_array["cut_off_date_icon"]!==false &&
                    strpos($booking_order_array["handling_department"],"文件")!==false){
                    $table.="  ".$table_icon_array["onboard_date_icon"];
                }elseif($booking_order_array["staff_id"]==$staff_id && 
                    $table_icon_array["cut_off_date_icon"]!==false &&
                   $booking_order_array["staff_attachment"] && $booking_order_array["staff_date"]){
                    $table.="  ".$table_icon_array["cut_off_date_icon"];
                    $table.="  ".$table_icon_array["onboard_date_icon"];
                }
                if($booking_order_array["staff_id"]==$staff_id &&
                    $booking_order_array["staff_date"] &&
                    $table_icon_array["confirm_href"]!==true ){
                    $table.="  ".$table_icon_array["confirm_href"];
                }
            }

            if(getBookingOrderDepartmentPositionSchedulePriorityReturn($schedule,$staff_array,true)){
                list($result,$message)=getBookingOrderStaffIdStaffDateStaffAchmentPriorityMessage($row);
                if($result){
                    $table.="  ".$table_icon_arrays[$schedule]["reply_icon"];
                }
            }
        }
        $table.="</td></tr>";
    }
    return $table;
}
/**
 * 1.資料庫會員搜尋訂艙單的where條件
 * 
 * @author Peter Chang
 *
 * @param string $sql 為先前sql語法的資料
 * 
 * @param array $search_fields 使用者搜尋的資料
 *
 * @param string $state 訂艙單接收資訊的狀態
 * 
 * @return string
 */
function getBookingOrderSqlSearchWhere($sql,$search_fields,$state){
	if ($search_fields!==false){
        if (strtolower($search_fields['serial_head'])!="all" AND $search_fields['serial_head']){
            $sql.=" and `booking_order`.`serial_head` like '".$search_fields['serial_head']."' ";
        }

        if ($search_fields['serial_number']){
            $sql.=" and `booking_order`.`serial_number` like '%".$search_fields['serial_number']."%' ";
        }
        if ($search_fields['dangerous_goods']!="all" AND $search_fields['dangerous_goods']){
            $sql.=" AND `booking_order`.`dangerous_goods` LIKE '".$search_fields['dangerous_goods']."' ";
        }
        if($search_fields['cut_off_place_id']!="all" AND $search_fields['cut_off_place_id']){
            $sql.=" AND `booking_order`.`cut_off_place_id` = ".$search_fields['cut_off_place_id'];
        }
        if ($search_fields['country_id']!="all" AND $search_fields['country_id']){
            $sql.=" and (`destination_port`.`country_id` = ".$search_fields['country_id']." OR `country`.`country_id`=".$search_fields['country_id'].") ";
        }
        if ($search_fields['destination_id']!="all" AND $search_fields['destination_id']){
        	$sql.=" AND `booking_order`.`destination_id` = ".$search_fields['destination_id'];
        }
        if ($search_fields['order_statue']!="all" AND ($state=="update" OR $state=="cancel")){
        	$sql.=" AND (`booking_order`.`schedule` = 1 OR `booking_order`.`schedule` = 2)";
        }elseif($search_fields['order_statue']!="all" AND $search_fields['order_statue']){
            $sql.=" AND `booking_order`.`schedule` = ".$search_fields['order_statue'];
        }else{
            $sql.=" AND `booking_order`.`schedule` >= 1 AND `booking_order`.`schedule` <= 7";
        }
        if ($search_fields['create_time']){
        	$sql.=" AND `booking_order`.`create_time` LIKE '".$search_fields['create_time']."%'";
        }
    }
    return $sql;
}
/**
 * 1.資料庫員工搜尋訂艙單的where條件
 * 
 * @author Peter Chang
 *
 * @param string $sql 為先前sql語法的資料
 * 
 * @param array $search_fields 使用者搜尋的資料
 *
 * @return string
 */
function getStaffBookingOrderSqlSearchWhere($sql,$search_fields){
	if ($search_fields!==false){
        if ($search_fields['serial_head'] && strtolower($search_fields['serial_head'])!="all"){
            $sql.=" and `booking_order`.`serial_head` like '".$search_fields['serial_head']."' ";
        }
        if ($search_fields['serial_number']){
            $sql.=" and `booking_order`.`serial_number` like '%".$search_fields['serial_number']."%' ";
        }
        if ($search_fields['company_chinese']){
            $sql.=" and `booking_order`.`company_chinese` like '%".$search_fields['company_chinese']."%' ";
        }
        if ($search_fields['purchase_order_no']){
            $sql.=" and `booking_order`.`purchase_order_no` like '%".$search_fields['purchase_order_no']."%' ";
        }
        if ($search_fields['destination_country_id']!="all" AND $search_fields['destination_country_id']){
            $sql.=" and (`destination_port`.`country_id` = ".$search_fields['destination_country_id']." OR `country`.`country_id`=".$search_fields['destination_country_id'].") ";
        }
        if ($search_fields['destination_id']!="all" AND $search_fields['destination_id']){
        	$sql.=" and `booking_order`.`destination_id` = ".$search_fields['destination_id'];
        }
        if ($search_fields['create_time']){
            $sql.=" AND `booking_order`.`create_time` LIKE '".$search_fields['create_time']."%'";
        }
        if($search_fields['schedule']!="all" AND $search_fields['schedule']){
            $sql.=" AND `booking_order`.`schedule` = ".$search_fields['schedule'];
        }else{
            $sql.=" AND `booking_order`.`schedule` >= 1 AND `booking_order`.`schedule` <= 7";
        }
    }
    return $sql;
}
/**
 * 1.為員工查看會員以月來算下過幾筆訂單，因先上線故未完成
 * 
 * @author Peter Chang
 *
 * @param integer $member_id 會員編號id
 * 
 * @return array
 */
function getStaffMemberBookingOrderMonthNum($member_id){
  $buf=sqlSelectBookingOrderMemberId($member_id,false,false,false);
  $data_array=array();
  foreach ($buf as $row){
  	$volumes=getBookingOrderCabinetVolumeStrToArray($row["cabinet_volume"]);
  	$array=explode("-",$row['create_time']);
  	foreach($volumes as $volume_key => $volumes){
  		if (!isset($data_array[$array[0].$array[1]][$volume_key])){$data_array[$array[0].$array[1]][$volume_key]=0;}
  		$data_array[$array[0].$array[1]][$volume_key]+=$volumes;
  	}
  }
  return $data_array;
}
/**
 * 1.為員工會員共用Post回傳Form的$data_array及$error為被post接收過資料和$sum為櫃量總和
 * 
 * @author Peter Chang
 *
 * @param string $state 訂艙單接收資訊的狀態
 * 
 * @param integer|boolean 為訂艙單的id或若是新增就為false
 * 
 * @param array|boolean 此為會員資訊的陣列
 * 
 * @param array|boolean 此為Form表單的Post接收資料，若為員工修改的時候則只是需要表單資訊不用接收
 * 
 * @return array(boolean,array,integer,string)
 */
function getStaffMemberCommonBookingOrderDataArray($state,$id=false,$member_array=false,$post_array=false){
    $sum=false;
    $items=getBookingOrderFormBookingOrderArray();
    $members=getBookingOrderFormMemberArray();
    if($state=="add"){
        $submit="送出訂艙";
    }elseif($state=="update"){
        $submit="確認修改";
    }
    if($post_array===true){
        $error=1;
        if($state=="update"){
            $booking_order_array=getBookingOrderId($id);
            $data_array['member_id']=$booking_order_array['member_id'];
            $shipment_type=$booking_order_array['shipment_type'];
        }elseif($state=="add"){
            $shipment_type=$_POST['shipment_type'];
        }
        foreach ($items as $item){
            if ($item=="cabinet_volume"){
                if ($shipment_type=="CY"){
                    list($data_array[$item],$sum)=getBookingOrderCabinetVolumeArrayToStr($_POST[$item]);
                }elseif($shipment_type=="CFS"){
                    $sum=$_POST[$item];
                    $data_array[$item]=$sum;
                }
            }elseif(isset($_POST[$item])){
                $data_array[$item]=trim($_POST[$item]);
            }else{
                $data_array[$item]="";
            }
        }
        foreach ($members as $member){
            $data_array[$member]=$_POST[$member];
        }
        
    }elseif($state=="add" && $post_array===false){
        $error=0;

        foreach ($members as $member){
            $data_array[$member]=$member_array[$member];
        }
        foreach ($items as $item){
            if ($item=="booking_order_id"){
                $data_array[$item]=0;
            }else{
                $data_array[$item]="";
            }
        }
        $data_array["terms_of_trade"]="C&F";
    }elseif($state=="update" && $post_array===false){
        $error=0;
        $data_array=getBookingOrderId($id);
    }
    return array($error,$data_array,$sum,$submit);
}
/**
 * 1.為會員訂艙單接收上傳附檔使用
 * 2.若是新增$attachments為空陣列，修改會將舊資料存入$attachments
 * 
 * @author Peter Chang
 *
 * @param string $state 訂艙單接收資訊的狀態
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return array(boolean,string,array)
 */
function getStaffMemberCommonBookingOrderAttachments($state,$data_array){
    $attachment=false;
    if($state=="add"){
        $attachments=array();
    }elseif($state=="update"){
        if($data_array['attachments']){$attachments=explode(";",$data_array['attachments']);}else{$attachments=array();}
    }
    $postname="attachments";
    $path=getBookingOrderAttachPath($data_array);
    list($result,$message,$attachments)=getMultipleUploadFileAttachmentsNumLimitArray($postname,$path,$attachments);
    if($result){
        $attachment=implode(";",$attachments);
    }
    return array($result,$message,$attachment);
}
/**
 * 1.為會員訂艙單資料格式是否正確，錯誤為fasle正確為true
 * 
 * @author Peter Chang
 *
 * @param integer $sum 訂艙單櫃量總和
 * 
 * @param array $data_array 此為客人下BookingOrder的資料
 * 
 * @return array(boolean,string)
 */
function getBookingOrderDecide($sum,$data_array){
    if (!AllNumberFormat($data_array['hs_code'])){
        return array(false,"產品HS CODE格式錯誤，應為數字");
    }
    if (!AllNumberFormat($data_array['cargo_weight'])){
        return array(false,"每一個貨櫃的貨重格式錯誤，應為數字");
    }
    $array=getDangerousDoodsArray();
    if (!in_array($data_array['dangerous_goods'], $array)) {
        return array(false,"產品性質資料有誤");
    }

    if ($data_array['dangerous_goods']=="危險品"){
        if (!NumberFormat(4,$data_array['un_no'])){
            return array(false,"UN.NO.格式錯誤，應為數字4碼");
        }
    }

    if ($data_array['shipment_type']=="CY"){
        if (!$sum>0){
            return array(false,"訂艙櫃量，總櫃量需大於1");
        }  

        $array=getTermsOfTradeArray();
        if (!in_array($data_array['terms_of_trade'], $array)) {
            return array(false,"貿易條件資料有誤");
        }
    }elseif($data_array['shipment_type']=="CFS"){
        if (!$sum>0){
            return array(false,"總件數需大於0");
        } 

        if (!AllNumberFormat($data_array['volume']) && !$volume>0){
            return array(false,"預估總貨量需大於0");
        } 
    }
    
  
    if (!CutOffPlaceIdFormat($data_array['cut_off_place_id'])) {
        return array(false,"交櫃地點資料有誤");
    }

    if (!$data_array['goods_date']){
        return array(false,"預計貨好日期不得為空");
    }
    
    if($data_array['cut_off_date'] && strtotime($data_array['cut_off_date'])<strtotime($data_array['goods_date'])){
        return array(false,"結關日期不可早於貨好日期");
    }

    if($data_array['onboard_date'] && strtotime($data_array['onboard_date'])<strtotime($data_array['goods_date'])){
        return array(false,"開航日期不可早於貨好日期");
    }

    if($data_array['cut_off_date'] && $data_array['onboard_date'] && strtotime($data_array['cut_off_date'])>strtotime($data_array['onboard_date'])){
        return array(false,"開航日期不可早於結關日期");
    }

    if (!getDestinationId($data_array['destination_id'])){
        return array(false,"目的港的資料，不是資料庫中資料");
    }
    return array(true,"訂艙資料格式正確");
}
/**
 * 1.為方便Html Div員工上傳檔案的日期及開航或結關日重覆資料顯示
 * 
 * @author Peter Chang
 *
 * @param string $show_text 顯示的文字
 * 
 * @param string $show_form 顯示的input之類
 * 
 * @return string
 */
function getStaffBookingOrderFieldShow($show_text,$show_form){
    $result="
    <div class='row'>
        <div class='col col-lg-3'>
        </div>
        <div class='col col-lg-2'>
            ".$show_text."
        </div>
        <div class='col col-auto text-start'>
            ".$show_form."
        </div>
    </div>";
    return $result;
}
/**
 * 1.為方便Html Div員工上傳檔案清單資料顯示
 * 
 * @author Peter Chang
 * 
 * @return string
 */
function getStaffBookingOrderUploadFileListShow(){
    $result="
    <div class='row'>
        <div class='col col-lg-4'>
        </div>
        <div class='col col-lg-2' id='FileText'>
            
        </div>
        <div class='col' id='FileList'>
            
        </div>
    </div>";
    return $result;
}
?>
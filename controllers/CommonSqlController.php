<?php 
set_time_limit(0);
date_default_timezone_set('Asia/Taipei');
/**
 * 1.將資料0存入資料庫的NULL轉成字串存入
 *
 * @author Peter Chang
 * 
 * @param integer $data 資料
 * 
 * @return integer
 */
function getDataZeroTransferNullSaveSql($data){
    if($data==0 || $data==null){$data="NULL";}
    return $data;
}
/**
 * 1.抓資料庫IpLog搜尋條件為Ip
 *
 * @author Peter Chang
 * 
 * @param string $ip 電腦ip
 * 
 * @return array
 */
function getIpLogIp($ip){
    $buf = sqlSelectIpLogIp($ip);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫IpBlackList搜尋條件為黑名單Ip
 *
 * @author Peter Chang
 * 
 * @param string $ip 電腦ip
 * 
 * @return array
 */
function getIpBlackListIp($ip){
    $buf = sqlSelectIpBlackListIp($ip);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫Member尋條件為會員Username資訊
 *
 * @author Peter Chang
 * 
 * @param string $username 會員的username
 * 
 * @return array
 */
function getMemberUsername($username) {
  $buf=sqlSelectMemberUsername($username);
  foreach($buf as $row){
    return $row;
  }
}
/**
 * 1.抓資料庫Member搜尋條件為會員Pass的數量
 *
 * @author Peter Chang
 * 
 * @param integer $pass 會員審核狀態
 * 
 * @return integer
 */
function getMemberPassCount($pass){
    $buf=sqlSelectMemberPass($pass);
    return count($buf);
}
/**
 * 1.抓資料庫Member搜尋條件為會員Id資訊
 *
 * @author Peter Chang
 * 
 * @param integer $id 惠瑜的id
 * 
 * @return array
 */
function getMemberId($id){
  $buf=sqlSelectMemberId($id);
  foreach($buf as $row){
    return $row;
  }
}
/**
 * 1.抓資料庫StaffList搜尋條件為員工清單的Id資訊
 *
 * @author Peter Chang
 * 
 * @param integer $id 員工的id
 * 
 * @return array
 */
function getStaffListId($id){
    $buf = sqlSelectStaffListId($id);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫StaffAccountList搜尋條件為員工帳戶清單的Username
 *
 * @author Peter Chang
 * 
 * @param string $username 會員的username
 * 
 * @return array
 */
function getStaffAccountListUsername($username) {
  $buf=sqlSelectStaffAccountListUsername($username);
  foreach($buf as $row){
    return $row;
  }
}
/**
 * 1.抓資料庫CFSQuantityUnit搜尋條件為id回傳件數單位
 *
 * @author Peter Chang
 * 
 * @param integer $id 為件數單位id
 * 
 * @return string
 */
function getCFSQuantityUnitUnit($id) {
  $buf=sqlSelectCFSQuantityUnitId($id);
  foreach($buf as $row){
    return $row['unit'];
  }
}

/**
 * 1.抓資料庫Company搜尋條件為shipper
 *
 * @author Peter Chang
 * 
 * @param string $shipper 為船公司
 * 
 * @return array
 */
function getCompanyCompanyAbbreviation($shipper) {
  $buf=sqlSelectCompanyCompanyAbbreviation($shipper);
  foreach($buf as $row){
    return $row;
  }
}

/**
 * 1.抓資料庫StaffAccountList搜尋條件為員工帳戶清單的staff_id
 *
 * @author Peter Chang
 * 
 * @param integer $staff_id 員工的id
 * 
 * @return array
 */
function getStaffAccountListStaffId($staff_id) {
  $buf=sqlSelectStaffAccountListStaffId($staff_id);
  foreach($buf as $row){
    return $row;
  }
}
/**
 * 1.抓資料庫Area搜尋條件為台灣地區的id資訊
 *
 * @author Peter Chang
 * 
 * @param integer $id 地區的id
 * 
 * @return array
 */
function getAreaId($id){
    $buf = sqlSelectAreaId($id);
    foreach ($buf as $row) {
        return $row;
    }
}
/**
 * 1.抓資料庫DestinationCity搜尋條件為城市id
 *
 * @author Peter Chang
 * 
 * @param integer $id 城市id
 * 
 * @return array
 */
function getDestinationCityCityId($city_id){
    $buf = sqlSelectDestinationCityCityId($city_id);
    if($buf){
        foreach($buf as $row){
            return $row;
        }
    }
    return false;
}
/**
 * 1.抓資料庫CompanyFeeBasisArray基本費用轉成陣列
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getCompanyFeeBasisArray(){
    $ocean_export_id=false;
    $buf = sqlSelectCompanyFeeBasis();
    foreach ($buf AS $row){
        if($ocean_export_id!=$row["ocean_export_id"]){
        $ocean_export_id=$row["ocean_export_id"];
        $company_basis[$row["ocean_export_id"]] = array(
            "b_l"=>$row["b_l"],
            "seal"=>$row["seal"],
            "telex_release"=>$row["telex_release"],
            "cabinet_volume_id"=>array(
            $row["cabinet_volume_id"]=>$row["thc"]
            )
        );
        }else{
        $company_basis[$row["ocean_export_id"]]["cabinet_volume_id"][$row["cabinet_volume_id"]]=$row["thc"];
        }    
    }
    return $company_basis;
}
/**
 * 1.抓資料庫CFSQuantityUnit搜尋條件為未刪除的數量單位
 *
 * @author Peter Chang
 * 
 * @param integer $id 數量單位id
 * 
 * @return array
 */
function getCFSQuantityUnitNotDelOptionUnitValueCFSQuantityUnitId($id){
    $result="";
    $buf = sqlSelectCFSQuantityUnitUnit();
    foreach ($buf as $row){
        if($row['cfs_quantity_unit_id']==$id){
            $result.="<option value='".$row['cfs_quantity_unit_id']."' selected>".$row['unit']."</option>";
        }else{
            $result.="<option value='".$row['cfs_quantity_unit_id']."'>".$row['unit']."</option>";
        }
    }
    return $result;
}

/**
 * 1.抓資料庫Country搜尋條件為未刪除的國家
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function getCountryNotDelOptionCountryEnglishValueCountryId($country_id){
    $result="";
    $buf = sqlSelectCountryCountryNotDel();
    foreach ($buf as $row){
        if($row['country_id']==$country_id){
            $result.="<option value='".$row['country_id']."' selected>".$row['country_english']."</option>";
        }else{
            $result.="<option value='".$row['country_id']."'>".$row['country_english']."</option>";
        }
    }
    return $result;
}
/**
 * 1.抓資料庫Country搜尋條件為國家的英文
 *
 * @author Peter Chang
 * 
 * @param string $value 國家的英文
 * 
 * @return array
 */
function getCountryCountryEnglish($value){
    $buf = sqlSelectCountryCountryEnglish($value);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫Country搜尋條件為國家的id
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function getCountryCountryId($country_id){
    $buf = sqlSelectCountryCountryId($country_id);
    foreach ($buf as $row){
        return $row;
    }
}

/**
 * 1.抓資料庫City搜尋條件為城市的中文
 *
 * @author Peter Chang
 * 
 * @param string $value 城市的中文
 * 
 * @return array
 */
function getCityCityChinese($value){
    $buf = sqlSelectCityCityChineseOrderById($value);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫MemberLog搜尋條件為會員id
 *
 * @author Peter Chang
 * 
 * @param integer $member_id 會員的id
 * 
 * @return array|boolean
 */
function getMemberLogMemberId($member_id){
    $buf = sqlSelectMemberLogMemberId($member_id);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.抓資料庫MemberLog搜尋條件為註冊帳號username，且回傳最新一筆
 *
 * @author Peter Chang
 * 
 * @param string $username 註冊username
 * 
 * @return array|boolean
 */
function getMemberLogRegisterUsername($username){
    $buf = sqlSelectMemberLogRegisterUsername($username);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.抓資料庫Destination將目的港及貨櫃整理成陣列
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @param string $destination_port_english 目的港英文
 * 
 * @return array|boolean
 */
function getDestinationIdEnglish($country_id){
    $content_array=array();
    $buf=sqlSelectDestinationCountryId($country_id);
    if($buf){
        foreach ($buf as $row){
            $value="";
            if($row['destination_port_english']){
                $value=strtoupper($row['destination_port_english']);
            }elseif($row['container_depot_english']){
                $value=strtoupper($row['container_depot_english']);
            }
            array_push($content_array,array($row['destination_id']=>$value));
        }
    }
    return $content_array;
}
/**
 * 1.抓資料庫Destination將目的港及貨櫃存入陣列
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @param string $destination_port_english 目的港英文
 * 
 * @return array|boolean
 */
function getDestinationIdEnglishReturn(){
    $content_array=array();
    $buf=sqlSelectDestinationCountryId($country_id);
    foreach ($buf as $row){
            $value="";
        if($row['destination_port_english']){
            $value=strtoupper($row['destination_port_english']);
        }elseif($row['container_depot_english']){
            $value=strtoupper($row['container_depot_english']);
        }
        array_push($content_array,array($row['destination_id']=>$value));
    }
    return $content_array;
}
/**
 * 1.抓資料庫DestinationPort搜尋條件為國家英文及目的港
 *
 * @author Peter Chang
 * 
 * @param string $country 國家英文
 * 
 * @param string $destination_port_english 目的港英文
 * 
 * @return array|boolean
 */
function getDestinationPortCountryEnglishDestinationPortEnglish($country,$destination_port_english){
    $buf = sqlSelectDestinationPortCountryEnglishDestinationPortEnglish($country,$destination_port_english);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.抓資料庫OceanExport搜尋條件為報價id
 *
 * @author Peter Chang
 * 
 * @param integer $id 報價的id
 * 
 * @return array|boolean
 */
function getOceanExportId($id){
    $buf = sqlSelectOceanExportId($id);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.抓資料庫OceanExport搜尋條件為報價id及期限
 *
 * @author Peter Chang
 * 
 * @param integer $id 報價的id
 * 
 * @return array|boolean
 */
function getOceanExportDateDeadlineDestinationPortId($id,$shipment_type){
    $buf = sqlSelectOceanExportDateDeadlineDestinationPortId($id,$shipment_type);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.抓資料庫OceanExport搜尋條件為報價id及期限
 *
 * @author Peter Chang
 * 
 * @param integer $id 報價的id
 * 
 * @return array|boolean
 */
function getOceanExportInnerOceanExportDateDeadlineOceanExportId($id,$shipment_type){
    $buf = sqlSelectOceanExportInnerOceanExportDateDeadlineOceanExportId($id,$shipment_type);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.抓資料庫CutOffPlace搜尋條件為結關地點id
 *
 * @author Peter Chang
 * 
 * @param integer $id 結關地點的id
 * 
 * @return array|boolean
 */
function getCutOffPlaceId($id){
    $buf = sqlSelectCutOffPlaceId($id);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.抓資料庫OceanExportPrice搜尋條件為目的港id結關地點id櫃型種類id
 *
 * @author Peter Chang
 * 
 * @param integer $destination_port_id 目的港id
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地點的id
 * 
 * @return array|boolean
 */
function getOceanExportPriceDestinationPortIdCutOffIdCabinetVolumeId($destination_port_id,$cabinet_volume_id,$cut_off_place_id){
    $buf = sqlSelectOceanExportPriceDestinationPortIdCutOffIdCabinetVolumeId($destination_port_id,$cabinet_volume_id,$cut_off_place_id);
    foreach ($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.供用海運報價價格計價顯示方式
 *
 * @author Peter Chang
 * 
 * @param integer $price 海運價格
 * 
 * @return array|boolean
 */
function getOceanExportPriceCommonValuation($price){
    return "USD ".number_format($price);
}
/**
 * 1.陣列為公司的Email尾巴
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getEmailAddressArray(){
    return array("@test.com","@test2.com");
}
/**
 * 1.陣列為產品性質
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getDangerousDoodsArray(){
    $array=array("危險品","非危險品");
    return $array;
}
/**
 * 1.抓取櫃型種類的Table Name及未刪除的櫃型種類
 *
 * @author Peter Chang
 * 
 * @param string $cabinet_volume 櫃型種類
 * 
 * @return array
 */
function getTableNameCabinetVolumeNotDel($cabinet_volume){
    $buf=sqlSelectTableNameCabinetVolumeNotDel($cabinet_volume);
    foreach($buf as $row){
        return $row;
    }
    return false;
}
/**
 * 1.陣列為目前的櫃型種類
 * 2.show_name為顯示名稱
 * 3.sql_name為在資料庫的名稱存入
 * 4.table_name為在表格上顯示名稱
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getCabinetVolumeArray(){
    $array=sqlSelectCabinetVolumeNotDel();
    return $array;
}
/**
 * 1.目前訂艙單的編號開頭
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getBookingOrderSerialHeadArray(){
    $array=array("TEST-F","TEST-L");
    return $array;
}
/**
 * 1.將員工名稱顯示
 *
 * @author Peter Chang
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @return string
 */
function getTESTCompanySendShowName($staff_array){
    return $staff_array["extension"]." ".ucfirst(strtolower($staff_array["ename"]))." ".ucfirst(strtolower($staff_array["elastname"]))." / QA Transport";
}
/**
 * 1.Form Select海運報降航線
 *
 * @author Peter Chang
 * 
 * @param string $value 預設selected值
 * 
 * @return string
 */
function getOceanExportIdSelect($value){
    $result="";
    $buf=sqlSelectOceanExportOrderByQuoteRoute();
    foreach($buf as $row){
        if($row['ocean_export_id']==$value){
            $result.="<option value='".$row['ocean_export_id']."' selected>".$row['quote_route']."</option>";
        }else{
            $result.="<option value='".$row['ocean_export_id']."'>".$row['quote_route']."</option>";
        }
    }
    return $result;
}

/**
 * 1.Form Select訂艙編號開頭的文字
 *
 * @author Peter Chang
 * 
 * @param string $value 預設selected值
 * 
 * @return string
 */
function getBookingOrderSerialHeadSelect($value){
    $result="";
    $array=getBookingOrderSerialHeadArray();
    $result.="<option>ALL</option>";
    foreach($array as $data){
        if($data==$value && $value){
            $result.="<option selected>".$data."</option>";
        }else{
            $result.="<option>".$data."</option>";
        }
    }
    return $result;
}
/**
 * 1.訂艙編號自動計算最新號碼為多少
 *
 * @author Peter Chang
 * 
 * @param boolean|string $head 訂艙編號的開頭為何目前都只有TEST
 * 
 * @return array(string,string)
 */
function getSerialNumber($shipment_type,$head=false){
    if($shipment_type=="CY"){
        $head="TEST-F";
    }elseif($shipment_type=="CFS"){
        $head="TEST-L";
    }
    // if(!$head){
    //     $head="TEST";
    // }
    $buf=sqlSelectBookingOrderCountSerial($head,date("Ym"));
    if($buf){
        foreach($buf as $row){
            $number=intval($row['serial_number'])+1;
            return array($head,$number);
        }
    }
    return array($head,date("Ym")."01");
}
/**
 * 1.將員工顯示中英文名稱及稱謂
 *
 * @author Peter Chang
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @return string
 */
function getStaffEnglishnameChineseNameGender($staff_array){
    return $staff_array['ename']." ".$staff_array['elastname']." ".$staff_array['cname']." ".getGenderChinese($staff_array['gender']);
}
/**
 * 1.如果資料庫名稱等於$value則會回傳貨櫃種類的顯示名稱
 *
 * @author Peter Chang
 * 
 * @param string $value 為貨櫃種類的sql名稱
 * 
 * @return string|boolean
 */
function getCabinetVolumeName($value){
    $buf=getCabinetVolumeArray();
    foreach ($buf as $key=>$row){
        if ($row['sql_name']==$value){
            return $row["show_name"];
        }
    }
    return false;
}
/**
 * 1.用於表格顯示貨櫃種類數量的顯示方式
 *
 * @author Peter Chang
 * 
 * @param string $cabinet_volume 為資料庫的貨櫃種類數量
 * 
 * @return string
 */
function getCabinetVolumeText($cabinet_volume){
    $text="";
    $array=getBookingOrderCabinetVolumeStrToArray($cabinet_volume);
    $end_key=end($array);
    foreach ($array as $array_key=>$value){
        if($value>0 && $end_key==$array_key){
            $text.=$value." ".getCabinetVolumeName($array_key);
        }elseif($value>0){
            $text.=$value." ".getCabinetVolumeName($array_key)."<br>";
        }
    }
    return $text;
}
/**
 * 1.用於公司若有分機就將電話加分機回傳資料，沒有的話只回傳電話
 *
 * @author Peter Chang
 * 
 * @param string $phone 電話
 * 
 * @param string $extension 分機
 * 
 * @return string
 */
function getPhoneExtensionText($phone,$extension){
    $text="";
    if ($extension){
        $text.=$phone."分機".$extension;
    }else{
        $text.=$phone;
    }
    return $text;
}
/**
 * 1.用於根據危險性質的顯示文字方式
 *
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return string
 */
function getDangerousGoodsText($data_array){
    $text="";
    if($data_array['dangerous_goods']=="危險品"){
        $text.=$data_array['dangerous_goods']." ".$data_array['class']."/".$data_array['un_no'];
    }elseif($data_array['dangerous_goods']=="非危險品"){
        $text.=$data_array['dangerous_goods'];
    }
    return $text;
}
/**
 * 1.陣列為選項的貿易條件
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getTermsOfTradeArray(){
    $array=array("FOB PORT","EX-WORK","C&F","CIF","DDU","DDP");
    return $array;
}
/**
 * 1.用於客戶訂艙的結關地點Form Html Select下拉選單回傳
 *
 * @author Peter Chang
 * 
 * @param integer $id 結關地點的CityId
 * 
 * @return string
 */
function getCutOffPlaceOptionCityChineseValueCityId($id){
    $result="";
    $buf=sqlSelectCutOffPlace();
    foreach($buf as $row){
        if ($row['cut_off_place_id']==$id){
            $result.= "<option value=".$row['cut_off_place_id']." selected>".$row['cut_off_place']."(".$row['city_abbreviation'].")</option>";
        }else{
            $result.= "<option value=".$row['cut_off_place_id'].">".$row['cut_off_place']."(".$row['city_abbreviation'].")</option>";
        }
    }
    return $result;
}
/**
 * 1.公司員工新增帳戶填寫Form Html Select Email
 *
 * @author Peter Chang
 * 
 * @param string $value 為預設資料
 * 
 * @return string
 */
function getEmailAddressOptionEmailAddress($value){
    $result="";
    $array=getEmailAddressArray();
    foreach($array as $address){
        if ($address==$value){
            $result.= "<option value=".$address." selected>".$address."</option>";
        }else{
            $result.= "<option value=".$address.">".$address."</option>";
        }
    }
    return $result;
}
/**
 * 1.為海運航線的選單選項
 *
 * @author Peter Chang
 * 
 * @param integer $id 為國家預設值
 * 
 * @return string
 */
function getOceanExportOptionQuoteRouteValueExportOptionId($id){
    $result="";
    $buf=sqlSelectOceanExportOrderByQuoteRoute();
    foreach ($buf as $row){
        if ($row['ocean_export_id']==$id){
            $result.= "<option value=".$row['ocean_export_id']." selected>".$row['quote_route']."</option>";
        }else{
            $result.= "<option value=".$row['ocean_export_id'].">".$row['quote_route']."</option>";
        }
    }
    return $result;
}
/**
 * 1.為目的港國家的選單選項
 *
 * @author Peter Chang
 * 
 * @param integer $id 為國家預設值
 * 
 * @return string
 */
function getDestinationCountryOptionDestinationCountryEnglishValueCountryId($id){
    $result="";
    $buf = sqlSelectDestinationPortGroupByCountryId();
    foreach ($buf as $row){
        if ($row['country_id']==$id){
            $result.= "<option value=".$row['country_id']." selected>".$row['country_english']."</option>";
        }else{
            $result.= "<option value=".$row['country_id'].">".$row['country_english']."</option>";
        }
    }
    return $result;
}

/**
 * 1.為目的港國家的併櫃或整櫃選單選項
 *
 * @author Peter Chang
 * 
 * @param integer $id 為國家預設值
 * 
 * @return string
 */
function getShipmentTypeDestinationCountryOptionDestinationCountryEnglishValueCountryId($id,$shipment_type){
    $result="";
    if($shipment_type=="CY"){
        $buf = sqlSelectOceanExportPriceAllDestinationCountry();
    }elseif($shipment_type=="CFS"){
        $buf = sqlSelectCFSOceanPriceAllDestinationCountry();
    }
    //$buf = sqlSelectDestinationPortGroupByCountryId();
    foreach ($buf as $row){
        if ($row['country_id']==$id){
            $result.= "<option value=".$row['country_id']." selected>".$row['country_english']."</option>";
        }else{
            $result.= "<option value=".$row['country_id'].">".$row['country_english']."</option>";
        }
    }
    return $result;
}/**
 * 1.拿取真實ip
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getRealIp(){
    if (isset($_SESSION['ip'])){
        if($_SESSION['ip']!=$_SERVER["REMOTE_ADDR"]){
            $_SESSION['ip']=$_SERVER["REMOTE_ADDR"];
        }
    }else{
        $_SESSION['ip']=$_SERVER["REMOTE_ADDR"];
    }
    return $_SESSION['ip'];
}
/**
 * 1.為ip判斷是否有資料若沒有就新增
 *
 * @author Peter Chang
 * 
 * @param integer $member_id 會員id
 * 
 * @return array
 */
function getIpCommonHeadDecideInsert($member_id=NULL,$insert=false){
    $ip=$_SESSION['ip'];
    $ip_array = getIpLogIp($ip);
    if($insert){
        if(sqlInsertIpLog($ip,$member_id)){
            return true;
        }
    }
    if($ip_array){
        $ip_create_time=strtotime("+20 minute",strtotime($ip_array['ip_create_time']));
        if(strtotime(date('Y-m-d H:i:s'))>$ip_create_time){
            if(sqlInsertIpLog($ip,$member_id)){
                return true;
            }
            return false;
        }
        return true;
    }
    if(sqlInsertIpLog($ip,$member_id)){
        return true;
    }
    return false;
}

/**
 * 1.根據步驟給sql前的部門
 *
 * @author Peter Chang
 * 
 * @param integer $schedule 步驟編碼
 * 
 * @return string
 */
function getBookingOrderDepartmentStaffIdSql($schedule){
    $result="";
    if($schedule==2){
        $result="cs_";
    }elseif($schedule==3){
        $result="doc_";
    }elseif($schedule==4){
        $result="financial_";
    }
    return $result;
}
/**
 * 1.員工後台員工控管總權限
 * 2.department=>部門權限
 * 3.handling_department=>專責處理部門
 * 4.position=>職位權限
 * 5.extra_staff_id=>額外權限處理staff_id人員
 * 6.baged_show=>右上顯示資料
 * 7.function_permission=>額外功能權限
 * 8.function_permission=>key 此key為狀態
 * 9.bottom_function=>下拉功能
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getStaffListPriorityArray(){
    $array=array(
        "department"=>"資訊;人力資源",
        "handling_department"=>"人力資源",
        "position"=>"總經理",
        "extra_staff_id"=>false,
        "show_text"=>"員工控管",
        "baged_show"=>false,
        "function_permission"=>array(
            "add"=>array("permission"=>"add","show_text"=>"新增"),
            "update"=>array("permission"=>"update","show_text"=>"修改","required"=>"id"),
            "transfer"=>array("permission"=>"transfer","show_text"=>"客戶移交"),
            "resign"=>array("permission"=>"resign","show_text"=>"離職"),
            "furlough"=>array("permission"=>"furlough","show_text"=>"留職停薪"),
            "reinstatement"=>array("permission"=>"reinstatement","show_text"=>"復職"),
        ),
        "bottom_function"=>array(
            array(
                "page_id"=>11,
                "show_text"=>"新增員工資料",
                "url"=>"Staff/Staff.php?state=add",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>12,
                "show_text"=>"員工資料列表",
                "url"=>"Staff/StaffList.php",
                "bottom_function"=>false
            )
        )
    );
    return $array;
}

/**
 * 1.員工後台會員控管總權限
 * 2.department=>部門權限
 * 3.handling_department=>專責處理部門
 * 4.position=>職位權限
 * 5.extra_staff_id=>額外權限處理staff_id人員
 * 6.baged_show=>右上顯示資料
 * 7.function_permission=>額外功能權限
 * 8.function_permission=>key 此key為狀態
 * 9.bottom_function=>下拉功能
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getStaffMemberListPriorityArray(){
    $array=array(
        "department"=>"all",
        "handling_department"=>"客服",
        "position"=>"總經理",
        "extra_staff_id"=>false,
        "show_text"=>"會員控管",
        "baged_show"=>array("num"=>getMemberPassCount(0)),
        "function_permission"=>array(
            "information"=>array("permission"=>"information","show_text"=>"詳細資訊"),
            "pass"=>array(
                "permission"=>"pass",
                "show_text"=>"審核狀態",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            ),
            "add_blacklist"=>array(
                "permission"=>"add_blacklist",
                "show_text"=>"加入黑名單",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            ),
            "remove_blacklist"=>array(
                "permission"=>"remove_blacklist",
                "show_text"=>"移除黑名單",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            ),
            "information_statistics"=>array(
                "permission"=>"information_statistics",
                "show_text"=>"會員統計",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            ),
            "send_add"=>array(
                "permission"=>"send_add",
                "show_text"=>"寄件會員訊息新增",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            ),
            "send"=>array(
                "permission"=>"send",
                "show_text"=>"寄件會員訊息",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            ),
            "view"=>array(
                "permission"=>"view",
                "show_text"=>"寄件歷史紀錄",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            ),
            "update"=>array(
                "permission"=>"update",
                "show_text"=>"修改會員資訊",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12"
            )
        ),
        "bottom_function"=>array(
            array(
                "page_id"=>21,
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12",
                "show_text"=>"會員待審核中",
                "url"=>"Staff/StaffMemberList.php?pass=0",
                "baged_show"=>array("num"=>getMemberPassCount(0)),
                "bottom_function"=>false
            ),
            array(
                "page_id"=>22,
                "show_text"=>"會員審核通過",
                "extra_show_text"=>true,
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12",
                "same_key"=>24,
                "url"=>"Staff/StaffMemberList.php?pass=1",
                "baged_show"=>false,
                "bottom_function"=>false
            ),
            array(
                "page_id"=>23,
                "show_text"=>"會員審核不通過",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12",
                "url"=>"Staff/StaffMemberList.php?pass=2",
                "baged_show"=>false,
                "bottom_function"=>false
            ),
            array(
                "page_id"=>24,
                "show_text"=>"會員資訊",
                "extra_show_text"=>true,
                "same_key"=>22,
                "url"=>"Staff/StaffMemberList.php?pass=1",
                "baged_show"=>false,
                "bottom_function"=>false
            ),
            array(
                "page_id"=>25,
                "show_text"=>"會員黑名單",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12",
                "url"=>"Staff/StaffMemberList.php?pass=3",
                "baged_show"=>false,
                "bottom_function"=>false
            ),
            array(
                "page_id"=>26,
                "show_text"=>"會員數據統計",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12",
                "url"=>"Staff/StaffMemberDataStatisticsList.php",
                "baged_show"=>false,
                "bottom_function"=>false
            ),
            array(
                "page_id"=>27,
                "show_text"=>"寄件會員訊息",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12",
                "url"=>"Staff/StaffMemberSendMailNotificationMessage.php?state=send_add",
                "baged_show"=>false,
                "bottom_function"=>false
            ),
            array(
                "page_id"=>28,
                "show_text"=>"寄件歷史紀錄",
                "department"=>"資訊",
                "position"=>"總經理",
                "extra_staff_id"=>"12",
                "url"=>"Staff/StaffMemberEmailNotificationMessageList.php",
                "baged_show"=>false,
                "bottom_function"=>false
            )
        )
    );
    return $array;
}
/**
 * 1.員工後台跑馬燈控管總權限
 * 2.department=>部門權限
 * 3.handling_department=>專責處理部門
 * 4.position=>職位權限
 * 5.extra_staff_id=>額外權限處理staff_id人員
 * 6.baged_show=>右上顯示資料
 * 7.function_permission=>額外功能權限
 * 8.function_permission=>key 此key為狀態
 * 9.bottom_function=>下拉功能
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getStaffMarqueePriorityArray(){
    $array=array(
        "department"=>"資訊",
        "handling_department"=>false,
        "position"=>"總經理",
        "extra_staff_id"=>"12",
        "show_text"=>"跑馬燈控管",
        "baged_show"=>false,
        "function_permission"=>array(
            "add"=>array("permission"=>"add","show_text"=>"新增")
        ),
        "bottom_function"=>array(
            array(
                "page_id"=>31,
                "show_text"=>"首頁跑馬燈修改",
                "url"=>"Marquee/Marquee.php?state=add",
                "bottom_function"=>false
            )
        )
    );
    return $array;
}
/**
 * 1.員工後台目的港控管總權限
 * 2.department=>部門權限
 * 3.handling_department=>專責處理部門
 * 4.position=>職位權限
 * 5.extra_staff_id=>額外權限處理staff_id人員
 * 6.baged_show=>右上顯示資料
 * 7.function_permission=>額外功能權限
 * 8.function_permission=>key 此key為狀態
 * 9.bottom_function=>下拉功能
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getStaffDestinationPortListPriorityArray(){
    $function_permissions=array(
        array("state"=>"add","text"=>"新增"),
        array("state"=>"update","text"=>"修改"),
        array("state"=>"merge","text"=>"合併"),
        array("state"=>"change_del","text"=>"改變為刪除"),
        array("state"=>"del","text"=>"刪除"),
        array("state"=>"reply","text"=>"還原未刪除"),
    );
    $items=array(
        array("place"=>"country","text"=>"國家"),
        array("place"=>"city","text"=>"城市"),
        array("place"=>"destination_city","text"=>"目的地城市"),
        array("place"=>"destination_container_depot","text"=>"貨櫃目的地"),
        array("place"=>"destination_port","text"=>"目的港"));

    $array=array(
        "department"=>"資訊",
        "handling_department"=>false,
        "position"=>"總經理",
        "extra_staff_id"=>"12",
        "show_text"=>"目的港控管",
        "baged_show"=>false,
        "function_permission"=>array(
            "upload"=>array("permission"=>"upload","show_text"=>"上傳")
        ),
        "bottom_function"=>array(
            array(
                "page_id"=>41,
                "show_text"=>"新增國家",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"Country/Country.php?state=country_add",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>42,
                "show_text"=>"新增城市",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"City/City.php?state=city_add",
                "bottom_function"=>false
            ),
            
            array(
                "page_id"=>43,
                "show_text"=>"新增貨櫃目的地",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"DestinationContainerDepot/DestinationContainerDepot.php?state=destination_container_depot_add",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>44,
                "show_text"=>"新增目的港港口",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"DestinationPort/DestinationPort.php?state=destination_port_add",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>45,
                "show_text"=>"國家清單",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"Country/CountryList.php",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>46,
                "show_text"=>"城市清單",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"City/CityList.php",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>47,
                "show_text"=>"目的地城市清單",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"DestinationCity/DestinationCityList.php",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>48,
                "show_text"=>"貨櫃目的地清單",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"DestinationContainerDepot/DestinationContainerDepotList.php",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>49,
                "show_text"=>"目的港港口清單",
                "department"=>"資訊",
                "position"=>false,
                "extra_staff_id"=>false,
                "url"=>"DestinationPort/DestinationPortList.php",
                "bottom_function"=>false
            )
            // array(
            //     "page_id"=>47,
            //     "show_text"=>"目的港上傳資料",
            //     "department"=>"資訊",
            //     "position"=>false,
            //     "extra_staff_id"=>false,
            //     "url"=>"DestinationPort/DestinationPortUploadExcel.php?state=upload",
            //     "bottom_function"=>false
            // ),

        )
    );
    foreach($items as $item){
        foreach($function_permissions as $permission){
            $array["function_permission"][$item["place"]."_".$permission["state"]]=array("permission"=>$item["place"]."_".$permission["state"],
                "show_text"=>$item["text"].$permission["text"],
                "department"=>"資訊"
            );
        }
    }
    return $array;
}
/**
 * 1.員工後台海運報價航線控管總權限
 * 2.department=>部門權限
 * 3.handling_department=>專責處理部門
 * 4.position=>職位權限
 * 5.extra_staff_id=>額外權限處理staff_id人員
 * 6.baged_show=>右上顯示資料
 * 7.function_permission=>額外功能權限
 * 8.function_permission=>key 此key為狀態
 * 9.bottom_function=>下拉功能
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getStaffOceanExportQuoteListPriorityArray(){
    $array=array(
        "department"=>"資訊",
        "handling_department"=>false,
        "position"=>"總經理",
        "extra_staff_id"=>"12",
        "show_text"=>"海運報價",
        "baged_show"=>false,
        "function_permission"=>array(
            "add"=>array("permission"=>"add","show_text"=>"新增"),
            "update"=>array("permission"=>"update","show_text"=>"修改"),
            "shipping_company_fees_upload"=>array("permission"=>"shipping_company_fees_upload","show_text"=>"上傳")
        ),
        "bottom_function"=>array(
            array(
                "page_id"=>51,
                "show_text"=>"海運報價航線新增",
                "url"=>"OceanQuote/OceanExportQuote.php?state=add",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>52,
                "show_text"=>"海運報價航線列表",
                "url"=>"OceanQuote/OceanExportQuoteList.php",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>53,
                "show_text"=>"海運併櫃報價航線列表",
                "url"=>"OceanQuote/CFSOceanQuoteList.php",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>54,
                "show_text"=>"海運整櫃船公司費用",
                "url"=>"ShippingCompanyFees/ShippingCompanyFees.php?state=shipping_company_fees_upload",
                "bottom_function"=>false
            )
        )
    );
    return $array;
}
/**
 * 1.員工後台海運報價航線控管總權限
 * 2.department=>部門權限
 * 3.handling_department=>專責處理部門
 * 4.position=>職位權限
 * 5.extra_staff_id=>額外權限處理staff_id人員
 * 6.baged_show=>右上顯示資料
 * 7.function_permission=>額外功能權限
 * 8.function_permission=>key 此key為狀態
 * 9.bottom_function=>下拉功能
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getStaffBookingOrderListPriorityArray(){
    $array=array(
        "department"=>"all",
        "position"=>"總經理",
        "extra_staff_id"=>false,
        "show_text"=>"會員訂艙單",
        "baged_show"=>false,
        "function_permission"=>array(
            "information"=>array("permission"=>"information","show_text"=>"訂艙資訊"),
            "recieve"=>array(
                "permission"=>"recieve",
                "show_text"=>"成為客服人員",
                "schedule"=>1
            ),
            "provide_so_date"=>array(
                "permission"=>"provide_so_date",
                "show_text"=>"提供S/O日期",
                "schedule"=>2
            ),
            "provide_so_pending"=>array(
                "permission"=>"provide_so_pending",
                "show_text"=>"提供S/O完成",
                "schedule"=>2
            ),
            "document_check"=>array(
                "permission"=>"document_check",
                "show_text"=>"提單及帳單人員",
                "schedule"=>3
            ),
            "document_check_date"=>array(
                "permission"=>"document_check_date",
                "show_text"=>"提單及帳單日期",
                "schedule"=>3
            ),
            "document_check_pending"=>array(
                "permission"=>"document_check_pending",
                "show_text"=>"提單及帳單完成",
                "schedule"=>3
            ),
            "collection"=>array(
                "permission"=>"collection",
                "show_text"=>"收款人員",
                "schedule"=>4
            ),
            "collection_date"=>array(
                "permission"=>"collection_date",
                "show_text"=>"收款日期",
                "schedule"=>4
            ),
            "case_closed_date"=>array(
                "permission"=>"case_closed_date",
                "show_text"=>"結案日期",
                "schedule"=>5
            ),
            "cut_off_date"=>array(
                "permission"=>"cut_off_date",
                "show_text"=>"結關日",
                "schedule"=>"2;3"
            ),
            "onboard_date"=>array(
                "permission"=>"onboard_date",
                "show_text"=>"開航日",
                "schedule"=>"2;3"
            ),
            "delfile"=>array(
                "permission"=>"delfile",
                "show_text"=>"刪除附檔",
                "schedule"=>1
            ),
            "cancel"=>array(
                "permission"=>"cancel",
                "show_text"=>"員工取消訂艙單",
                "schedule"=>"all",
                "department"=>"資訊"
            ),
            "reply"=>array(
                "permission"=>"reply",
                "show_text"=>"回復訂艙單",
                "schedule"=>"all",
                "department"=>"資訊"
            )
        ),
        "bottom_function"=>getBookingOrderDepartmentPositionSchedulePriorityArray()
    );
    return $array;
}

function getStaffExtraFeaturesListPriorityArray(){
    $array=array(
        "department"=>"資訊;船務代理",
        "handling_department"=>false,
        "position"=>"總經理",
        "extra_staff_id"=>"12",
        "show_text"=>"額外功能",
        "baged_show"=>false,
        "function_permission"=>array(
            "information"=>array("permission"=>"upload_excel","show_text"=>"上傳EXCEL"),
        ),
        "bottom_function"=>array(
            array(
                "page_id"=>71,
                "department"=>"資訊",
                "show_text"=>"海運瀏覽紀錄",
                "url"=>"Staff/StaffMemberRecordList.php",
                "bottom_function"=>false
            ),
            array(
                "page_id"=>72,
                "department"=>"資訊;船務代理",
                "show_text"=>"台塑報價轉檔",
                "url"=>"OceanQuote/OceanQuoteUploadExcelTransferFormat.php?state=upload_excel",
                "bottom_function"=>false
            )
        )
    );
    return $array;
}
/**
 * 1.員工後台總權限陣列
 * 2.getStaffListPriorityArray()=>員工控管權限
 * 3.getStaffMemberListPriorityArray()=>會員控管權限
 * 4.getStaffMarqueePriorityArray()=>跑馬燈權限
 * 5.getStaffDestinationPortListPriorityArray()=>目的港權限
 * 6.getStaffOceanExportQuoteListPriorityArray()=>海運報價權限
 * 7.getStaffBookingOrderListPriorityArray()=>訂艙權限
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getStaffHeaderPriorityArray(){
    $array=array(
        1=>getStaffListPriorityArray(),     
        2=>getStaffMemberListPriorityArray(),           
        3=>getStaffMarqueePriorityArray(),
        4=>getStaffDestinationPortListPriorityArray(),
        5=>getStaffOceanExportQuoteListPriorityArray(),
        6=>getStaffBookingOrderListPriorityArray(),
        7=>getStaffExtraFeaturesListPriorityArray()
    );
    return $array;
}
/**
 * 1.員工後台頁面權限判斷
 *
 * @author Peter Chang
 * 
 * @param integer $key 總權限的key
 * 
 * @return array
 */
function getStaffPagePriorityReturn($key){
    $result="";
    $now_urls=explode("/",$_SERVER['REQUEST_URI']);
    $end_now_urls=end($now_urls);

    $staff_prioritys=getStaffHeaderPriorityArray();
    $arrays=$staff_prioritys[$key];
    if(!isset($_SESSION['staff_id'])){
        $message="尚未登入";
        return array(false,$message);
    }
    $staff_array=getStaffListStaffId($_SESSION['staff_id']);
    if(isset($arrays["bottom_function"])){
        foreach($arrays["bottom_function"] as $array){
            $urls=explode("/",$array["url"]);
            if(strpos($end_now_urls,end($urls))!==false){
                if(getStaffPriorityReturn($arrays,$array,$staff_array)){
                    $message="權限正確";
                    return array(true,$message);
                }
                $priority=false;    
            }
            $message="網址不符合，仍可使用";
        }
        if(isset($priority)){
            $message="不符合權限";
            return array($priority,$message);
        }
    }else{
        $message="原始權限資料錯誤";
        return array(false,$message);
    }
    return array(true,$message);
}
/**
 * 1.員工後台功能狀態判斷
 *
 * @author Peter Chang
 * 
 * @param string $state 頁面接收資訊狀態
 * 
 * @param integer $key 總權限的key
 * 
 * @param boolean|integer $id 資料庫的id
 * 
 * @param boolean $state_null 是否狀態可以為空
 * 
 * @return array
 */
function getStaffStatePriorityReturn($state,$key,$id=false,$state_null=true){
    $result="";
    $message="";
    $staff_prioritys=getStaffHeaderPriorityArray();
    $arrays=$staff_prioritys[$key];
    if(!isset($_SESSION['staff_id'])){
        $message="尚未登入";
        return array(false,$message);
    }
    $staff_array=getStaffListStaffId($_SESSION['staff_id']);
    if($id!==false && !$id){
        if($state!="add"){
            $message="id不可為空";
            return array(false,$message);
        }
    }elseif($id!==false && $id && $state=="add"){
        $message="新增時id不會有資料";
        return array(false,$message);
    }
    if($state===false){
        $message="無狀態，錯誤";
        return array(false,$message);
    }elseif($state=="" && $state_null===true){
        $message="此狀態為空值，正確";
        return array(true,$message);
    }elseif(isset($arrays["function_permission"][$state])){
        $array=$arrays["function_permission"][$state];
        if(getStaffPriorityReturn($arrays,$array,$staff_array)){
            $message="權限正確";
            return array(true,$message);
        }
        $message="權限錯誤";
        return array(false,$message);
    }
    $message="無此狀態";
    return array(false,$message);
}
/**
 * 1.員工後台功能下拉選單
 *
 * @author Peter Chang
 * 
 * @param string $dropdown_href 父層連結
 * 
 * @return array
 */
function getStaffHeaderPriorityDropDownList($dropdown_href){
    $result="";
    $page_keys=array();
    $staff_array=getStaffListStaffId($_SESSION['staff_id']);
    $staff_prioritys=getStaffHeaderPriorityArray();
    foreach($staff_prioritys as $arrays){
        if(getStaffPriorityReturn($arrays,false,$staff_array)){
            $baged_show_text=getBagedShowShowTextReturn($arrays);
            //id='dropdown01' data-bs-toggle='dropdown' aria-expanded='false' 會影響class=nav-link dropdown-toggle下拉清單滑動
            $result.="
            <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' href='#' >".$arrays["show_text"].$baged_show_text."</a>
                <ul class='dropdown-menu' aria-labelledby='dropdown01'>";
            foreach($arrays["bottom_function"] as $bottom_funcions){
                if(getStaffPriorityReturn($arrays,$bottom_funcions,$staff_array)){
                    $show_text=$bottom_funcions["show_text"];
                    $baged_show_text=getBagedShowShowTextReturn($bottom_funcions);
                    if(isset($bottom_funcions["extra_show_text"])){
                        if($bottom_funcions["extra_show_text"]===true){
                            if(in_array($bottom_funcions["page_id"],$page_keys)){
                                continue;
                            }else{
                                array_push($page_keys,$bottom_funcions["same_key"]);
                            }
                        }
                    }
                    $result.="
                    <li><a class='dropdown-item' href='".$dropdown_href.$bottom_funcions["url"]."'>".$show_text.$baged_show_text."</a></li>";
                }
            }
            $result.="
                </ul>
            </li>";
        }
    }
    return $result;
}
/**
 * 1.員工後台功能回傳浮動標籤文字
 *
 * @author Peter Chang
 * 
 * @param array $array 浮動數字標籤陣列相關文字
 * 
 * @return array
 */
function getBagedShowShowTextReturn($array){
    $show_text="";
    if(getBagedShowPriorityReturn($array)){
        $show_text=getHtmlButtonAHrefBadge(strval("+".$array["baged_show"]["num"]));
    }
    return $show_text;
}
/**
 * 1.員工後台功能回傳浮動標籤正確或錯誤
 *
 * @author Peter Chang
 * 
 * @param array $array 浮動數字標籤陣列相關資訊
 * 
 * @return boolean
 */
function getBagedShowPriorityReturn($array){
    if(isset($array["baged_show"])){
        if($array["baged_show"]!==false){
            if($array["baged_show"]["num"]>0){
                return true;
            }
        }
    }
    return false;
}
/**
 * 1.員工後台功能回傳權限正確或錯誤
 *
 * @author Peter Chang
 * 
 * @param array $arrays 權限的第一層陣列
 * 
 * @param array $array 權限的下拉清單陣列
 * 
 * @param array $staff_array 員工資料陣列
 * 
 * @return boolean
 */
function getStaffPriorityReturn($arrays,$array,$staff_array){
    $departments=explode(";",$arrays["department"]);
    $extra_staff_ids=explode(";",$arrays["extra_staff_id"]);
    $position=$arrays["position"];
    if($array!==false){
        if(isset($array["department"])){$departments=explode(";",$array["department"]);}
        if(isset($array["extra_staff_id"])){$extra_staff_ids=explode(";",$array["extra_staff_id"]);}
        if(isset($array["position"])){$position=$array["position"];}
    }
    foreach($extra_staff_ids as $extra_staff_id){
        if($staff_array["staff_id"]==$extra_staff_id && $extra_staff_id!==false){
            return true;
        }
    }
    foreach($departments as $key=>$department){
        if($department){
            if(strpos($staff_array['department'],$department)!==false ||
                $department=="all" ||
                (strpos($staff_array['position'],$position)!==false && $position!==false && $key==0 )){
                return true;
            }
        }
    }
    return false;
}
/**
 * 1.訂艙單步驟權限
 * 2.department=>部門權限
 * 3.reply_department=>回復上一步權限部門
 * 4.handling_department=>專責處理部門
 * 5.position=>職位權限
 * 6.schedule=>步驟編碼
 * 7.show_text=>共用顯示文字
 *
 * @author Peter Chang
 * 
 * @return array
 */
function getBookingOrderDepartmentPositionSchedulePriorityArray(){
    $array=array(
        1=>array("page_id"=>61,
        "department"=>"資訊;客服",
        "reply_department"=>false,
        "handling_department"=>"客服",
        "position"=>"總經理",
        "url"=>"Staff/StaffBookingOrderList.php?schedule=1",
        "schedule"=>1,
        "show_text"=>"等待服務人員處理"),     
        2=>array("page_id"=>62,
        "department"=>"資訊;客服",
        "reply_department"=>false,
        "handling_department"=>"客服",
        "position"=>"總經理",
        "url"=>"Staff/StaffBookingOrderList.php?schedule=2",
        "schedule"=>2,
        "show_text"=>"等待提供S/O"),        
        3=>array("page_id"=>63,
        "department"=>"資訊;文件",
        "reply_department"=>"資訊",
        "handling_department"=>"文件",
        "position"=>"總經理",
        "url"=>"Staff/StaffBookingOrderList.php?schedule=3",
        "schedule"=>3,
        "show_text"=>"等待提單及帳單"),     
        4=>array("page_id"=>64,
        "department"=>"資訊;財務",
        "reply_department"=>"資訊",
        "handling_department"=>"財務",
        "position"=>"總經理",
        "url"=>"Staff/StaffBookingOrderList.php?schedule=4",
        "schedule"=>4,
        "show_text"=>"等待收款",
        "exception_show_text"=>"已收到款項"),
        5=>array("page_id"=>65,
        "department"=>"資訊",
        "reply_department"=>"資訊",
        "handling_department"=>false,
        "position"=>"總經理",
        "url"=>"Staff/StaffBookingOrderList.php?schedule=5",
        "schedule"=>5,
        "show_text"=>"等待結案"),
        6=>array("page_id"=>66,
        "department"=>"all",
        "reply_department"=>false,
        "handling_department"=>false,
        "position"=>"all",
        "url"=>"Staff/StaffBookingOrderList.php?schedule=6",
        "schedule"=>6,
        "show_text"=>"結案"),
        7=>array("page_id"=>67,
        "department"=>"資訊;客服",
        "reply_department"=>false,
        "handling_department"=>"客服",
        "position"=>"總經理",
        "url"=>"Staff/StaffBookingOrderList.php?schedule=7",
        "schedule"=>7,
        "show_text"=>"客戶取消訂艙"),
        8=>array("page_id"=>68,
        "department"=>false,
        "reply_department"=>false,
        "handling_department"=>false,
        "position"=>false,
        "url"=>"Staff/StaffBookingOrderList.php?schedule=8",
        "schedule"=>8,
        "show_text"=>"員工取消客戶訂艙"),
        9=>array("page_id"=>69,
        "url"=>"Staff/StaffBookingOrderAllList.php",
        "show_text"=>"所有訂艙列表")
    );
    return $array;
}
/**
 * 1.訂艙步驟權限及員工處理人員資料回傳，若有data_array則將處理人員附檔帶入
 * 2.$false_data若為true則代表需要帶入假資料判斷是否人員有該權限
 *
 * @author Peter Chang
 * 
 * @param boolean|array $data_array 此為資料庫BookingOrder的資料
 * 
 * @param boolean $flase_data 是否需要假資料
 * 
 * @return array
 */
function getBookingOrderSchedulePriorityShowArray($data_array=false,$false_data=false){
    $arrays=getBookingOrderDepartmentPositionSchedulePriorityArray();
    $fields=array("staff_id","staff_date");
    if($data_array===false && $false_data===false){
        return $arrays;
    }elseif($false_data===true){
        $staff_fields=array("cs","doc","financial");
        foreach($staff_fields as $staff_field){
            foreach($fields as $field){
                $data_array[$staff_field."_".$field]=1;
            }
        }
        $cs_attachments=array(1);
        $doc_attachments=array(1);
        $data_array['case_closed_staff_id']=1;
        $data_array['case_closed_date']=1;
    }elseif($false_data===false){
        
        $doc_attachments=array($data_array['receive_bill_attachment'],$data_array['bill_of_lading_attachment']);
        $doc_attachments=array_filter(array_merge($doc_attachments,explode(";",$data_array['doc_staff_attachment'])));
        $cs_attachments=array($data_array['so_attachment']);
        $cs_attachments=array_filter(array_merge($cs_attachments,explode(";",$data_array['cs_staff_attachment'])));
    }
    $new_array=$arrays;
    
    $staff_booking_order_array=array(
        2=>array("staff_id"=>$data_array['cs_staff_id'],
                    "staff_date"=>$data_array['cs_staff_date'],
                    "staff_attachment"=>$cs_attachments,
                    "date_text"=>"提供S/O日期",
                    "attachment_text"=>"S/O檔案",
                    "attachment_schedule_text"=>"提供S/O附檔",
                    "staff_department_show"=>"客服人員",
                    "show_table"=>true
                    ),
        3=>array("staff_id"=>$data_array['doc_staff_id'],
                    "staff_date"=>$data_array['doc_staff_date'],
                    "staff_attachment"=>$doc_attachments,
                    "date_text"=>"提單核對日期",
                    "attachment_text"=>"提單及帳單",
                    "attachment_schedule_text"=>"提供提單及帳單附檔",
                    "staff_department_show"=>"提單核對人員",
                    "show_table"=>true
                    ),
        4=>array("staff_id"=>$data_array['financial_staff_id'],
                    "staff_date"=>$data_array['financial_staff_date'],
                    "staff_attachment"=>false,
                    "date_text"=>"收款日期",
                    "attachment_text"=>"",
                    "attachment_schedule_text"=>"",
                    "staff_department_show"=>"財務收款人員",
                    "show_table"=>true
                    ),
        5=>array("staff_id"=>$data_array['case_closed_staff_id'],
                    "staff_date"=>$data_array['case_closed_date'],
                    "staff_department_show"=>"結案人員",
                    "show_table"=>false
                )
    );
    $fields=array("staff_id","staff_date","staff_attachment","date_text",
            "attachment_text","attachment_schedule_text","staff_department_show","show_table");
    foreach($arrays as $key=>$array){
        if(isset($staff_booking_order_array[$key])){
            $staff_booking_orders=$staff_booking_order_array[$key];
            foreach($fields as $field){
                if(isset($staff_booking_orders[$field])){
                    $new_array[$key][$field]=$staff_booking_orders[$field];
                }else{
                    $new_array[$key][$field]=false;
                }
            }
        }else{
            foreach($fields as $field){
                $new_array[$key][$field]=false;
            }
        }
    }
    return $new_array;
}
/**
 * 1.將步驟編碼及員工資料帶入，確認是否有此權限可使用此功能
 * 2.$false_data若為true則代表需要帶入假資料判斷是否人員有該權限
 *
 * @author Peter Chang
 * 
 * @param integer $schedule 步驟的編碼
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @param boolean $reply 是否需要查看回復上一步驟部門的權限
 * 
 * @return boolean
 */
function getBookingOrderDepartmentPositionSchedulePriorityReturn($schedule,$staff_array,$reply=false){
    $booking_order_shcedule_array=getBookingOrderSchedulePriorityShowArray(false);
    if(isset($booking_order_shcedule_array[$schedule])){
        $booking_order_array=$booking_order_shcedule_array[$schedule];
        if($reply!==false){
            $department=$booking_order_array["reply_department"];
        }else{
            $department=$booking_order_array["department"];
        }
        if($department===false){
            return false;
        }
        $departments=explode(";",$department);
        foreach($departments as $key=>$department){
            if($reply!==false && strpos($staff_array['department'],$department)!==false){
                return true;
            }elseif($reply===false){
                if(strpos($staff_array['department'],$department)!==false ||
                    $department=="all" ||
                    (strpos($staff_array['position'],$booking_order_array["position"])!==false && $key==0)){
                    return true;
                }
            }
        }
        return false;
    }
    return false;
}
/**
 * 1.檢查是否符合回復上一步步驟的條件，若已填寫日期或上傳檔案，則無法回復上一步
 *
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return array(boolean,string)
 */
function getBookingOrderStaffIdStaffDateStaffAchmentPriorityMessage($data_array){
    $result=false;
    $message="";
    $serial_number=getSerialCombinationStr($data_array);
    $schedule=$data_array["schedule"];
    $reduce_schedule=$schedule-1;
    $booking_order_shcedule_array=getBookingOrderSchedulePriorityShowArray($data_array);
    $booking_order_shcedules=$booking_order_shcedule_array[$schedule];
    if($booking_order_shcedules["staff_date"] || $booking_order_shcedules["staff_attachment"]){
        $message="編號:".$serial_number."訂艙".$booking_order_shcedules["staff_department_show"]."已填寫日期或上傳附檔"; 
    }else{
        $message="將編號:".$serial_number."訂艙狀態還原至".$booking_order_shcedule_array[$reduce_schedule]["show_text"];
        $result=true;
    }
    return array($result,$message);
}
/**
 * 1.訂艙步驟顯示的名稱，若有$data_array將資料存入員工的處理人員及附檔
 * 2.若有附檔則回傳該步驟文字資訊
 * 3.因財務收款人員無上傳檔案只有日期，故若有日期且額外顯示文字則會回傳額外顯示文字回傳用於訂艙表格上
 * 
 * @author Peter Chang
 * 
 * @param integer $value 為步驟編碼
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return string
 */
function getBookingOrderScheduleShowName($value,$data_array=false){
    $array=getBookingOrderSchedulePriorityShowArray($data_array);
    if($data_array!==false){
        if($array[$value]["staff_attachment"]){
            return $array[$value]["attachment_schedule_text"];
        }
        if(isset($array[$value]["exception_show_text"]) && $array[$value]["staff_date"]){
            return $array[$value]["exception_show_text"];
        }
    }
    return $array[$value]["show_text"];
}
/**
 * 1.訂艙步驟Html Form Select下拉式選單列出來
 * 
 * @author Peter Chang
 * 
 * @param integer $value 為步驟編碼
 * 
 * @return string
 */
function getBookingOrderScheduleSelect($value){
    $result="";
    $buf=getBookingOrderSchedulePriorityShowArray();
    foreach ($buf as $key=>$row){
        if($key>=1 && $key<=7){
            if($key==$value){
                $result.="<option value=".$key." selected>".$row["show_text"]."</option>";
            }else{
                $result.="<option value=".$key.">".$row["show_text"]."</option>";
            }
        }
    }
    return $result;
}
/**
 * 1.將資料庫Destination目的地Country Id 存入陣列搜尋條件為目的地id
 * 
 * @author Peter Chang
 * 
 * @param array $row 資料庫陣列
 * 
 * @return array
 */
function getDestinationIdCountryIdArray($row){
    if($row['destination_port_id']!=0){
        $row['destination_country_id']=$row['destination_port_country_id'];
        $row['destination_english']=$row['destination_port_english'];
    }elseif($row['destination_container_depot_id']!=0){
        $row['destination_country_id']=$row['destination_container_depot_country_id'];
        $row['destination_english']=$row['container_depot_english'];
    }
    $country_array=getCountryCountryId($row['destination_country_id']);
    $row['destination_country_english']=$country_array['country_english'];
    return $row;
}
/**
 * 1.目的港港口抓資料庫Destination搜尋條件為id
 * 
 * @author Peter Chang
 * 
 * @param integer $id 為目的地id
 * 
 * @return array
 */
function getDestinationId($id){
    $buf = sqlSelectDestinationId($id);
    foreach ($buf as $row){
        return getDestinationIdCountryIdArray($row);
    }
}
/**
 * 1.目的港港口抓資料庫DestinationPort搜尋條件為港口id
 * 
 * @author Peter Chang
 * 
 * @param integer $id 為目的港港口的id
 * 
 * @return array
 */
function getDestinationPortDestinationPortId($id){
    $buf = sqlSelectDestinationPortId($id);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.拿取目的地Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param integer $country_id 為國家的id
 * 
 * @param integer $id 為目的港港口的id
 * 
 * @return string
 */
function getDestinationOptionDestinationEnglishValueId($country_id,$id){
    $result="";
    $buf=getDestinationIdEnglish($country_id);
    foreach ($buf as $row){
        foreach($row as $key=>$value){
            if($key==$id){
                $result.="<option value=".$key." selected>".$value."</option>";
            }else{
                $result.="<option value=".$key.">".$value."</option>";
            }
        }
    }
    return $result;
}
/**
 * 1.抓資料庫StaffLIst搜尋條件為員工id
 * 
 * @author Peter Chang
 * 
 * @param integer $id 為員工的id
 * 
 * @return array
 */
function getStaffListStaffId($id){
    $buf = sqlSelectStaffListStaffId($id);
    if($buf){
        foreach ($buf as $row){
            $row["department_ids"]=explode(";",$row["department_id"]);
            $row["departments"]=explode(";",$row["department"]);
            return $row;
        }
        
    }
    return false;
}
/**
 * 1.抓資料庫City搜尋條件為CityId
 * 
 * @author Peter Chang
 * 
 * @param integer $id 為城市的id
 * 
 * @return array
 */
function getCityId($id){
    $buf=sqlSelectCityId($id);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫Department搜尋條件為department
 * 
 * @author Peter Chang
 * 
 * @param string $value 為部門名稱
 * 
 * @return array
 */
function getDepartmentDepartment($value){
    $buf = sqlSelectDepartmentDepartment($value);
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫Marquee 最新的資料
 * 
 * @author Peter Chang
 * 
 * @return array
 */
function getMarqueeMarqueeFirst(){
    $buf = sqlSelectMarqueeExportFirst();
    foreach ($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫Marquee 最新的資料
 * 
 * @author Peter Chang
 * 
 * @return array
 */
function getMarqueeMarqueeDefaultSelectContent(){
    $buf = sqlSelectMarqueeExportDefaultSelect();
    foreach ($buf as $row){
        return $row['marquee_content'];
    }
}
/**
 * 1.結關地點id則會回傳結關地點的陣列的value
 * 
 * @author Peter Chang
 * 
 * @param integer $cut_off_place_id 為結關地的id
 * 
 * @return string|boolean
 */
function CutOffPlaceIdFormat($cut_off_place_id){
    $row=getCutOffPlaceId($cut_off_place_id);
    return $row['cut_off_place'];
}
/**
 * 1.將貨櫃種類及櫃量從陣列轉成字串
 * 
 * @author Peter Chang
 * 
 * @param array $data_array 為貨櫃種類的data_array sql_name應符合key
 * 
 * @return array(string,integer)
 */
function getBookingOrderCabinetVolumeArrayToStr($data_array){
    $datas=array();
    $sum=0;
    $buf=getCabinetVolumeArray();
    foreach ($buf as $key=>$row){
        array_push($datas,$row['sql_name'].":".$data_array[$key]);
        $sum+=intval($data_array[$key]);
    }
    $data=implode("|",$datas);
    return array($data,$sum);
}
/**
 * 1.將貨櫃種類及櫃量從POST KEY為數字陣列轉成KEY為轉成id
 * 
 * @author Peter Chang
 * 
 * @param array $data_array 為貨櫃種類的data_array sql_name應符合key
 * 
 * @return array(string,integer)
 */
function getCabinetVolumeArrayKeyToCabinetVolumeId($data_array){
    $data_array = array_merge($data_array); 
    $datas=array();
    $buf=getCabinetVolumeArray();
    foreach ($buf as $key=>$row){
        $datas[$row['cabinet_volume_id']]=$data_array[$key];
    }
    return $datas;
}
/**
 * 1.將貨櫃種類及櫃量從字串轉成陣列
 * 
 * @author Peter Chang
 * 
 * @param array $cabinet_volume 為資料庫欄位的貨櫃種類及櫃量資料
 * 
 * @return array
 */
function getBookingOrderCabinetVolumeStrToArray($cabinet_volume){
    $buf=getCabinetVolumeArray();
    $array=array();
    foreach ($buf as $row){
        $array[$row['sql_name']]=0;
    }
    if(!$cabinet_volume){
        return $array;
    }
    $datas=explode("|",$cabinet_volume);
    foreach ($datas as $data){
        $key=substr($data,0,strpos($data,':'));
        $value=substr($data,strpos($data,':')+1);
        if($key){
            $array[$key]=$value;
        }
    }
    return $array;
}
/**
 * 1.拿取部門Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param integer $value 為部門的id預設選項
 * 
 * @return string
 */
function getDepartmentOptionDepartmentValueId($department_id){
    $result="";
    $buf=sqlSelectDepartment();
    foreach ($buf as $row){
        if ($row["department_id"]==$department_id){
            $result.="<option value=".$row['department_id']." selected>".$row['department']."</option>";
        }else{
            $result.="<option value=".$row['department_id'].">".$row['department']."</option>";
        }
    }
    return $result;
}
/**
 * 1.拿取新增修改員工清單部門Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param integer $value 為部門的id預設選項
 * 
 * @return string
 */
function getDepartmentOptionDepartmentValueIds($department_ids){
    $result="";
    $buf=sqlSelectDepartment();
    foreach ($buf as $row){
        if (in_array($row["department_id"],$department_ids)){
            $result.="<option value=".$row['department_id']." selected>".$row['department']."</option>";
        }else{
            $result.="<option value=".$row['department_id'].">".$row['department']."</option>";
        }
    }
    return $result;
}
/**
 * 1.拿取職位Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param integer $value 為職位的id預設選項
 * 
 * @return string
 */
function getPositionOptionPositionValueId($value){
    $result="";
    $buf=sqlSelectPosition();
    foreach ($buf as $row){
        if ($row['position_id']==$value){
            $result.="<option value=".$row['position_id']." selected>".$row['position']."</option>";
        }else{
            $result.="<option value=".$row['position_id'].">".$row['position']."</option>";
        }
    }
    return $result;
}
/**
 * 1.拿取員工狀態等Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param integer $value 為員工狀態的id預設選項
 * 
 * @return string
 */
function getStaffStateOptionStateValueId($value){
    $result="";
    $buf=sqlSelectStaffState();
    foreach ($buf as $row){
        if ($row['staff_state_id']==$value){
            $result.="<option value=".$row['staff_state_id']." selected>".$row['state']."</option>";
        }else{
            $result.="<option value=".$row['staff_state_id'].">".$row['state']."</option>";
        }
    }
    return $result;
}
/**
 * 1.拿取城市等Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param integer $value 為城市的id預設選項
 * 
 * @return string
 */
function getCityOptionCityChineseValueId($value){
    $result="";
    $buf=sqlSelectCity();
    foreach ($buf as $row){
        if ($row['city_id']==$value){
            $result.="<option value=".$row['city_id']." selected>".$row['city_chinese']."</option>";
        }else{
            $result.="<option value=".$row['city_id'].">".$row['city_chinese']."</option>";
        }
    }
    return $result;
}
/**
 * 1.拿取區域Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param integer $city_id 為城市的id
 * 
 * @param integer $value 為員工狀態的id預設選項
 * 
 * @return string
 */
function getAreaOptionAreaChineseValueId($city_id,$value){
    $result="";
    $buf=sqlSelectAreaCityId($city_id);
    foreach ($buf as $row){
        if ($row['area_id']==$value){
            $result.="<option value=".$row['area_id']." selected>".$row['area_chinese']."</option>";
        }else{
            $result.="<option value=".$row['area_id'].">".$row['area_chinese']."</option>";
        }
    }
    return $result;
}
/**
 * 1.拿取貨品性質Html Form Select下拉式選單
 * 
 * @author Peter Chang
 * 
 * @param string $value 為貨物性質的id預設選項
 * 
 * @return string
 */
function getShipmentTypeOptionShipmentTypeChineseValueShipmentType($value){
    $result="";
    $buf=array(
        array("english"=>"CY","chinese"=>"整櫃"),
        array("english"=>"CFS","chinese"=>"併櫃")
    );
    foreach ($buf as $row){
        if ($row['english']==strtoupper($value)){
            $result.="<option value='".$row['english']."' selected>".$row['chinese']."</option>";
        }else{
            $result.="<option value='".$row['english']."'>".$row['chinese']."</option>";
        }
    }
    return $result;
}
/**
 * 1.目前寄信信箱預設為公司帳戶
 * 
 * @author Peter Chang
 * 
 * @return array(string,string)
 */
function getAccountAuth(){
    $account="";
    $auth="";
    return array($account,$auth);
}
/**
 * 1.這邊為經過抓資料庫的Email共用可以改為測試中就會將信寄到測試信箱，請自己改成需要的信箱
 * 2.sqlSelectEmailAddressBookEmail為內部的聯絡人Email若要修改測試Email請進去修改test底下
 * 3.需要變成測試中請將$state="test";這段解開註解
 * 4.正式時請將$state="test";加上註解
 * 
 * @author Peter Chang
 * 
 * @param string $identity 為寄Email的身份
 * 
 * @param string $staff 為可能多個員工或單個員工
 * 
 * @param string $member 會員有可能為單個或多的
 * 
 * @param boolean|string $state 代表為測試中，正常不用填寫此函數
 * 
 * @return array(string,string)
 */
function getAllSendMailDataDecide($identity,$staff,$member,$state=false){
    //$state="test";
    if($state=="test"){
        $staff="test";
        $mebmer="test";
    }
    if($identity=="staff"){
        return sqlSelectEmailAddressBookEmail($staff);
    }elseif($identity=="member"){

    }elseif($identity=="member_all"){
        if($state=="test"){
            $arrays=array();
            $buf = sqlSelectEmailAddressBookEmail("peter");
            foreach($buf as $row){
                array_push($arrays,array("member_id"=>0,
                                    "contact_name"=>$row["name"],
                                    "contact_email"=>$row["email"]));
            }
            return $arrays;
        }else{
            return sqlSelectMemberPass(1);
        }
    }
}
/**
 * 1.寄信時使用此function 且必須將require匯入PHPMailer
 * 
 * @author Peter Chang
 * 
 * @param string $account 寄信帳戶的帳號
 * 
 * @param string $auth 寄信帳戶的密碼
 * 
 * @param string $smtp 寄件者信箱
 * 
 * @param string $emailname 寄件者姓名
 * 
 * @param string $subject 寄信郵件主旨
 * 
 * @param string $msg 寄件郵件內容
 * 
 * @param string $signature_image 是否需要圖像
 * 
 * @param array|boolean $attach_array 為此封郵件需要的附檔
 * 
 * @param array $recipents 為收件者可以是多位但必須陣列key為name且也有email
 * 
 * @param array|boolean $cc 為郵件副本對象可以是多位但必須陣列key為name且也有email
 * 
 * @param boolean $host_green 是否需要用購買的大量寄信
 * 
 * @return boolean
 */
function sendMailLetter($account,$auth,$smtp,$emailname,$subject,$msg,
    $signature_image,$attach_array,$recipients,$cc,$host_green=false){
	$mail = new PHPMailer(); //建立新物件
	$mail->IsSMTP(); //設定使用SMTP方式寄信
	$mail->SMTPAuth = true; // 設定SMTP需要驗證
    if ($host_green){
        $mail->Host = "green.mailcloud.tw"; //設定SMTP主機
        //目前購買green的大量服務，所以SMTP改用這個用此為看當初合約購買多少並無時間隔多少再寄一次限制
    }else{
	   $mail->Host = "ms.mailcloud.com.tw"; //設定SMTP主機
    }
	$mail->Port = 25; //設定SMTP埠位，預設為25埠。
	$mail->CharSet = "utf-8"; //設定郵件編碼
	$mail->Username = "$account"; //設定驗證帳號
	$mail->Password = "$auth"; //設定驗證密碼
	$mail->From = "$smtp"; //設定寄件者信箱
	$mail->FromName = "$emailname"; //設定寄件者姓名
	$mail->Subject = "$subject"; //設定郵件標題
	$mail->Body = "$msg"; //設定郵件內容
	$mail->IsHTML(true); //設定郵件內容為HTML
    print_r($subject);
    print_r($msg);
    print_r($recipents);
    print_r($cc);
    print_r($attach_array);
    // if ($signature_image){
    //     $mail->AddEmbeddedImage($signature_image, 1, 'attachment', 'base64', 'image/gif');
    // }
    // if (is_array($attach_array)){
	//    foreach ($attach_array as $attach){
	// 	  $mail->AddAttachment($attach);
	//    }
    // }
    // foreach($recipients as $recipient){
    //     $mail->AddAddress($recipient['email'],$recipient['name']); //設定收件者郵件及名稱
    // }
    // if (is_array($cc) && !empty($cc)){
    //     foreach ($cc as $value){
    //         $mail->AddCC($value['email'],$value['name']);
    //     }
    // }
    // if (!$mail->Send()) {
    //     echo "Mailer Error: " . $mail->ErrorInfo . "<br>";
    //     return false;
    // } else {
    //     //echo "Message sent!" . "<br>";
    //     return true;
    // }
    return true;
}
/**
 * 1.SQL的第幾筆到第幾筆列出來
 * 
 * @author Peter Chang
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return string
 */
function getSQLLimitStartEnd($start,$per){
    if ($start==0 && $per || $start && $per){
        return "LIMIT ".$start.",".$per;
    }
    return "";
}
/**
 * 1.將流水編號頭跟尾結合
 * 
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return string
 */
function getSerialCombinationStr($data_array){
    return $data_array['serial_head'].$data_array['serial_number'];
}
/**
 * 1.根據步驟編碼及狀態決定訂艙單寄信內容訊息
 * 
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @return string
 */
function getSendMailOrderStatusMsg($data_array,$state){
    $result="
    <html>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU' crossorigin='anonymous'>
    <body>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ' crossorigin='anonymous'></script>
    <span style='font-family:Microsoft JhengHei;'>";
    $contact_msg="Dear ".$data_array['contact_name']." ".getGenderChinese($data_array['gender'])."<br><br>您好，<br><br>";
    $serial_number=getSerialCombinationStr($data_array);
    $schedule=$data_array['schedule'];
    $msg="";
    if($state=="cut_off_date"){
         $msg="
        您的訂艙編號".$serial_number."，更改結關日通知。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>";  
    }elseif($state=="onboard_date"){
        $msg="
        您的訂艙編號".$serial_number."，更改開航日通知。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>"; 
    }elseif($schedule==1){
        $contact_msg="";
        $msg="
        <span style='font-size:18.5px;'>
        收到客戶訂艙的通知，訂艙編號 :".$serial_number."<br>
        請至測試海運網後台接單。
        </span>";
    }elseif($schedule==2){
        $staff_array=getStaffListId($data_array['cs_staff_id']);
        $msg="
        您的訂艙編號".$serial_number."，已經由本公司的客服部人員 ".$staff_array['ename']." 分機#".$staff_array['extension']." 負責處理。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>"; 
        if($state=="provide_so_pending"){
            $contact_msg="Dear 測試文件部<br><br>您好，<br><br>";
            $msg="
        訂艙編號 :".$serial_number."，客服部已提供正確S/O<br>
        請至測試海運網後台接單。<br>"; 
        }elseif($state=="provide_so_date"){
           $msg="
        您的訂艙編號".$serial_number."，已經由本公司的客服部人員 ".$staff_array['ename']." 分機#".$staff_array['extension']." 提供S/O，請參閱附件檔案。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>";  
        }
    }elseif($schedule==3){
        $staff_array=getStaffListId($data_array['doc_staff_id']);
        $msg="
        您的訂艙編號".$serial_number."，已經提供S/O，後續作業由本公司的文件部人員".$staff_array['ename']." 分機#".$staff_array['extension']." 負責處理。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>"; 
        if($state=="document_check_pending"){
            $contact_msg="Dear 測試財務部<br><br>您好，<br><br>";
           $msg="
        訂艙編號 :".$serial_number."，文件部已提供正確提單及帳單<br>
        請至測試海運網後台接單。<br>"; 
        }elseif($state=="document_check_date"){
        $msg="
        您的訂艙編號".$serial_number."，已經由本公司的文件部人員 ".$staff_array['ename']." 分機#".$staff_array['extension']." 提供提單及帳單，請參閱附件檔案。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>"; 
        }
    }elseif($schedule==4){
        $staff_array=getStaffListId($data_array['financial_staff_id']);
        $msg="
        您的訂艙編號".$serial_number."，已經完成文件核對，後續作業由本公司的財務部人員".$staff_array['ename']." 分機#".$staff_array['extension']." 負責處理。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>"; 
        if($state=="collection_date"){
        $msg="
        您的訂艙編號".$serial_number."，已經由本公司的財務部人員 ".$staff_array['ename']." 分機#".$staff_array['extension']."收到款項。<br>
        如有任何疑問請洽詢(02) 1234-5678<br><br>
        謝謝<br>"; 
        }
    }

    $result.=$contact_msg.$msg."</span>".getBookingOrderInformationTable($data_array,false,"member",true)."</body></html>";
    return $result;
}
/**
 * 1.寄會員審核信的內容
 * 
 * @author Peter Chang
 * 
 * @param integer $pass 為審核的狀態
 * 
 * @param string $pass_message 審核訊息內容
 * 
 * @return string
 */
function getSendMailMemberPassMsg($pass,$pass_message){
    $result="
    <html>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU' crossorigin='anonymous'>
    <body>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ' crossorigin='anonymous'></script>
    <span style='font-family:Microsoft JhengHei;'>";
    if($pass==0){
        $result.="
        收到新註冊會員的通知，<br>
        請至測試海運網後台審核會員資料。<br>";
    }elseif($pass==1){
        $result.="
        親愛的客戶<br><br>
        您好<br><br>
        ".$pass_message."<br>
        歡迎您使用<a href='".getURLLink()."view/index.php'>TEST測試海運網</a>。<br><br>
        如有任何疑問，請聯絡 cs@test.com。<br><br>TEST測試海運網"; 
    }elseif($pass==2){
        $result.="
        親愛的客戶<br><br>
        您好<br><br>
        您的會員註冊審核沒有通過。<br>".$pass_message."<br><br>TEST測試海運網"; 
    }
    $result.="</span></body></html>";
    return $result;
}
/**
 * 1.將emain跟name整理成寄信的陣列
 * 
 * @author Peter Chang
 * 
 * @param string $name 寄件姓名
 * 
 * @param string $email 寄件信箱
 * 
 * @return array
 */
function getSendMailRecipientsArray($name,$email){
    $array=array(array("email"=>$email,"name"=>$name));
    return $array;
}
/**
 * 1.此為訂艙單上傳的路徑
 * 
 * @author Peter Chang
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return string
 */
function getBookingOrderAttachPath($data_array){
    return "../../upload/BookingOrder/".getSerialCombinationStr($data_array)."/";
}
/**
 * 1.此為訂艙單員工上傳檔案的路徑
 * 
 * @author Peter Chang
 * 
 * @param integer $schedule 步驟編碼
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return string|boolean
 */
function getBookingOrderStaffAttachmentPath($schedule,$data_array){
    $path=getBookingOrderAttachPath($data_array);
    if($schedule==2){
        $path.="ProvideSo/";
    }elseif($schedule==3){
        $path.="DocumentCheck/";
    }elseif($schedule==4){
        $path.="Collection/";
    }else{
        return false;
    }
    return $path;
}
/**
 * 1.此為訂艙單寄件Email的判斷該附何檔案
 * 2.會根據不同狀態及步驟編碼會有不同檔案附檔情況
 * 
 * @author Peter Chang
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array 此為資料庫BookingOrder的資料
 * 
 * @return array|boolean
 */
function getBookingOrderSendMailAttachArray($state,$data_array){
    $path=getBookingOrderAttachPath($data_array);
    $staff_path=getBookingOrderStaffAttachmentPath($data_array['schedule'],$data_array);
    $booking_order_shcedule_array=getBookingOrderSchedulePriorityShowArray($data_array);
    $attach=$data_array['attachments'];
    $array=array();
    if($state=="provide_so_pending" && $data_array["so_attachment"]){
        array_push($array,getBookingOrderStaffAttachmentPath(2,$data_array).$data_array["so_attachment"]);
    }
    if($staff_path!== false && $data_array["so_attachment"]){
        $staff_attachment=$booking_order_shcedule_array[$data_array['schedule']]['staff_attachment'];
        if(is_array($staff_attachment)){
            foreach($staff_attachment as $attachment){
                array_push($array,$staff_path.$attachment);
            }
        }else{
            array_push($array,$staff_path.$staff_attachment);
        }
    }
    if($attach && $state!='collection_date'){
        $attachs=explode(";",$attach);
        foreach($attachs as $value){
            array_push($array,$path.$value);
        }
    }
    if(empty($array)){
        return false;
    }
    return $array;
}
?>
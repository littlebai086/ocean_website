<?php


/**
 * 1.資料庫OceanExportPrice 尋找價格用Port Code及櫃型種類id和結關地點id
 * 
 * @author Peter Chang
 * 
 * @param string $quote_route
 * 
 * @return array
 */
function getOceanExportQuoteRoute($quote_route){
  $buf = sqlSelectOceanExportQuoteRoute($quote_route);
  foreach($buf as $row){
    return $row;
  }
}
/**
 * 1.資料庫OceanExportPrice 尋找價格用Port Code及櫃型種類id和結關地點id
 * 
 * @author Peter Chang
 * 
 * @param string $port_code 目的港Port Code
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地點id
 * 
 * @return array
 */
function getOceanExportPricePricePortCodeCabinetVolumeIdCutOffPlaceId($port_code,$cabinet_volume_id,$cut_off_place_id){
  $buf = sqlSelectOceanExportPricePortCodeCabinetVolumeIdCutOffPlaceId($port_code,$cabinet_volume_id,$cut_off_place_id);
  foreach($buf as $row){
    return $row;
  }
}
/**
 * 1.資料庫DgOceanPrice 尋找價格公司id及國家id及櫃型種類id和結關地點id
 * 
 * @author Peter Chang
 * 
 * @param integer $company_id 公司id
 * 
 * @param integer $country_id 國家id
 * 
 * @param integer $cabinet_volume_id 櫃型種類id
 * 
 * @param integer $cut_off_place_id 結關地點id
 * 
 * @return array
 */
function getDgOceanPriceCompanyIdCoutryIdCabinetVolumeIdCutOffPlaceId($company_id,$country_id,$cabinet_volume_id,$cut_off_place_id){
  $buf = sqlSelectDgOceanPriceCompanyIdCoutryIdCabinetVolumeIdCutOffPlaceId($company_id,$country_id,$cabinet_volume_id,$cut_off_place_id);
  foreach($buf as $row){
    return $row;
  }
}
/**
 * 1.資料庫OceanExportPrice 尋找價格PortCode
 * 
 * @author Peter Chang
 * 
 * @param integer $port_code 地區Port Code
 * 
 * @return array
 */
function getOceanExportPricePortCode($port_code){
  $buf = sqlSelectOceanExportPricePortCode($port_code);
  foreach($buf as $row){
    return $row;
  }
}

/**
 * 1.海運出口報價EXCEL上傳的LOCAL CHARGE費用陣列
 * 
 * @author Peter Chang
 * 
 * @return array
 */
function getExcelChargeArray(){
  $charge_arrays=array(
    "bl"=>array("excel_field"=>"B/L","prices"=>array(),"pers"=>array()),
    "cfs"=>array("excel_field"=>"CFS","prices"=>array(),"pers"=>array()),
    "thc"=>array("excel_field"=>"THC","prices"=>array(),"pers"=>array()),
    "seal"=>array("excel_field"=>"SEAL","prices"=>array(),"pers"=>array()),
    "telex_release"=>array("excel_field"=>"TELEX","prices"=>array(),"pers"=>array()),
    "transfer_fee"=>array("excel_field"=>"FOR","prices"=>array(),"pers"=>array(),"remarks"=>array(),"countrys"=>array())
  );
  return $charge_arrays;
}
/**
 * 1.海運出口報價資料庫的LOCAL CHARGE費用存入陣列
 * 
 * @author Peter Chang
 * 
 * @param array $row 資料庫陣列
 * 
 * @return array
 */
function getOceanExportDateDeadlineLocalChargeArray($row){
  if($row["transfer_fee"]){
    $transfer_array=explode(":", $row["transfer_fee"]);
  }else{
    $transfer_array[0]="";
    $transfer_array[1]="";
  }
  
  $charge_arrays=array(
    "b_l"=>array("show"=>"B/L","price"=>explode("|",$row["b_l"]),"per"=>array("PER B/L")),
    "cfs"=>array("show"=>"CFS","price"=>explode("|",$row["cfs"]),"per"=>array("PER CBM")),
    "thc"=>array("show"=>"THC","price"=>explode("|",$row["thc"]),"per"=>array("PER 20'CNTR","PER 40'CNTR","PER 40'HQ")),
    "seal"=>array("show"=>"SEAL","price"=>explode("|",$row["seal"]),"per"=>array("PER CNTR")),
    "telex_release"=>array("show"=>"TELEX RELEASE","price"=>explode("|",$row["telex_release"]),"per"=>array("PER B/L")),
    "transfer_fee"=>array("show"=>$transfer_array[0],"price"=>explode("|",$transfer_array[1]),"per"=>array("PER B/L"),"remark"=>$row["transfer_fee_remark"],"countrys"=>explode("|",$row["transfer_fee_country"]))
  );
  return $charge_arrays;
}
/**
 * 1.員工後台海運出口報價表資訊顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param boolean|integer $start 第幾筆開始
 * 
 * @param boolean|integer $per 顯示筆數
 * 
 * @return string
 */
function getStaffMemberOceanExportListSearchTable(){
  $items=array("quote_route","attachment");
  $table="";
  $buf=sqlSelectOceanExportList();
  foreach ($buf as $key=>$row){
    $table.="<tr>";
    $table.="<td>".($key+1)."</td>";
    foreach ($items as $item){
      $table.="<td>".$row[$item]."</td>";
    }
    $table.="<td>
      <input type='button' value='修改資訊' class='btn btn-secondary' onclick=\"location.href='./OceanExportQuote.php?state=update&id=".$row['ocean_export_id']."'\">
      <input type='button' value='上傳EXCEL報價' class='btn btn-secondary' onclick=\"location.href='./OceanExportQuoteUploadExcel.php?state=upload_excel&id=".$row['ocean_export_id']."'\">
       <input type='button' value='報價價格' class='btn btn-secondary' onclick=\"location.href='./OceanExportQuotePriceList.php?ocean_export_id=".$row['ocean_export_id']."'\">
       
      ";
    
    $table.="</td></tr>";
  }
  return $table;
}

/**
 * 1.員工後台海運出口單個目的港報價價格表資訊顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return string
 */
function getStaffOceanExportPriceListCutOffPlaceTable($destination_port_id,$cut_off_place_id){
  $table="";
  $row = getOceanExportDateDeadlineDestinationPortId($destination_port_id,'CY');
  $start_date=$row['start_date'];
  $end_date=$row['end_date'];
  $buf = sqlSelectOceanExportPriceDestinationPortIdCutOffId($destination_port_id,$cut_off_place_id);
  $cabinet_volumes=getCabinetVolumeArray();
  $cabinet_volume_count=count($cabinet_volumes);
  $cut_off_place=getCutOffPlaceId($cut_off_place_id);
  $cut_off_place_count=count($cut_off_place);
  if($row["ocean_export_additional_link"]==1){
    $filenames=explode(";",$row["ocean_export_additional_href"]);
    $table.="<div class='col'>
              <h3 class='mb-3 fw-normal'>內陸費用下載</h3>
            </div>";
    foreach($filenames as $filename){
      $show_name=explode(".",$filename);
      $table.="
      <div class='col'>
        <h4 class='mb-3 fw-normal'>
        <a download href='../../upload/OceanExportQuoteAdditional/".$filename."')'>印度內陸點</a>
        <h4 class='mb-3 fw-normal'>
      </div>";
    }
  }
  $table.="
  <table class='table table-bordered table-success table-hover caption-color-dark caption-top'>
  <caption style='font-size: 16px;font-weight:bold;color:red;'>運價有效期限：".$start_date."~".$end_date."</caption>
    <tr>
      <td rowspan='2' class='align-middle text-center'>國家</td>
      <td rowspan='2' class='align-middle text-center'>POD</td>";
      $table.="<td colspan='".$cabinet_volume_count."' class='text-center'>".$cut_off_place["cut_off_place_english_abbreviation"]."</td>";
      $table.="
    </tr>
    <tr>
      ";
      foreach($cabinet_volumes as $cabinet_volume){
        $table.="<td>".$cabinet_volume["table_name"]."</td>";
      }
      $table.="
      
    </tr>";
  
  foreach ($buf as $key=>$row){
    if($row["ocean_export_price"]===NULL){
      $price="X";
    }elseif($row["ocean_export_price"]==0){
      $price=0;
    }else{
      $price=getOceanExportPriceCommonValuation($row["ocean_export_price"]);
    }
    if($key==0 || $key%($cabinet_volume_count*$cut_off_place_count)==0){
      $table.="<tr>";
      $table.="<td>".$row["country_english"]."</td>";
      $table.="<td>".$row["destination_port_english"]."</td>";
      $table.="<td>".$price."</td>";
    }elseif($key%($cabinet_volume_count*$cut_off_place_count)==($cabinet_volume_count*$cut_off_place_count-1)){
      $table.="<td>".$price."</td>";
      $table.="</tr>";
    }else{
      $table.="<td>".$price."</td>";
    }
  }
  $table.="<table>";
  return $table;
}

/**
 * 1.員工後台海運出口報價價格表資訊顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return string
 */
function getStaffOceanExportPriceListTable($ocean_export_id){
  $buf=sqlSelectOceanExportPriceOceanExportIdList($ocean_export_id);
  $cabinet_volumes=getCabinetVolumeArray();
  $cabinet_volume_count=count($cabinet_volumes);
  $cut_off_places=sqlSelectCutOffPlaceOrderByCutOffPlaceIdDesc();
  $cut_off_place_count=count($cut_off_places);
  $table="
    <tr>
      <td rowspan='2' class='align-middle text-center'>國家</td>
      <td rowspan='2' class='align-middle text-center'>POD</td>
      <td rowspan='2' class='align-middle text-center'>PORT CODE</td>";
      foreach($cut_off_places as $cut_off_place){
        $table.="<td colspan='".$cabinet_volume_count."' class='text-center'>".$cut_off_place["cut_off_place_english_abbreviation"]."</td>";
      }
      $table.="
    </tr>
    <tr>
      ";
      foreach($cut_off_places as $cut_off_place){
        foreach($cabinet_volumes as $cabinet_volume){
          $table.="<td>".$cabinet_volume["table_name"]."</td>";
        }
      }
      $table.="
      
    </tr>";
  
  foreach ($buf as $key=>$row){
    $price=number_format($row["ocean_export_price"]);
    if($key==0 || $key%($cabinet_volume_count*$cut_off_place_count)==0){
      $table.="<tr>";
      $table.="<td>".$row["country_english"]."</td>";
      $table.="<td>".$row["destination_port_english"]."</td>";
      $table.="<td>".$row["port_code"]."</td>";
      $table.="<td>".$price."</td>";
    }elseif($key%($cabinet_volume_count*$cut_off_place_count)==($cabinet_volume_count*$cut_off_place_count-1)){
      $table.="<td>".$price."</td>";
      $table.="</tr>";
    }else{
      $table.="<td>".$price."</td>";
    }
  }
  return $table;
}

/**
 * 1.海運出口報價LOCAL CHAREGE資訊
 * 
 * @author Peter Chang
 * 
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return string
 */
function getOceanExportPriceLocalChargeTable($destination_port_id,$shipment_type){
  $row = getOceanExportDateDeadlineDestinationPortId($destination_port_id,$shipment_type);
  $charge_arrays=getOceanExportDateDeadlineLocalChargeArray($row);
  $table="
  <table class='table table-bordered table-success table-hover caption-color-dark caption-top'>
  <caption style='font-size: 16px;font-weight:bold;'>LOCAL CHARAGE</caption>";
  foreach($charge_arrays as $key=>$charge_array){
    $remark_boolean=false;
    $country_all=false;
    if(isset($charge_array["remark"]) && $key=="transfer_fee"){
      if(strtolower(implode(";",$charge_array["countrys"]))=="all"){
        $country_all=true;
        break;
      }
      for($i=0;$i<count($charge_array["price"]);$i++){
        $country_ids=explode(";",$charge_array["countrys"][$i]);
        foreach($country_ids as $country_id){
          if($country_id == $row["country_id"]){
            $remark_boolean=true;
            break;
          }
        }
      }
    }
  }
  foreach($charge_arrays as $key=>$charge_array){
    if(isset($charge_array["remark"])){$remark=$charge_array["remark"];}else{$remark="";}
    for($i=0;$i<count($charge_array["price"]);$i++){
      if($i==0){$show=$charge_array["show"];}else{$show="";}
      if(isset($charge_array["per"][$i])){$per=$charge_array["per"][$i];}else{$per="";}
      if((($remark_boolean===false && $key!="transfer_fee") || ($remark_boolean===true) || ($country_all===true)) && $charge_array["price"][$i]){
        $table.="<tr>
              <td class='align-middle text-start'>".$show."</td>
              <td class='align-middle text-start'>".$charge_array["price"][$i]."</td>
              <td class='align-middle text-start'>".$per."</td>";
        if($remark_boolean && $key=="transfer_fee" && $country_all===false){
          $country_ids=explode(";",$charge_array["countrys"][$i]);
          foreach($country_ids as $country_id){
            if($country_id == $row["country_id"]){
              $table.="<td class='align-middle text-start'>".$remark."</td>";
              break;
            }
          }
        }elseif($remark_boolean && $country_all===false){
          $table.="<td>".$remark."</td>";
        }
        $table.="</tr>";
      }
    }
  }
  
  $table.="</table>";
  return $table;
}
/**
 * 1.員工後台新增或修改海運報價的Form表單
 * 
 * @author Peter Chang
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array 為資料庫OceanExport的資料
 * 
 * @return string
 */
function getStaffOceanExportForm($state,$data_array){
  $result="";
  $result.="
  <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputChineseName' class='control-label'>海運報價航線</label>
        </div>
        <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' id='inputOceanQuoteRoute' name='quote_route' placeholder='請填寫英文' value='".$data_array['quote_route']."' required='required'  >
        </div>
    </div>";
    if($data_array['ocean_export_additional_link']==1){
      $result.="
    <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputELastName' class='control-label'>額外連結附檔</label>
        </div>
        <div class='col col-lg-2'>
          <input type='file'  class='form-control' name='attachments[]' id='inputAttachment' multiple>
        </div>
    </div>";
    }

    return $result;
}
/**
 * 1.員工後台新增或修改海運報價的Form表單
 * 
 * @author Peter Chang
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array 為資料庫OceanExport的資料
 * 
 * @return string
 */
function getStaffOceanExportPriceExcelUploadForm($state,$data_array){
  $result="";
  $result.="
  <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputChineseName' class='control-label'>海運報價航線</label>
        </div>
        <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' id='inputOceanQuoteRoute' name='quote_route' value='".$data_array['quote_route']."' required='required' readonly='readonly'  >
        </div>
    </div>
    <div class='row'>
        <div class='col col-lg-4'>
        </div>  
        <div class='col col-lg-1 d-flex align-items-center'>
          <label for='inputELastName' class='control-label'>附檔</label>
        </div>
        <div class='col col-lg-2'>
          <input type='file'  class='form-control'name='attachment' id='inputAttachment' required='required'>
        </div>
    </div>";
    return $result;
}
/**
 * 1.員工後台海運報價將EXCEL結關地點轉成陣列
 * 
 * @author Peter Chang
 * 
 * @param array $excel_array 為海運報價EXCEL的資料
 * 
 * @return string
 */
function getOceanExportQuotEexcelToCutOffPlaceArray($excel_array){
  $buf=sqlSelectCutOffPlace();
  $cut_off_array=array();
  foreach($buf as $key=>$row){
    foreach ($excel_array as $key2=>$value){
      if(strpos($value,$row['cut_off_place_english_abbreviation'])!==false){
        $cut_off_array[$key]=array("excel_field"=>$key2,"cut_off_place_id"=>$row['cut_off_place_id']);
      }
    }
  }
  sort($cut_off_array);
  return $cut_off_array;
}
/**
 * 1.員工後台海運報價將EXCEL櫃型種類轉成陣列
 * 
 * @author Peter Chang
 * 
 * @param array $excel_array 為海運報價EXCEL的資料
 * 
 * @return string
 */
function getOceanExportQuotEexcelToCabinetVolumeArray($excel_array){
  $buf=sqlSelectCabinetVolumeNotDel();
  $cabinet_volume_array=array();
  foreach($buf as $key=>$row){
    foreach ($excel_array as $key2=>$value){
      $row['table_name']=str_replace(" ", "",$row['table_name']);
      $value=str_replace(" ", "",$value);
      if(strpos($value,$row['table_name'])!==false){
        $cabinet_volume_array[$key]=array("excel_field"=>$key2,"cabinet_volume_id"=>$row['cabinet_volume_id']);
        break;
      }
    }
  }
  sort($cabinet_volume_array);
  return $cabinet_volume_array;
}
/**
 * 1.員工後台海運報價共用判斷
 * 
 * @author Peter Chang
 * 
 * @param array $array 為單行ExcelArray
 * 
 * @param string $country 國家英文名稱
 * 
 * @param string $port_code Port Code
 * 
 * @return array(boolean,string,string,integer||boolean,intrger||boolean)
 */
function getOceanPriceQuoteExcelCommonReturn($id,$array,$country,$port_code){
  $msg="";
  $country_array=getCountryCountryEnglish($country);
  if(!$country_array){
    $msg.= "國家:".$country."<br>";
    $msg.= "目的港:".$array[1]."<br>";
    $msg.= "無此國家<br>";
    return array(false,$msg,$country,false,false);
  }
  $country_id=$country_array["country_id"];
  if($array[0] && $country!=$array[0]){
    // $country=addslashes($array[0]);
    // $country=str_replace("\r","",$country);
    if(!sqlUpdateCountryOceanExportId($country_id,$id)){
      return array(false,"海運出口ID修改發生錯誤",$country,false,false);
    }
  }
  $destination_port_array=getDestinationPortCountryEnglishDestinationPortEnglish($country,$array[1]);
  if(!$destination_port_array){
    $msg.= "國家ID:".$country_id."<br>";
    $msg.= "目的港:".$array[1]."<br>";
    $msg.= "無此目的港<br>";
    return array(false,$msg,$country,false,false);
  }
  $destination_port_id=$destination_port_array["destination_port_id"];
  if(!sqlUpdateDestinationPortDestinationPortNotDel($destination_port_id,$port_code)){
    return array(false,"目的港修改成未刪除發生錯誤",$country,false,false);
  }
  return array(true,"正確",$country,$country_id,$destination_port_id);
}

/**
 * 1.員工後台海運報價價格新增
 * 
 * @author Peter Chang
 * 
 * @param integer $id 海運報價id資料
 * 
 * @param array $array 為單行ExcelArray
 * 
 * @param array $destination_port_array 目的港陣列
 * 
 * @param array $cut_off_array 結關地點陣列
 * 
 * @param array $cabinet_volume_array 櫃型種類陣列
 * 
 * @return string
 */
function getOceanExportQuoteEexcelInsertOceanExportPrice($id,$array,$destination_port_id,$cut_off_array,$cabinet_volume_array){
  $cabinet_volume_num=$cabinet_volume_array[1]["excel_field"]-$cabinet_volume_array[0]["excel_field"];
  foreach($cut_off_array as $key2=>$cut_offs){
    foreach($cabinet_volume_array as $key3=>$cabinet_volumes){
      $price_key=$cut_offs["excel_field"]+$cabinet_volume_num*$key3;
      $company_key=$price_key+1;
      if(strtoupper(trim($array[$price_key]))=="X"){
        $company_array["company_id"]=0;
        $array[$price_key]=NULL;
      }else{
        $company_array=getCompanyCompanyAbbreviation($array[$company_key]);
      }
      if($company_array){
        if(sqlInsertOceanExportPrice($id,$destination_port_id,$cabinet_volumes['cabinet_volume_id'],$cut_offs['cut_off_place_id'],$array[$price_key],$company_array["company_id"])){
          "新增成功";
        }else{
          echo "OceanExportPrice資料庫SQL新增失敗";
          return false;
        }
      }else{
        echo "無此船公司:".$array[$company_key]."";
        return false;
      } 
    }
  }
  return true;
}
/**
 * 1.員工後台海運報價價格新增
 * 
 * @author Peter Chang
 * 
 * @param array $array 為單行ExcelArray
 * 
 * @param array $cut_off_array 結關地點陣列
 * 
 * @param array $cabinet_volume_array 櫃型種類陣列
 * 
 * @return string
 */
function getOceanExportQuoteEexcelNotPrice($array,$cut_off_array,$cabinet_volume_array){
  $cabinet_volume_num=$cabinet_volume_array[1]["excel_field"]-$cabinet_volume_array[0]["excel_field"];
  foreach($cut_off_array as $key2=>$cut_offs){
    foreach($cabinet_volume_array as $key3=>$cabinet_volumes){
      $price_key=$cut_offs["excel_field"]+$cabinet_volume_num*$key3;
      if($array[$price_key]>0 && is_numeric($array[$price_key])){
        return true;
      }
    }
  }
  return false;
}
/**
 * 1.員工後台海運報價EXCEL上傳
 * 
 * @author Peter Chang
 * 
 * @param integer $id 為海運報價id
 * 
 * @param array $excel_array 為海運報價EXCEL的資料
 * 
 * @return array(boolean,string)
 */
function getOceanExportQuoteEexcelArrayUploadDatabaseReturn($id,$price_start_field,$cut_off_array,$cabinet_volume_array,$excel_array){
  $msg="";
  $country="";
  if(sqlDeleteOceanExportPriceOceanExportId($id)){
    "刪除成功";
  }else{
    return array(false,"刪除失敗",false);
  }
  foreach($excel_array as $key=>$array){
    if($key>=$price_start_field){
      if($array[1]){$array[1]=trim($array[1]);}else{break;}
      if($array[0] && $country!=$array[0]){
        $country=addslashes($array[0]);
        $country=str_replace("\r","",$country);
      }
      if(!getOceanExportQuoteEexcelNotPrice($array,$cut_off_array,$cabinet_volume_array)){
        continue;
      }
      $port_code=trim($array[2]);
      list($result,$msg,$country,$country_id,$destination_port_id)=getOceanPriceQuoteExcelCommonReturn($id,$array,$country,$port_code);
      if(!$result){
        return array(false,$msg,$key);
      }
      if(!getOceanExportQuoteEexcelInsertOceanExportPrice($id,$array,$destination_port_id,$cut_off_array,$cabinet_volume_array)){
        return array(false,"報價新增失敗",$key);
      }
    }
  }
  return array(true,"成功",$key);
}
// /**
//  * 1.員工後台海運報價EXCEL上傳
//  * 
//  * @author Peter Chang
//  * 
//  * @param integer $id 為海運報價id
//  * 
//  * @param array $excel_array 為海運報價EXCEL的資料
//  * 
//  * @param string $select 為選擇狀態會有不同選擇
//  * 
//  * @return array(boolean,string)
//  */
// function getOceanExportQuoteEexcelArrayUploadDatabaseReturn($id,$price_start_field,$cut_off_array,$cabinet_volume_array,$excel_array,$select){
//   $msg="";
//   $country="";
//   if($select=="quote_price"){
//     if(sqlDeleteOceanExportPriceOceanExportId($id)){
//       "刪除成功";
//     }else{
//       return array(false,"刪除失敗",false);
//     }
//   }
//   foreach($excel_array as $key=>$array){
//     if($key>=$price_start_field){
//       if($array[1]){$array[1]=trim($array[1]);}else{break;}
//       if(!getOceanExportQuoteEexcelNotPrice($array,$cut_off_array,$cabinet_volume_array)){
//         continue;
//       }
//       $port_code=trim($array[2]);
//       if($array[0] && $country!=$array[0]){
//         $country=addslashes($array[0]);
//         $country=str_replace("\r","",$country);
//         $country_array=getCountryCountryEnglish($country);
//         if($country_array){
//           $country_id=$country_array["country_id"];
//           $destination_port_array=getDestinationPortCountryEnglishDestinationPortEnglish($country,$array[1]);
//           if(!$destination_port_array){
//               $msg.= "國家ID:".$country_id."<br>";
//               $msg.= "目的港:".$array[1]."<br>";
//               $msg.= "無此目的港<br>";
//               return array(false,$msg,$key);
//           }
//           $destination_port_id=$destination_port_array["destination_port_id"];
//           if($select=="quote_price"){
//             if(!getOceanExportQuoteEexcelInsertOceanExportPrice($id,$array,$destination_port_array,$cut_off_array,$cabinet_volume_array)){
//               return array(false,"報價新增失敗",$key);
//             }
//           }elseif($select=="upload_country"){
//             if(sqlUpdateCountryOceanExportId($country_id,$id)){
//               if(sqlUpdateDestinationPortDestinationPortDelDelete($country_id)){
//                 if(sqlUpdateDestinationPortDestinationPortNotDel($destination_port_id,$port_code)){
//                   "成功修改為未刪除";
//                 }else{
//                   $msg.="修改失敗";
//                   return array(false,$msg,$key);
//                 }
//               }
//             }
//           }
//         }else{
//           $msg.= "KEY:".$key."<br>";
//           $msg.= "國家:".$country."<br>";
//           $msg.= "目的港:".$array[1]."<br>";
//           $msg.= "無此國家<br>";
//           return array(false,$msg,$key);
//         }
//       }else{
//         $destination_port_array=getDestinationPortCountryEnglishDestinationPortEnglish($country,$array[1]);
//         if(!$destination_port_array){
//               $msg.= "國家ID:".$country_id."<br>";
//               $msg.= "目的港:".$array[1]."<br>";
//               $msg.= "無此目的港<br>";
//               return array(false,$msg,$key);
//         }elseif($destination_port_array && $select=="upload_country"){
//           $destination_port_id=$destination_port_array["destination_port_id"];
//           if(sqlUpdateDestinationPortDestinationPortNotDel($destination_port_id,$port_code)){
//             "成功修改為未刪除";
//           }
//         }elseif($destination_port_array && $select=="quote_price"){
//           if(!getOceanExportQuoteEexcelInsertOceanExportPrice($id,$array,$destination_port_array,$cut_off_array,$cabinet_volume_array)){
//               return array(false,"報價新增失敗",$key);
//           }
//         }
//       }
//     }
//   }
//   return array(true,"成功",$key);
// }

/**
 * 1.員工後台海運報價EXCEL上傳
 * 
 * @author Peter Chang
 * 
 * @param integer $id 為海運報價id
 * 
 * @param array $excel_array 為海運報價EXCEL的資料
 * 
 * @param string $select 為選擇狀態會有不同選擇
 * 
 * @return array(boolean,string)
 */
function getDGOceanQuoteEexcelArrayUploadDGDatabaseReturn($id,$excel_array,$price_start_field){
  $msg="";
  $cut_off_array=sqlSelectCutOffPlaceOrderByCutOffPlaceIdDesc();
  if(sqlDeleteDgOceanPriceOceanExportId($id)){
    "刪除成功";
  }else{
    return array(false,"刪除失敗");
  }
  $company="";
  foreach($excel_array as $key=>$array){
    if($key>=$price_start_field && $array[3]){
      $array[0]=trim($array[0]);
      if($array[0]!=$company){
        $country_ids=array();
      }else{
        $company=$array[0];
      }
      $company_array=getCompanyCompanyAbbreviation(trim($array[0]));
      $country=strtoupper(trim($array[1]));
      $price=trim($array[3]);
      $cabinet_volume=str_replace(" ","",trim($array[4]));
      if(strtoupper($country)=="ALL"){
        $country_buf=sqlSelectOceanExportInnerCountryDestinationPortOceanExportId($id);
      }elseif(strtoupper($country)=="OTHER"){
        $country_buf=sqlSelectOceanExportInnerCountryDestinationPortOceanExportIdCountryId($id,$country_ids);
      }else{
        $country_buf=sqlSelectCountryCountryEnglish($country);
        foreach($country_buf as $country_array){
          array_push($country_ids,$country_array['country_id']);
        }
      }
      $cabinet_volume_array=getTableNameCabinetVolumeNotDel(addslashes($cabinet_volume));
      if(!$country_buf){
        $msg.= "國家:".$country."<br>";
        $msg.= "無此國家<br>";
        return array(false,$msg);
      }
      if(!$cabinet_volume_array){
        $msg.= "櫃型種類:".$cabinet_volume."<br>";
        $msg.= "無此櫃型<br>";
        return array(false,$msg);
      }
      if(!$company_array){
        $msg.= "船公司:".trim($array[0])."<br>";
        $msg.= "無此船公司<br>";
        return array(false,$msg);
      }

      foreach($country_buf as $country_array){
        foreach($cut_off_array as $cut_off_places){
          if(!sqlInsertDgOceanPrice($id,$company_array['company_id'],$country_array['country_id'],$cabinet_volume_array['cabinet_volume_id'],$cut_off_places['cut_off_place_id'],$price)){
            $msg.= "新增失敗<br>";
            return array(false,$msg);
          }
        }
        
      }
    }
  }
  return array(true,"成功");
}

/**
 * 1.員工後台海運報價EXCEL期限跟LOCAL CHARGES費用上傳
 * 
 * @author Peter Chang
 * 
 * @param integer $key 為EXCEL的第幾列
 * 
 * @param array $excel_array 為海運報價EXCEL的資料
 * 
 * @return array(boolean,string)
 */
function getOceanExportQuoteEexcelArrayChargeArrayReturn($key,$excel_array){
  $charge_arrays=getExcelChargeArray();
  $charge_copy=getExcelChargeArray();
  $local_charge_start_field=$key+1;
  for($i=$local_charge_start_field;$i<count($excel_array);$i++){
    $array=$excel_array[$i];
    if($array[1]){$array[1]=trim($array[1]);}else{break;}
    if(trim($array[0])){$fee=trim($array[0]);}
    $price=trim($array[1]);
    $charge_show=$price;
    $per_show=trim($array[2]);
    foreach($charge_copy as $charge_key => $charge_array){
      if(strpos(strtoupper($fee),$charge_array["excel_field"])!==false ||
        strpos(strtoupper(trim($array[3])),$charge_array["excel_field"])!==false){
        if(strpos(strtoupper(trim($array[3])),$charge_array["excel_field"])!==false){
          $charge_show=$fee.":".$price;
          array_push($charge_arrays[$charge_key]["remarks"],$array[3]);
          if(strpos(strtoupper(trim($array[3])),"ALL")!==false){
            $country_ids=array("all");
          }else{
            $countrys=explode(" ",$array[3]);
            $country_ids=array();
            foreach($countrys as $country){
              $country_array=getCountryCountryEnglish($country);
              if($country_array){
                array_push($country_ids,$country_array["country_id"]);
              }
            }
          }
          array_push($charge_arrays[$charge_key]["countrys"],implode(";",$country_ids));
        }
        array_push($charge_arrays[$charge_key]["prices"],$charge_show);
        array_push($charge_arrays[$charge_key]["pers"],$per_show);
        break;
      }
    }
  }
  $fields=array(
    array("array"=>"prices","str"=>"price"),
    array("array"=>"pers","str"=>"per"),
    array("array"=>"remarks","str"=>"remark"),
    array("array"=>"countrys","str"=>"country"));
  foreach($charge_arrays as $key=>$charge_array){
    foreach($fields as $array){
      if(isset($charge_array[$array["array"]])){
        $charge_arrays[$key][$array["str"]]=implode("|",$charge_array[$array["array"]]);
      }
    }
  }
  return $charge_arrays;
}

?>
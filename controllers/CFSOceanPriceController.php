<?php
/**
 * 1.為併櫃海運航線的選單選項
 *
 * @author Peter Chang
 * 
 * @param integer $id 為國家預設值
 * 
 * @return string
 */
function getCFSOceanPriceOceanOptionQuoteRouteValueExportOptionId($id){
    $result="";
    $buf=sqlSelectCFSOceanPriceQuoteRoute();
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
function getCFSOceanQuoteEexcelNotPrice($array,$cut_off_array){
  foreach($cut_off_array as $key2=>$cut_offs){
    $price_key=$cut_offs["excel_field"];
    if(is_numeric($array[$price_key])){
      return true;
    }
  }
  return false;
}
/**
 * 1.員工後台併櫃海運報價價格新增
 * 
 * @author Peter Chang
 * 
 * @param integer $id 海運報價id資料
 * 
 * @param array $array 為單行ExcelArray
 * 
 * @param array $destination_port_id 目的港id
 * 
 * @param array $cut_off_array 結關地點陣列
 * 
 * @return boolean
 */
function getCFSOceanPriceQuoteEexcelInsertCFSOceanPrice($id,$array,$destination_port_id,$cut_off_array){
  foreach($cut_off_array as $key2=>$cut_offs){
    $price_key=$cut_offs["excel_field"];
    if(strtolower($array[$price_key])=="x"){$price="NULL";}else{$price=$array[$price_key];}
    if(sqlInsertCFSOceanPrice($id,$destination_port_id,$cut_offs['cut_off_place_id'],$price)){
      "新增成功";
    }else{
      echo "CFSOceanPrice資料庫SQL新增失敗";
      return false;
    }
  }
  return true;
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
function getCFSOceanPriceQuoteEexcelArrayUploadDatabaseReturn($id,$price_start_field,$cut_off_array,$excel_array){
  $msg="";
  $country="";
  if(sqlDeleteCFSOceanPrice($id)){
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
      if(!getCFSOceanQuoteEexcelNotPrice($array,$cut_off_array)){
        continue;
      }
      $port_code=trim($array[2]);
      list($result,$msg,$country,$country_id,$destination_port_id)=getOceanPriceQuoteExcelCommonReturn($id,$array,$country,$port_code);
      if(!$result){
        return array(false,$msg,$key);
      }
      if(!getCFSOceanPriceQuoteEexcelInsertCFSOceanPrice($id,$array,$destination_port_id,$cut_off_array)){
        return array(false,"報價新增失敗",$key);
      }
    }
  }
  return array(true,"成功",$key);
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
function getStaffMemberCFSOceanExportListSearchTable(){
  $items=array("quote_route");
  $table="";
  $buf=sqlSelectOceanExportList();
  foreach ($buf as $key=>$row){
    $table.="<tr>";
    $table.="<td>".($key+1)."</td>";
    foreach ($items as $item){
      $table.="<td>".$row[$item]."</td>";
    }
    $table.="<td>
      <input type='button' value='上傳EXCEL併櫃報價' class='btn btn-secondary' onclick=\"location.href='./CFSOceanQuoteUploadExcel.php?state=upload_excel&id=".$row['ocean_export_id']."'\">
       <input type='button' value='併櫃報價價格' class='btn btn-secondary' onclick=\"location.href='./CFSOceanQuotePriceList.php?ocean_export_id=".$row['ocean_export_id']."'\">
      ";
    $table.="</td></tr>";
  }
  return $table;
}
/**
 * 1.員工後台海運併櫃出口單個目的港報價價格表資訊顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param integer $ocean_export_id 海運報價id
 * 
 * @return string
 */
function getStaffCFSOceanPriceListCutOffPlaceTable($destination_port_id,$cut_off_place_id){
  $table="";
  $row = getOceanExportDateDeadlineDestinationPortId($destination_port_id,'CFS');
  $start_date=$row['start_date'];
  $end_date=$row['end_date'];
  $buf = sqlSelectCFSOceanPriceDestinationPortIdCutOffId($destination_port_id,$cut_off_place_id);
  $cut_off_place=getCutOffPlaceId($cut_off_place_id);
  $cut_off_place_count=count($cut_off_place);
  $table.="
  <table class='table table-bordered table-success table-hover caption-color-dark caption-top'>
  <caption style='font-size: 16px;font-weight:bold;color:red;'>運價有效期限：".$start_date."~".$end_date."</caption>
    <tr>
      <td class='align-middle text-center'>國家</td>
      <td class='align-middle text-center'>POD</td>";
      $table.="<td class='text-center'>".$cut_off_place["cut_off_place_english_abbreviation"]."</td>";
      $table.="
    </tr>";
  
  foreach ($buf as $key=>$row){
    if($row["cfs_ocean_price"]===NULL){
      $price="X";
    }elseif($row["cfs_ocean_price"]<0){
      $price="0 PER CBM";
    }else{
      $price=getOceanExportPriceCommonValuation($row["cfs_ocean_price"])." PER CBM";
    }
    if($key==0 || $key%$cut_off_place_count==0){
      $table.="<tr>";
      $table.="<td>".$row["country_english"]."</td>";
      $table.="<td>".$row["destination_port_english"]."</td>";
      $table.="<td>".$price."</td>";
    }elseif($key%$cut_off_place_count==($cut_off_place_count-1)){
      $table.="<td>".$price."</td>";
      $table.="</tr>";
    }else{
      $table.="<td>".$price."</td>";
    }
  }
  $table.="<table>";
  $table.="
  <div class='col'>
    <p class='text-danger'><b>打X代表沒開櫃</b></p>
  </div>";
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
function getStaffCFSOceanPricePriceListTable($ocean_export_id){
  $buf=sqlSelectCFSOceanPriceCFSOceanPriceIdList($ocean_export_id);
  $cut_off_places=sqlSelectCutOffPlaceOrderByCutOffPlaceIdDesc();
  $cut_off_place_count=count($cut_off_places);
  $table="
    <tr>
      <td class='align-middle text-center'>國家</td>
      <td class='align-middle text-center'>POD</td>
      <td class='align-middle text-center'>PORT CODE</td>";
      foreach($cut_off_places as $cut_off_place){
        $table.="<td class='text-center'>".$cut_off_place["cut_off_place_english_abbreviation"]."</td>";
      }
      $table.="
    </tr>";

  foreach ($buf as $key=>$row){
    if($row["cfs_ocean_price"]===NULL){
      $price="x";
    }elseif($row["cfs_ocean_price"]<0){
      $price=0;
    }else{
      $price=number_format($row["cfs_ocean_price"]);
    }
    if($key==0 || $key%$cut_off_place_count==0){
      $table.="<tr>";
      $table.="<td>".$row["country_english"]."</td>";
      $table.="<td>".$row["destination_port_english"]."</td>";
      $table.="<td>".$row["port_code"]."</td>";
      $table.="<td>".$price."</td>";
    }elseif($key%$cut_off_place_count==($cut_off_place_count-1)){
      $table.="<td>".$price."</td>";
      $table.="</tr>";
    }else{
      $table.="<td>".$price."</td>";
    }
  }
  return $table;
}
?>
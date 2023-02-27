<?php
/**
 * 1.資料庫ShippingCompanyFeesAfr 尋找價格用船公司報價費用id和櫃量id
 * 
 * @author Peter Chang
 *
 * @param integer $shipping_company_fees_id 船公司報價費用id
 * 
 * @param integer $ocean_export_id 地區id
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function getShippingCompanyFeesAfrShippingCompanyFeesIdOceanExportIdCountryId($shipping_company_fees_id,$ocean_export_id,$country_id){
  $buf = sqlSelectShippingCompanyFeesAfrShippingCompanyFeesIdOceanExportIdCountryId($shipping_company_fees_id,$ocean_export_id,$country_id);
  foreach($buf AS $row){
    return $row;
  }
}
/**
 * 1.資料庫ShippingCompanyFeesThc 尋找價格用船公司報價費用id和櫃量id
 * 
 * @author Peter Chang
 *
 * @param integer $shipping_company_fees_id 船公司報價費用id
 * 
 * @param integer $cabinet_volume_id 櫃量id
 * 
 * @return array
 */
function getShippingCompanyFeesThcShippingCompanyFeesIdCabinetVolumeId($shipping_company_fees_id,$cabinet_volume_id){
  $buf = sqlSelectShippingCompanyFeesThcShippingCompanyFeesIdCabinetVolumeId($shipping_company_fees_id,$cabinet_volume_id);
  foreach($buf AS $row){
    return $row;
  }
}
/**
 * 1.資料庫OceanExportPrice 尋找價格用Port Code及櫃型種類id和結關地點id
 * 
 * @author Peter Chang
 *
 * @param integer $ocean_export_id 地區id
 * 
 * @param integer $company_id 公司id
 * 
 * @return array
 */
function getShippingCompanyFeesOceanExportIdCompanyId($ocean_export_id,$company_id){
  $buf = sqlSelectShippingCompanyFeesOceanExportIdCompanyId($ocean_export_id,$company_id);
  foreach($buf AS $row){
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
function getShippingCompanyFeesArrayInsertSQL($excel_array,$cabinet_volume_array){
  $start_data_key=2;
  $company_key=0;
  $b_l_key=1;
  $seal_key=5;
  $telex_release_key=6;
  $afr_key=7;
  $afr_country_key=8;

  foreach($excel_array AS $key=>$array){
    $company_id=false;
    $b_l=false;
    $seal=false;
    $telex_release=false;
    $b_l=false;
    $afr=false;
    $countrys=false;
    if($key==0){
      $quote_route=trim($array[0]);
      $row=getOceanExportQuoteRoute($quote_route);
      if($row){
        $ocean_export_id=$row["ocean_export_id"];
        continue;
      }
      return false;
    }elseif($key>=$start_data_key){
      foreach($array AS $key2=>$value){
        $value=strtolower(trim($value));
        if($company_key==$key2){
          $company_field=$key2;
          if($value==""){
            continue;
          }
          $company_array=getCompanyCompanyAbbreviation(strtoupper($value));
          if($company_array){
            $company_id=$company_array["company_id"];
          }else{
            echo $value."無此船公司<br>";
            return false;
          }
          
        }elseif($b_l_key==$key2){
          $b_l=intval($value);
        }elseif($seal_key==$key2){
          $seal=intval($value);
        }elseif($telex_release_key==$key2){
          $telex_release=intval($value);
        }elseif($afr_key==$key2){
          if($value!="x"){
            if(strpos($value,"usd")!==false){
              $currency="usd";
              $afr=intval(str_replace($currency, "", $value));
            }else{
              $currency="twd";
              $afr=intval($value);
            }
          }
        }elseif($afr_country_key==$key2){
          if($value!="x"){
            if($value=="all"){
              $countrys=true;
            }else{
              $countrys=explode("&",$value);
            }
          }
        }
      }
    }
    if($company_id){
      $id=sqlInsertShippingCompanyFees($ocean_export_id,$company_id,$b_l,$seal,$telex_release);
      if($id){
        foreach($cabinet_volume_array AS $cabinet_volumes){
          if(sqlInsertShippingCompanyFeesThc($id,$cabinet_volumes["cabinet_volume_id"],$array[$cabinet_volumes["excel_field"]])){
            "新增成功THC費用<br>";
          }else{
            echo "新增失敗THC費用<br>";
            return false;
          }
        }
        if($afr!==false && $countrys!==false){
          if(is_array($countrys)){
            foreach($countrys AS $country){
              $country_array=getCountryCountryEnglish(trim($country));
              if($country_array){
                if(!sqlInsertShippingCompanyFeesAfr($id,$currency,$afr,$country_array["country_id"],$ocean_export_id)){
                  echo "新增船公司費用AFR失敗<br>";
                  return false;
                }
              }
              
            }
          }elseif($countrys===true){
            if(!sqlInsertShippingCompanyFeesAfr($id,$currency,$afr,false,$ocean_export_id)){
              echo "新增船公司費用AFR失敗<br>";
              return false;
            }
          }
        }
      }
    }
  }
  return true;
}
?>
<?php
require_once("../../model/CommonSql.php");
require_once("../../model/OceanExport.php");
require_once("../../model/OceanExportPrice.php");
require_once("../../model/OceanExportDateDeadline.php");
require_once("../../model/ShippingCompanyFees.php");
require_once("../../model/ShippingCompanyFeesAfr.php");
require_once("../../model/ShippingCompanyFeesThc.php");
require_once("../../controllers/CommonController.php");
require_once("../../controllers/CommonHtmlController.php");
require_once("../../controllers/CommonSqlController.php");
require_once("../../controllers/OceanExportController.php");
require_once("../../controllers/ShippingCompanyFeesController.php");
?>
<?php
if(isset($_POST['emp_edit_send'])){
  $postname="attachment";
  $path="../../upload/OceanExportQuotePriceExcel/";
  list($result,$filename)=getUploadFile($path,$postname,false);

  if(!$result){
    echo PopupStaticWidowHref($title,"上傳出現錯誤，請聯絡公司相關IT人員","back",true,"OceanExportQuoteUploadMessage");
    exit;
  }

  $company_basis_array=getCompanyFeeBasisArray();
  $excel_array=getExcelToDataArray($path.$filename,0);
  $price_start_field=4;
  $engs=ExcelTableEnglish();
  $objPHPExcel =CreateExcel();
  $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);  //調用Excel2003 以下的版本
  $objPHPExcel->setActiveSheetIndex(0);
  //print_r($excel_array);
  // $buf = sqlSelectOceanExportDateDeadlineShipmentTypeCFS();
  // foreach($buf as $key=>$row){
  //   $charge_arrays[$row["ocean_export_id"]]=getOceanExportDateDeadlineLocalChargeArray($row);
  //   foreach($charge_arrays[$row["ocean_export_id"]]["transfer_fee"]["countrys"] as $key2=> $country){
  //     $charge_arrays[$row["ocean_export_id"]]["transfer_fee"]["countrys"][$key2]=explode(";",$country);
  //   }
  // }
  foreach($excel_array as $key=>$excel_date){
    $ocean_export_id=false;
    $company_id=false;
    $country_id=false;
    $shipping_company_fees_array=false;
    $afr_array=false;
  	$port_code=false;
  	$cabinet_volume_id=false;
  	$cut_off_place_id=false;
    $ocean_export_price=false;
  	if($key==0){
  		foreach($excel_date as $key2=>$value){
  			if(strpos($value,"目的港")!==false && !isset($port_code_field)){
  				$port_code_field=$key2;
    		}elseif(strpos($value,"貨櫃種類")!==false){
    			$cabinet_volume_field=$key2; 		
    		}elseif(strpos($value,"出貨地點")!==false){
    			$cut_off_place_field=$key2;
    		}elseif(strpos($value,"海運費一")!==false){
    			$ocean_price_field=$key2;
    		}elseif(strpos($value,"本地吊櫃費")!==false){
          $thc_field=$key2;
        }elseif(strpos($value,"本地文件費")!==false){
          $document_price_field=$key2;
        }elseif(strpos($value,"特別通關費幣別")!==false){
          $afr_currency_field=$key2;
        }elseif(strpos($value,"特別通關費")!==false){
          $afr_field=$key2;
        }elseif(strpos($value,"封條費")!==false){
          $seal_field=$key2;
        }
        $objPHPExcel->getActiveSheet()->setCellValue($engs[$key2].($key+1),$value);
    	}
  	}else{
  		foreach($excel_date as $key2=>$value){
    		$value=trim($value);
        if($port_code && $cabinet_volume_id && $cut_off_place_id && !$company_id){
          $row=getOceanExportPricePricePortCodeCabinetVolumeIdCutOffPlaceId($port_code,$cabinet_volume_id,$cut_off_place_id);
          if($row){
            $company_id=$row["company_id"];
            $country_id=$row["country_id"];
            $ocean_export_price=intval($row['ocean_export_price']);
          }
        }elseif($ocean_export_id && $company_id && !$shipping_company_fees_array){
          $shipping_company_fees_array = getShippingCompanyFeesOceanExportIdCompanyId($ocean_export_id,$company_id);
          if($shipping_company_fees_array){
            $thc_array= getShippingCompanyFeesThcShippingCompanyFeesIdCabinetVolumeId($shipping_company_fees_array["shipping_company_fees_id"],$cabinet_volume_id);
            $afr_array = getShippingCompanyFeesAfrShippingCompanyFeesIdOceanExportIdCountryId($shipping_company_fees_array["shipping_company_fees_id"],$ocean_export_id,$country_id);
          }
        }
    		if($port_code_field==$key2){
    			$port_code=$value;
          $row=getOceanExportPricePortCode($port_code);
          $ocean_export_id=$row["ocean_export_id"];
          $company_basis = $company_basis_array[$ocean_export_id];
    		}elseif($cabinet_volume_field==$key2){
    			if($value=="2201" || $value=="2200"){
    				$cabinet_volume_id=1;
    			}elseif($value=="4300"){
	    			$cabinet_volume_id=2;
    			}elseif($value=="4500"){
    				$cabinet_volume_id=3;
	    		}    		
    		}elseif($cut_off_place_field==$key2){
    			if($value=="1"){
    				$cut_off_place_id=3;
    			}elseif($value=="2"){
    				$cut_off_place_id=4;
    			}elseif($value=="3"){
    				$cut_off_place_id=1;
    			}
    		}elseif($ocean_price_field==$key2){
          if($ocean_export_price===false){
            $value="no price";
          }elseif($ocean_export_price!==false){
            $value=$ocean_export_price;
            if($excel_date[0]=="AD"){
              $row=getDgOceanPriceCompanyIdCoutryIdCabinetVolumeIdCutOffPlaceId($company_id,$country_id,$cabinet_volume_id,$cut_off_place_id);
              if($row){
                $value+=intval($row['dg_price']);
              }else{
                $value="No Dg Price";
              }
            }
          }
    		}elseif($thc_field==$key2){
          if(intval($thc_array["thc"])>intval($company_basis["cabinet_volume_id"][$cabinet_volume_id])){
            $value = $thc_array["thc"];
          }else{
            $value = $company_basis["cabinet_volume_id"][$cabinet_volume_id];
          }
        }elseif($document_price_field==$key2){
          if(intval($shipping_company_fees_array["b_l"])>intval($company_basis["b_l"])){
            $value = $shipping_company_fees_array["b_l"];
          }else{
            $value = $company_basis["b_l"];
          }
          if(isset($afr_array["currency"])){
            if(strtoupper($afr_array["currency"])=="TWD"){
              $value+=intval($afr_array["afr"]);
            }
          }
        }elseif($afr_currency_field==$key2){
          if(isset($afr_array["currency"])){
            if(strtoupper($afr_array["currency"])!="TWD"){
              $value=strtoupper($afr_array["currency"]);
            }
          }
        }elseif($afr_field==$key2){
          if(isset($afr_array["currency"])){
            if(strtoupper($afr_array["currency"])!="TWD"){
              $value=intval($afr_array["afr"]);
            }
          }
        }elseif($seal_field==$key2){
          if(intval($shipping_company_fees_array["seal"])>intval($company_basis["seal"])){
            $value = $shipping_company_fees_array["seal"];
          }else{
            $value = $company_basis["seal"];
          }
        }

        $objPHPExcel->getActiveSheet()->setCellValue($engs[$key2].($key+1),$value);
    	}
  	}
    
  }
  //產生header，目的是用來下載與製作EXCEL檔
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="[轉檔]'.date("Y-m-d").'台塑報價.xlsx"');
  header('Cache-Control: max-age=0');
  header("Cache-Control: must-revalidate, post-check=0,pre-chech=0");
  header("Pragma: public");
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
  $objWriter->save('php://output');
}

?>
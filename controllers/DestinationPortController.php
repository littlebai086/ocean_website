<?php
/**
 * 1.抓資料庫DestinationPort搜尋條件為國家的id及目的港港口英文
 * 
 * @author Peter Chang
 * 
 * @param integer $country_id 為國家的id
 * 
 * @param string $destination_port_english 為目的港口英文
 * 
 * @return array|boolean
 */
function getDestinationPortCountryIdDestinationPortEnglish($country_id,$destination_port_english){
	$buf = sqlSelectDestinationPortCoutnryIdDestinationPortEnglish($country_id,$destination_port_english);
	foreach ($buf as $row){
		return $row;
	}
}
/**
 * 1.抓資料庫DestinationPort搜尋條件為目的港英文
 * 
 * @author Peter Chang
 * 
 * @param string $destination_port_english 為目的港口英文
 * 
 * @return array|boolean
 */
function getDestinationPortDestinationPortEnglish($destination_port_english){
    $buf = sqlSelectDestinationPortEnglish($destination_port_english);
    foreach($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫DestinationPort如果以下資料庫有資料不可刪除
 *
 * @author Peter Chang
 * 
 * @param integer $id 目的地城市id
 * 
 * @return array(boolean,array,string)
 */
function getDestinationPortDelDecide($id){
  $row=getDestinationDestinationPortId($id);
  $bufs = array(
    sqlSelectOceanExportPriceDestinationPortId($id),
    sqlSelectBookingOrderDestinationId($row['destination_id'])
  );
  $items = array(
    array("sql"=>"ocean_export_price_id","text"=>"海運報價ID"),
    array("sql"=>"destination_id","text"=>"訂艙目的地ID")
  );
  $array=array();
  foreach($bufs as $key=>$buf){
    if($buf){
      foreach($buf as $row){
        array_push($array,$row[$items[$key]["sql"]]);
      }
      return array(false,$array,$items[$key]["text"]);
    }
  }
  return array(true,$array,"正確");
}
/**
 * 1.抓資料庫DestinationPort不等於DestinationPortid的下拉選單
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function getDestinationPortNotDestinationPortIdSelect($destination_port_id){
  $result="";
  $buf = sqlSelectDestinationPortNotDestinationPortId($destination_port_id);
  foreach($buf as $row){
    $result.="<option value='".$row['destination_port_id']."'>".$row['destination_port_english']."</option>";
  }
  return $result;
}
/**
 * 1.目的港清單顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param array $search_fields 為使用者搜尋的資訊
 * 
 * @return string
 */
function getDestinationPortSearchTable($search_fields){
	$items=array("country_english","destination_port_english","destination_port_del");
	$table="";
	$buf=sqlSelectDestinationPortList($search_fields);
	foreach ($buf as $key=>$row){
		$table.="<tr>";
  	    $table.="<td>".($key+1)."</td>";
		foreach($items as $item){
            if($item=="destination_port_del"){
                if($row[$item]==0){
                    $del_text="<font color='green'>未刪除</font>";
                }elseif($row[$item]==1){
                    $del_text="<font color='red'>已刪除</font>";
                }
                $table.="<td>".$del_text."</td>";
            }else{
                $table.="<td>".$row[$item]."</td>";
            }
			
		}
        $table.="<td>";
        if($row['destination_port_del']==0){
          $table.=getHtmlAHrefUpdateIcon("./DestinationPort.php?state=destination_port_update&id=".$row['destination_port_id']);
          $table.=getHtmlAHrefMergeIcon("./DestinationPort.php?state=destination_port_merge&id=".$row['destination_port_id']);
          $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"destination_port_del\",\"./DestinationPort.php?state=destination_port_change_del&id=".$row['destination_port_id']."\")");
        }elseif($row['destination_port_del']==1){
          $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"destination_port_del\",\"./DestinationPort.php?state=destination_port_del&id=".$row['destination_port_id']."\")");
          $table.=getHtmlAHrefReplyFillIcon("#","PopupCloseWidowClick(\"destination_port_reply\",\"./DestinationPort.php?state=destination_port_reply&id=".$row['destination_port_id']."\")");
        }
		$table.="</td></tr>";
	}
	return $table;
}
/**
 * 1.員工後台新增或修改目的港的Form表單
 * 
 * @author Peter Chang
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array 為資料庫DestinationPort的資料
 * 
 * @return string
 */
function getDestinationPortForm($state,$data_array){
  $result="";
  if($state=="destination_port_merge"){
$result.="
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        目前目的港為
      </div>  
      <div class='col col-auto d-flex align-items-center'>
       <input type='text' class='form-control' readonly='readonly' value='".$data_array['destination_port_english']."'>
       </div>
      <div class='col col-auto d-flex align-items-center'>
        合併至
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        <select name='destination_port_id' class='form-select'>
          ".getDestinationPortNotDestinationPortIdSelect($data_array['destination_port_id'])."
        </select>
      </div>
    </div>
    ";
  }else{
    $result.="
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='selectOceanExport' class='control-label'>國家</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <select name='country_id' class='form-select'>
        ".getCountryNotDelOptionCountryEnglishValueCountryId($data_array['country_id'])."
        </select>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCountryEnglish' class='control-label'>目的港英文</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='destination_port_english' value='".$data_array['destination_port_english']."' required='required'>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCountryChinese' class='control-label'>PORT CODE</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='port_code' value='".$data_array['port_code']."'>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCountryAbbreviation' class='control-label'>PORT CODE 1</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='port_code_1' value='".$data_array['port_code_1']."'>
      </div>
    </div>
    ";
  }

    return $result;
}
/**
 * 1.DestinationPort資料庫使用者搜尋的資訊做SQL判斷
 * 
 * @author Peter Chang
 * 
 * @param string $sql 先前SQL的資料
 * 
 * @param array $search_fields 使用者搜尋的資訊
 * 
 * @return array|boolean
 */
function getDestinationPortSqlSearchWhere($sql,$search_fields){
	if ($search_fields!==false){
        if ($search_fields['destination_country_id']!="all" AND $search_fields['destination_country_id']){
            $sql.=" AND `destination_port`.`country_id` = ".$search_fields['destination_country_id'];
        }
    }
    return $sql;
}
?>
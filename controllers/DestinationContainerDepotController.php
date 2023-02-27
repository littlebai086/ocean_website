<?php
/**
 * 1.抓資料庫DestinationContainerDepot搜尋條件為單筆id資料
 *
 * @author Peter Chang
 * 
 * @param integer $id 貨櫃目的地id
 * 
 * @return array
 */
function getDestinationContainerDepotDestinationContainerDepotId($id){
    $buf = sqlSelectDestinationContainerDepotDestinationContainerDepotId($id);
    if($buf){
        foreach($buf as $row){
            return $row;
        }
    }
    return false;
}
/**
 * 1.抓資料庫DestinationContainerDepot如果以下資料庫有資料不可刪除
 *
 * @author Peter Chang
 * 
 * @param integer $id 目的地城市id
 * 
 * @return array(boolean,array,string)
 */
function getDestinationContainerDepotDelDecide($id){
    $row=getDestinationDestinationContainerDepotId($id);
    $buf = sqlSelectBookingOrderDestinationId($row['destination_id']);
    $array=array();
    if($buf){
        foreach($buf as $row){
            array_push($array,$row["destination_id"]);
        }
        return array(false,$array,"訂艙目的地ID");
    }
    return array(true,$array,"正確");
}
/**
 * 1.抓資料庫DestinationContainerDepot搜尋條件為未刪除的貨櫃目的地
 *
 * @author Peter Chang
 * 
 * @param integer $destination_container_depot_id 貨櫃目的地id
 * 
 * @return array
 */
function getDestinationCityNotDelOptionContainerDepotEnglishValueDestinationContainerDepotId($destination_container_depot_id){
	$result="";
    $buf = sqlSelectDestinationContainerDepotDestinationContainerDepotNotDelDestinationContainerDepotId($destination_container_depot_id);
	foreach($buf as $row){
    	$result.="<option value='".$row['destination_container_depot_id']."'>".$row['container_depot_english']."</option>";
  	}
  	return $result;
}
/**
 * 1.抓資料庫DestinationContainerDepot搜尋條件為貨櫃目的地英文
 * 
 * @author Peter Chang
 * 
 * @param string $container_depot_english 為貨櫃目的地口英文
 * 
 * @return array|boolean
 */
function getDestinationContainerDepotDestinationContainerDepotEnglish($container_depot_english){
    $buf = sqlSelectDestinationContainerDepotEnglish($container_depot_english);
    foreach($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫DestinationContainerDepot不等於DestinationContainerDepotid的下拉選單
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function getDestinationContainerDepotNotDestinationContainerDepotIdSelect($destination_port_id){
  $result="";
  $buf = sqlSelectDestinationContainerDepotNotDestinationContainerDepotId($destination_port_id);
  foreach($buf as $row){
    $result.="<option value='".$row['destination_port_id']."'>".$row['destination_port_english']."</option>";
  }
  return $result;
}
/**
 * 1.貨櫃目的地清單顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param array $search_fields 為使用者搜尋的資訊
 * 
 * @return string
 */
function getDestinationContainerDepotSearchTable($search_fields){
    $items=array("city_english","container_depot_english","destination_container_depot_del");
    $table="";
    $buf=sqlSelectDestinationContainerDepotList($search_fields);
    foreach ($buf as $key=>$row){
        $table.="<tr>";
        $table.="<td>".($key+1)."</td>";
        foreach($items as $item){
            if($item=="destination_container_depot_del"){
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
        if($row['destination_container_depot_del']==0){
            $table.=getHtmlAHrefUpdateIcon("./DestinationContainerDepot.php?state=destination_container_depot_update&id=".$row['destination_container_depot_id']);
            $table.=getHtmlAHrefMergeIcon("./DestinationContainerDepot.php?state=destination_container_depot_merge&id=".$row['destination_container_depot_id']);
            $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"destination_container_depot_del\",\"./DestinationContainerDepot.php?state=destination_container_depot_change_del&id=".$row['destination_container_depot_id']."\")");
        }elseif($row['destination_container_depot_del']==1){
          $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"destination_container_depot_del\",\"./DestinationContainerDepot.php?state=destination_container_depot_del&id=".$row['destination_container_depot_id']."\")");
          $table.=getHtmlAHrefReplyFillIcon("#","PopupCloseWidowClick(\"destination_container_depot_reply\",\"./DestinationContainerDepot.php?state=destination_container_depot_reply&id=".$row['destination_container_depot_id']."\")");
        }
        $table.="</td></tr>";
    }
    return $table;
}
/**
 * 1.員工後台新增或修改貨櫃目的地的Form表單
 * 
 * @author Peter Chang
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array 為資料庫DestinationContainerDepot的資料
 * 
 * @return string
 */
function getDestinationContainerDepotForm($state,$data_array){
  $result="";
  if($state=="destination_container_depot_merge"){
$result.="
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        目前貨櫃目的地為
      </div>  
      <div class='col col-auto d-flex align-items-center'>
       <input type='text' class='form-control' readonly='readonly' value='".$data_array['container_depot_english']."'>
       </div>
      <div class='col col-auto d-flex align-items-center'>
        合併至
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        <select name='destination_container_depot_id' class='form-select'>
          ".getDestinationCityNotDelOptionContainerDepotEnglishValueDestinationContainerDepotId($data_array['destination_container_depot_id'])."
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
        <label for='selectOceanExport' class='control-label'>貨櫃目的地城市</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <select name='destination_city_id' class='form-select'>
        ".getDestinationCityNotDelOptionDestinationCityEnglishValueDestinationCityId($data_array['destination_city_id'])."
        </select>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCountryEnglish' class='control-label'>貨櫃目的地英文</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='container_depot_english' value='".$data_array['container_depot_english']."' required='required'>
      </div>
    </div>
    ";
  }

    return $result;
}
/**
 * 1.DestinationContainerDepot資料庫使用者搜尋的資訊做SQL判斷
 * 
 * @author Peter Chang
 * 
 * @param string $sql 先前SQL的資料
 * 
 * @param array $search_fields 使用者搜尋的資訊
 * 
 * @return array|boolean
 */
function getDestinationContainerDepotSqlSearchWhere($sql,$search_fields){
    if ($search_fields!==false){
        if ($search_fields['container_depot_english']){
            $sql.=" AND `destination_container_depot`.`container_depot_english` LIKE '%".$search_fields['container_depot_english']."%' ";
        }
    }
    return $sql;
}

?>
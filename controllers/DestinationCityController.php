<?php
/**
 * 1.抓資料庫DestinationCity搜尋條件為目的地城市id
 *
 * @author Peter Chang
 * 
 * @param integer $id 目的地城市id
 * 
 * @return array
 */
function getDestinationCityId($id){
    $buf = sqlSelectDestinationCityDestinationCityId($id);
    if($buf){
        foreach($buf as $row){
            return $row;
        }
    }
    return false;
}
/**
 * 1.抓資料庫DestinationCity如果以下資料庫有資料不可刪除
 *
 * @author Peter Chang
 * 
 * @param integer $id 目的地城市id
 * 
 * @return array(boolean,array,string)
 */
function getDestinationCityDelDecide($id){
  $bufs = array(
    sqlSelectDestinationContainerDepotDestinationCityId($id)
  );
  $items = array(
    array("sql"=>"container_depot_english","text"=>"貨櫃目的地")
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
 * 1.抓資料庫DestinationCity搜尋條件為未刪除的目的地城市
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function getDestinationCityNotDelOptionDestinationCityEnglishValueDestinationCityId($destination_city_id){
    $result="";
    $buf = sqlSelectDestinationCityNotDestinationCityId();
    foreach ($buf as $row){
        if($row['destination_city_id']==$destination_city_id){
            $result.="<option value='".$row['destination_city_id']."' selected>".strtoupper($row['city_english'])."</option>";
        }else{
            $result.="<option value='".$row['destination_city_id']."'>".strtoupper($row['city_english'])."</option>";
        }
    }
    return $result;
}
/**
 * 1.目的地城市清單顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param array $search_fields 為使用者搜尋的資訊
 * 
 * @return string
 */
function getDestinationCitySearchTable($search_fields){
    $items=array("country_english","city_english","destination_city_del");
    $table="";
    $buf=sqlSelectDestinationCityList($search_fields);
    foreach ($buf as $key=>$row){
        $table.="<tr>";
        $table.="<td>".($key+1)."</td>";
        foreach($items as $item){
            if($item=="destination_city_del"){
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
        if($row['destination_city_del']==0){
          $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"destination_city_del\",\"./DestinationCity.php?state=destination_city_change_del&id=".$row['destination_city_id']."\")");
        }elseif($row['destination_city_del']==1){
          $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"destination_city_del\",\"./DestinationCity.php?state=destination_city_del&id=".$row['destination_city_id']."\")");
          $table.=getHtmlAHrefReplyFillIcon("#","PopupCloseWidowClick(\"destination_city_reply\",\"./DestinationCity.php?state=destination_city_reply&id=".$row['destination_city_id']."\")");
        }
        $table.="</td></tr>";
    }
    return $table;
}
/**
 * 1.DestinationCity資料庫使用者搜尋的資訊做SQL判斷
 * 
 * @author Peter Chang
 * 
 * @param string $sql 先前SQL的資料
 * 
 * @param array $search_fields 使用者搜尋的資訊
 * 
 * @return array|boolean
 */
function getDestinationCitySqlSearchWhere($sql,$search_fields){
  if ($search_fields!==false){
        if($search_fields['city_english']){
          $sql.=" AND `city`.`city_english` LIKE '%".$search_fields['city_english']."%' ";
        }
    }
    return $sql;
}
?>
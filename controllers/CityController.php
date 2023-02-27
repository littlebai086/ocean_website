<?php
/**
 * 1.抓資料庫City搜尋條件為國家id
 * 
 * @author Peter Chang
 * 
 * @param integer $country_id 為國家id
 * 
 * @return array|boolean
 */
function getCityCountryId($country_id){
    $buf = sqlSelectCityCountryId($country_id);
    foreach($buf as $row){
        return $row;
    }
}

/**
 * 1.抓資料庫City搜尋條件為城市英文
 * 
 * @author Peter Chang
 * 
 * @param string $city_english 為城市英文
 * 
 * @return array|boolean
 */
function getCityCityEnglish($city_english){
    $buf = sqlSelectCityEnglish($city_english);
    foreach($buf as $row){
        return $row;
    }
}
/**
 * 1.抓資料庫City不等於Cityid的下拉選單
 *
 * @author Peter Chang
 * 
 * @param integer $city_id 城市id
 * 
 * @return array
 */
function getCityNotCityIdSelect($city_id){
  $result="";
  $buf = sqlSelectCityNotCityId($city_id);
  foreach($buf as $row){
    $result.="<option value='".$row['city_id']."'>".$row['city_english']."</option>";
  }
  return $result;
}
/**
 * 1.抓資料庫City如果以下資料庫有資料不可刪除
 *
 * @author Peter Chang
 * 
 * @param integer $id 城市id
 * 
 * @return array(boolean,array,string)
 */
function getCityDelDecide($id){
  $bufs = array(
    sqlSelectAreaCityId($id),
    sqlSelectCutOffPlaceCityId($id),
    sqlSelectDestinationCityCityId($id)
  );
  $items = array(
    array("sql"=>"area_chinese","text"=>"地區"),
    array("sql"=>"cut_off_place","text"=>"結關地"),
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
 * 1.城市清單顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param array $search_fields 為使用者搜尋的資訊
 * 
 * @return string
 */
function getCitySearchTable($search_fields){
    $items=array("country_english","city_english","city_chinese","city_del");
    $table="";
    $buf=sqlSelectCityList($search_fields);
    foreach ($buf as $key=>$row){
        $table.="<tr>";
        $table.="<td>".($key+1)."</td>";
        foreach($items as $item){
            if($item=="city_del"){
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
        if($row['city_del']==0){
          $table.=getHtmlAHrefUpdateIcon("./City.php?state=city_update&id=".$row['city_id']);
          $table.=getHtmlAHrefMergeIcon("./City.php?state=city_merge&id=".$row['city_id']);
          $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"city_del\",\"./City.php?state=city_change_del&id=".$row['city_id']."\")");
        }elseif($row['city_del']==1){
          $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"city_del\",\"./City.php?state=city_del&id=".$row['city_id']."\")");
          $table.=getHtmlAHrefReplyFillIcon("#","PopupCloseWidowClick(\"city_reply\",\"./City.php?state=city_reply&id=".$row['city_id']."\")");
        }
        $table.="</td></tr>";
    }
    return $table;
}
/**
 * 1.員工後台新增或修改城市的Form表單
 * 
 * @author Peter Chang
 * 
 * @param string $state 接收資訊的狀態
 * 
 * @param array $data_array 為資料庫City的資料
 * 
 * @return string
 */
function getCityForm($state,$data_array){
    $result="";
    $checked="";
    $checked1=" checked";
    $destination_city_array=getDestinationCityCityId($data_array['city_id']);
    if($destination_city_array){
      if($destination_city_array["destination_city_del"]==0){
        $checked=" checked";
        $checked1="";
      }
    }
    $radio_html="
        <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' id='inlineCheckbox1' name='destination_city_result' value='yes' ".$checked.">
            <label class='form-check-label' for='inlineCheckbox1'>新增</label>
        </div>
        <div class='form-check form-check-inline'>
            <input class='form-check-input' type='radio' id='inlineCheckbox2' name='destination_city_result' value='no' ".$checked1.">
            <label class='form-check-label' for='inlineCheckbox2'>刪除</label>
        </div>";
    
  if($state=="city_merge"){
$result.="
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        目前城市為
      </div>  
      <div class='col col-auto d-flex align-items-center'>
       <input type='text' class='form-control' readonly='readonly' value='".$data_array['city_english']."'>
       </div>
      <div class='col col-auto d-flex align-items-center'>
        合併至
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        <select name='city_id' class='form-select'>
          ".getCityNotCityIdSelect($data_array['city_id'])."
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
        <label for='selectCountry' class='control-label'>國家</label>
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
        <label for='inputCityEnglish' class='control-label'>城市英文</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='city_english' value='".$data_array['city_english']."' required='required'>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCityChinese' class='control-label'>城市中文</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='city_chinese' value='".$data_array['city_chinese']."'>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCityAbbreviation' class='control-label'>城市英文縮寫</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='city_abbreviation' value='".$data_array['city_abbreviation']."'>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputDestinationCityCheck' class='control-label'>新增目的地城市</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        ".$radio_html."
      </div>
    </div>
    ";
  }

    return $result;
}
/**
 * 1.City資料庫使用者搜尋的資訊做SQL判斷
 * 
 * @author Peter Chang
 * 
 * @param string $sql 先前SQL的資料
 * 
 * @param array $search_fields 使用者搜尋的資訊
 * 
 * @return array|boolean
 */
function getCitySqlSearchWhere($sql,$search_fields){
  if ($search_fields!==false){
        if ($search_fields['country_id']!="all" AND $search_fields['country_id']){
            $sql.=" AND `country`.`country_id` = ".$search_fields['country_id'];
        }
        if($search_fields['city_english']){
          $sql.=" AND `city`.`city_english` LIKE '%".$search_fields['city_english']."%' ";
        }
        if($search_fields['city_chinese']){
          $sql.=" AND `city`.`city_chinese` LIKE '%".$search_fields['city_chinese']."%' ";
        }
    }
    return $sql;
}
?>
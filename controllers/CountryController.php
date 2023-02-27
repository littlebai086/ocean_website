<?php
/**
 * 1.抓資料庫Country搜尋條件為國家的英文及id
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @param string $country_english 國家英文
 * 
 * @return array
 */
function getCountryCountryIdCountryEnglish($country_id,$country_english){
    $buf = sqlSelectCountryCountryIdCountryEnglish($country_id,$country_english);
    if($buf){
      foreach ($buf as $row){
        return $row;
      }
    }
    return false;
}
/**
 * 1.抓資料庫Country不等於國家id的下拉選單
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array
 */
function getCountryNotCountryIdSelect($country_id){
  $result="";
  $buf = sqlSelectCountryNotCountryId($country_id);
  foreach($buf as $row){
    $result.="<option value='".$row['country_id']."'>".$row['country_english']."</option>";
  }
  return $result;
}
/**
 * 1.抓資料庫Country如果以下資料庫有資料不可刪除
 *
 * @author Peter Chang
 * 
 * @param integer $country_id 國家id
 * 
 * @return array(boolean,array,string)
 */
function getCountryDelDecide($id){
  $bufs = array(
    sqlSelectCityCountryId($id),
    sqlSelectDestinationPortCountryId($id),
    sqlSelectDgOceanPriceCountryId($id));
  $items = array(
    array("sql"=>"city_english","text"=>"城市"),
    array("sql"=>"destination_port_english","text"=>"目的港"),
    array("sql"=>"dg_ocean_price_id","text"=>"DG費用表")
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
 * 1.國家清單顯示的表格資料
 * 
 * @author Peter Chang
 * 
 * @param array $search_fields 為使用者搜尋的資訊
 * 
 * @return string
 */
function getCountrySearchTable($search_fields){
  $items=array("quote_route","country_english","country_chinese","country_del");
  $table="";
  $buf=sqlSelectCountryList($search_fields);
  foreach ($buf as $key=>$row){
    $table.="<tr>";
        $table.="<td>".($key+1)."</td>";
    foreach($items as $item){
      if($item=="quote_route"){
        if($row["ocean_export_id"]==0){
          $table.="<td>無海運航線</td>";
        }else{
          $table.="<td>".$row[$item]."</td>";
        }
      }elseif($item=="country_del"){
        if($row[$item]==0){
          $table.="<td><font color='green'>未刪除</font></td>";
        }else{
          $table.="<td><font color='red'>已刪除</font></td>";
        }
      }else{
        $table.="<td>".$row[$item]."</td>";
      }
    }
    $table.="<td>";
    if($row['country_del']==0){
      $table.=getHtmlAHrefUpdateIcon("./Country.php?state=country_update&id=".$row['country_id']);
      $table.=getHtmlAHrefMergeIcon("./Country.php?state=country_merge&id=".$row['country_id']);
      $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"country_del\",\"./Country.php?state=country_change_del&id=".$row['country_id']."\")");
    }elseif($row['country_del']==1){
      $table.=getHtmlAHrefTrashIcon("#","PopupCloseWidowClick(\"country_del\",\"./Country.php?state=country_del&id=".$row['country_id']."\")");
      $table.=getHtmlAHrefReplyFillIcon("#","PopupCloseWidowClick(\"country_reply\",\"./Country.php?state=country_reply&id=".$row['country_id']."\")");
    }
    $table.="</td></tr>";
  }
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
function getCountryForm($state,$data_array){
  $result="";
  if($state=="country_merge"){
$result.="
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        目前國家為
      </div>  
      <div class='col col-auto d-flex align-items-center'>
       <input type='text' class='form-control' readonly='readonly' value='".$data_array['country_english']."'>
       </div>
      <div class='col col-auto d-flex align-items-center'>
        合併至
      </div>  
      <div class='col col-auto d-flex align-items-center'>
        <select name='country_id' class='form-select'>
          ".getCountryNotCountryIdSelect($data_array['country_id'])."
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
        <label for='selectOceanExport' class='control-label'>海運報價航線</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <select name='ocean_export_id' class='form-select'>
        <option value=0>無</option>
        ".getOceanExportIdSelect($data_array['ocean_export_id'])."
        </select>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCountryEnglish' class='control-label'>國家英文</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='country_english' value='".$data_array['country_english']."' required='required'>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCountryChinese' class='control-label'>國家中文</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='country_chinese' value='".$data_array['country_chinese']."'>
      </div>
    </div>
    <div class='row'>
      <div class='col col-lg-4'>
      </div>  
      <div class='col col-lg-2 d-flex align-items-center'>
        <label for='inputCountryAbbreviation' class='control-label'>國家英文縮寫</label>
      </div>
      <div class='col col-lg-2 d-flex align-items-center'>
        <input type='text' class='form-control' name='country_abbreviation' value='".$data_array['country_abbreviation']."'>
      </div>
    </div>
    ";
  }

    return $result;
}
/**
 * 1.Country資料庫使用者搜尋的資訊做SQL判斷
 * 
 * @author Peter Chang
 * 
 * @param string $sql 先前SQL的資料
 * 
 * @param array $search_fields 使用者搜尋的資訊
 * 
 * @return array|boolean
 */
function getCountrySqlSearchWhere($sql,$search_fields){
  if ($search_fields!==false){
        if ($search_fields['ocean_export_id']!="all" AND $search_fields['ocean_export_id']){
            $sql.=" AND `ocean_export`.`ocean_export_id` = ".$search_fields['ocean_export_id'];
        }
        if($search_fields['country_english']){
          $sql.=" AND `country`.`country_english` LIKE '%".$search_fields['country_english']."%' ";
        }
        if($search_fields['country_chinese']){
          $sql.=" AND `country`.`country_chinese` LIKE '%".$search_fields['country_chinese']."%' ";
        }
    }
    return $sql;
}
?>
<?php

function sqlSelectCommoditySearchList($search_fields,$prohibit,$start,$per){
	$limit=getSQLLimitStartEnd($start,$per);
    $sql="SELECT * FROM `commodity`  WHERE `prohibit` = ".$prohibit;
    if ($search_fields!==false){
    	if($search_fields['o']){
			$sql.=" and `".$search_fields['o']."` like '%".$search_fields['t']."%' ";
		}
	}
	$sql .= " ORDER BY `commodity` ASC ".$limit;
    return sendSQL($sql);
}

function sqlInsertCommodity($data_array){
    $sql="INSERT INTO `commodity`(`un`,`class`,`cas_no`,`commodity`,`remark`,`prohibit`,`msds`) 
    VALUES ('".$data_array['un']."','".$data_array['class']."',
    '".$data_array['cas_no']."','".$data_array['commodity']."','".$data_array['remark']."',
	'".$data_array['prohibit']."','".$data_array['msds']."')";
    return sendSQL($sql);
}

function sqlUpdateCommodityMsds($id,$msds){
	$sql = "UPDATE `commodity` SET `msds` = '".$msds."'
		WHERE `id` = ".$id;
	return sendSQL($sql);
}

function sqlUpdateCommodity($id,$data_array){
	$sql = "UPDATE `commodity` SET `un`='".$data_array['un']."',
	`class`='".$data_array['class']."',
	`cas_no`='".$data_array['cas_no']."',
	`commodity`='".$data_array['commodity']."',
	`remark`='".$data_array['remark']."',
	`prohibit`='".$data_array['prohibit']."',
	`msds`='".$data_array['msds']."'
	WHERE `id`='".$id."'";
	return sendSQL($sql);
}

function sqlDeleteCommodity($id){
	$sql="DELETE FROM `commodity` WHERE `id`='".$id."'";
	return sendSQL($sql);
}
?>
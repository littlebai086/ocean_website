<?php
/**
 * 1.該權限員工預設交接步驟的編碼
 * 
 * @author Peter Chang
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @return boolean|integer
 */
function getStaffBookingOrderTransferDefaultSchedule($staff_array){
	$buf = getStaffBookingOrderTransferDefaultScheduleArray($staff_array);
	if($buf!==false){
		foreach ($buf as $row){
			return $row;
		}
	}
	return false;
}
/**
 * 1.該員工是否有處理訂艙單的權限，且可以移交的客戶
 * 
 * @author Peter Chang
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @return boolean|array
 */
function getStaffBookingOrderTransferDefaultScheduleArray($staff_array){
	$schedules=array();
	$booking_order_shcedule_array=getBookingOrderSchedulePriorityShowArray(false,true);
	foreach($booking_order_shcedule_array as $booking_order_shcedules){
		if($booking_order_shcedules["staff_id"]){
			$schedule=$booking_order_shcedules["schedule"];
			if(getBookingOrderDepartmentPositionSchedulePriorityReturn($schedule,$staff_array)){
				array_push($schedules,$schedule);
			}
		}
	}
	if(!empty($schedules)){
		return $schedules;
	}
	return false;
}
/**
 * 1.該員工是否有正在處理中的客戶
 * 
 * @author Peter Chang
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @return boolean
 */
function getStaffBookingOrderTransferCassInProcessDecide($staff_array){
	$schedules=getStaffBookingOrderTransferDefaultScheduleArray($staff_array);
	if($schedules!==false){
		foreach($schedules as $schedule){
			$row=getBookingOrderCsDocFinancialStaffId($staff_id,$schedule);
			if($row){
				return true;
			}
		}
	}
	return false;
}
/**
 * 1.拿取該員工訂艙單的步驟權限Html Select Option的資料
 * 
 * @author Peter Chang
 * 
 * @param array $staff_array 此為員工資訊的陣列
 * 
 * @param integer $schedule 步驟的編碼
 * 
 * @return string
 */
function getStaffBookingOrderTransferScheduleSelect($staff_array,$schedule){
	$result="";
	$schedules=getStaffBookingOrderTransferDefaultScheduleArray($staff_array);
	if($schedules!==false){
		foreach ($schedules as $value){
			if($schedule == $value){
				$result.="<option value=".$value." selected>".getBookingOrderScheduleShowName($value)."</option>";
			}else{
				$result.="<option value=".$value.">".getBookingOrderScheduleShowName($value)."</option>";
			}	
		}
	}
	return $result;
}
/**
 * 1.拿取該訂艙單被移交的客戶的員工資訊
 * 
 * @author Peter Chang
 * 
 * @param string $staff_id 為員工的id
 * 
 * @param integer $schedule 步驟的編碼
 * 
 * @return string
 */
function getStaffBookingOrderTransferStaffIdSelect($staff_id,$schedule){
	$result="";
	$booking_order_shcedule_array=getBookingOrderSchedulePriorityShowArray();
	if(isset($booking_order_shcedule_array[$schedule])){
		$booking_order_array=$booking_order_shcedule_array[$schedule];
		$departments=explode(";",$booking_order_array["department"]);
		$position=$booking_order_array["position"];
        $buf = sqlSelectStaffListDepartmentPosition($departments,$position,$staff_id);
        foreach($buf as $row){
           	$result.="<option value=".$row['staff_id'].">".$row['cname']."</option>";
        }
	}
	return $result;
}
/**
 * 1.員工後台移交客戶的表格資訊
 * 
 * @author Peter Chang
 * 
 * @param string $staff_id 為員工的id
 * 
 * @param integer $schedule 步驟的編碼
 * 
 * @return string
 */
function getStaffBookingOrderTransferTable($staff_id,$schedule){
    $items=array("company_chinese","dangerous_goods","cabinet_volume","cut_off_place_id","destination_country_english","destination_port_english","create_time");
    $table="";
    $buf=sqlSelectBookingOrderCsDocFinancialStaffId($staff_id,$schedule);
    foreach ($buf as $key=>$row){
    $table.="<tr>";
    $table.="<td>".($key+1)."</td>";
    $table.="<td>".$row["serial_head"].$row["serial_number"]."</td>";
        foreach ($items as $item){
            if($item=="cabinet_volume"){
            $array=getBookingOrderCabinetVolumeStrToArray($row[$item]);
            $end_key=end($array);
            $table.="<td>";
                foreach ($array as $array_key=>$value){
                    if($value>0 && $end_key==$array_key){
                        $table.=$value." ".getCabinetVolumeName($array_key);
                    }elseif($value>0){
                        $table.=$value." ".getCabinetVolumeName($array_key)."<br>";
                    }
                }
            $table.="</td>";
            }elseif($item=="cut_off_place_id"){
                $table.="<td>".CutOffPlaceIdFormat($row[$item])."</td>";
            }elseif($item=="dangerous_goods"){
                $table.="<td>".$row[$item];
                if($row[$item]=="危險品"){
                    $table.=" ".$row['class']."/".$row['un_no'];
                }
                $table.="</td>";
            }else{
                $table.="<td>".$row[$item]."</td>";
            }
        }
    $table.="<td><input class='form-check-input' type='checkbox' name='customer_transfer[]' value='".$row['booking_order_id']."'></td>";
    $table.="</tr>";
    }
    return $table;
}
?>
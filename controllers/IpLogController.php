<?php
/**
 * 1.資料庫員工訂艙單表格顯示的資料
 * 2.getBookingOrderDepartmentPositionSchedulePriorityReturn為判斷icon權限顯示步驟
 * 
 * @author Peter Chang
 *
 * @param string $list_state single為單個schedule,all為全部schedule資料
 * 
 * @param integer $staff_id 員工編號id
 *
 * @param array $search_fields 使用者搜尋的資料
 * 
 * @param integer $start 開始的頁數
 *
 * @param integer $per 每頁幾筆
 * 
 * @return string
 */
function getStaffMemberRecordSearchTable($search_fields){
    $table="";
	$day=getCountDay($search_fields['start_date'],$search_fields['end_date'])+1;
    for($i=0;$i<$day;$i++){
        $date=date("Y-m-d",strtotime("+".$i." day",strtotime($search_fields['start_date'])));
        $emails=array();
        $browse_emails=array();
        $member_pass_array=sqlSelectMemberLogCreateTimeMemberIdNullPass($date);
        $member_not_pass_array=sqlSelectMemberLogCreateTimeMemberIdNullNotPass($date);
        $ip_browses=sqlSelectIpLogIpCreateTimeActionBookingOrder($date);
        if(count($ip_browses)>0){
            foreach($ip_browses as $array){
                array_push($browse_emails,$array["username"]);
            }
        }
        if(count($member_not_pass_array)>0){
            foreach($member_not_pass_array as $array){
                array_push($emails,$array["register_username"]);
            }
        }
        if(count($member_pass_array)>0){
            foreach($member_pass_array as $array){
                $emails=getArrayValueDeleteSort($emails,$array["register_username"]);
            }
        }
        $table.="<tr>";
        $table.="<td>".$date."</td>";
        $table.="<td>".count(sqlSelectIpLogIpCreateTime($date))."</td>";
        $table.="<td>".count(sqlSelectIpLogIpCreateTimeOceanExportIdNotNull($date))."</td>";
        $table.="<td>".count(sqlSelectMemberLogCreateTime($date))."</td>";
        $table.="<td>".count($member_pass_array)."</td>";
        $table.="<td>".implode("<br>",$emails)."</td>";
        $table.="<td>".count($ip_browses)."</td>";
        $table.="<td>".implode("<br>",$browse_emails)."</td>";
        
        $table.="<tr>";

    }
    return $table;
}
?>
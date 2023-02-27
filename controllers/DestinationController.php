<?php
function getDestinationDestinationPortId($destination_port_id){
	$buf = sqlSelectDestinationDestinationPortId($destination_port_id);
	foreach($buf as $row){
		return $row;
	}
}

function getDestinationDestinationContainerDepotId($destination_container_depot_id){
	$buf = sqlSelectDestinationDestinationContainerDepotId($destination_container_depot_id);
	foreach($buf as $row){
		return $row;
	}
}
?>
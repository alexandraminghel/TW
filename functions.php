<?php  
function getLastVisit($id, $conn) {
	
	$query = $conn->prepare('SELECT count(*) as "nr" FROM vizite where id_vizitator like ?');
	$query->bind_param('i', $id);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();
	
 	if( $row['nr'] > 0) {
 		
 		$query = $conn->prepare('SELECT max(data_vizitei) as "data" FROM vizite where id_vizitator like ?');
		$query->bind_param('i', $id);
		$query->execute();
		mysqli_free_result($result);
		$result = $query->get_result();
		$row = $result->fetch_assoc();
		$obj = new DateTime($row['data']);
		return date_format($obj, 'd.m.Y');
 	}

 	else {
 		return "-.-.-";
 	}
}

function getTotalProgs($id, $conn) {
	$query = $conn->prepare('SELECT count(*) as "nr" FROM programari where id_vizitator like ?');
	$query->bind_param('i', $id);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();

	return $row['nr'];
}

?>

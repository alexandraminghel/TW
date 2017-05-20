<?php  

function getNameConvict() {

	require('connection.php');
	$id = $_GET['id'];
	$query = "SELECT nume, prenume FROM detinuti where id like '$id'";
	$result =  mysqli_query($conn, $query, MYSQLI_USE_RESULT);
 	if( $result) {
 		$row = $result->fetch_assoc();
 		return $row['nume']." ".$row['prenume'];
 	}
 	else {
 	 	return "DETINUT INEXISTENT";
 	}
}
?>

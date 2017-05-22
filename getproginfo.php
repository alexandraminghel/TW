<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once ('connection.php');
require_once ('userobject.php');
require_once ('detinutobject.php');

$message = "";
$ok = 0;
$data_viz = "";
$nat_viz = "";
$rez_disc = "";
$obj_aduse = "";
$rel_det = "";
$prog_id = 0;

if (isset($_GET['id'])) {
	$prog_id = $_GET['id'];

	$query = $conn->prepare('SELECT count(*) AS "nr" FROM programari WHERE id = ?');
	$query->bind_param('i', $prog_id);
	$query->execute();
	$result = $query->get_result();
	$row = $result->fetch_assoc();

	if ($row['nr'] > 0) {
		$ok = 1;
		$query = $conn->prepare('SELECT * FROM programari WHERE id = ?');
		$query->bind_param('i', $prog_id);

		$query->execute();
		$result = $query->get_result();
		$row = $result->fetch_assoc();

		$user = new User($row['ID_VIZITATOR'], $conn);
		$detinut = new Detinut($row['ID_DETINUT'], $conn);
		$data_viz = $row['DATA_VIZITEI'];
		$nat_viz = $row['NATURA_VIZITEI'];
		$rez_disc = $row['REZUMATUL_DISCUTIEI'];
		$obj_aduse = $row['OBIECTE_ADUSE'];
		$rel_det = $row['RELATIA_DETINUT'];
	}

	else {
		$ok = 0;
		$message = "ATENTIE! PROGRAMAREA CU ID-UL ".$prog_id." NU EXISTA!";
		$user = new User();
		$detinut = new Detinut();
	}
}

else {
	$ok = 0;
	$message =  "ATENTIE! ID INCORECT!";
	$user = new User();
	$detinut = new Detinut();
}
?>

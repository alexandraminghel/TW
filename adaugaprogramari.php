<?php  
require_once('connection.php');

$status = array("Sot", "Prieten", "Ruda", "Avocat");
$obiecte = array("Poze", "Carte", "Mancare");
$rezumat = array("Evenimente din familie", "Decursul procesului", "Membrii ai familiei");
$tip = array("Vizita de familie", "Vizita amicala", "Informare proces", "Probleme legale");

$query = $conn->prepare('SELECT COUNT(*) FROM programari');
$query->execute();
$result = $query->get_result();

for($index = 1; $index <= 200; $index++) {

	$id_viz = rand(1, 301);
	$id_det = rand(1, 100);

	$status_viz = "-";
	$rezumat_viz = "-";
	$obiecte_viz = "-";
	$tip_viz = "-";

	$datestart = strtotime('+2 day', time());
	$dateend = strtotime('+5 month', time());
	$date_viz_rand = rand($datestart, $dateend);	
	$date_viz = date('Y/m/d H:i:s', $date_viz_rand);

	$query = $conn->prepare('SELECT * FROM programari WHERE ID_VIZITATOR = ? AND ID_DETINUT = ?');
	$query->bind_param('ii', $id_viz, $id_det);
	$query->execute();

	mysqli_free_result($result);

	$result = $query->get_result();
	if (mysqli_num_rows($result) > 0) {
		$row = $result->fetch_assoc();
		$status_viz = $row['RELATIA_DETINUT'];
	}

	else {
		$status_viz_index = array_rand($status, 1);
		$status_viz = $status[$status_viz_index];
	}

	if ($status_viz == "Avocat") {
		$obiecte_viz = "Documente";
		$tip_viz_index = rand(2,3);
		$tip_viz = $tip[$tip_viz_index];
	}

	else {
		$nr_obiecte = rand(0, 3);

		if ($nr_obiecte > 0) {

			$obiecte_viz = $obiecte[0];
			for($indx = 1; $indx < $nr_obiecte; $indx++) {
				$obiecte_viz = $obiecte_viz.", ".$obiecte[$indx];
			}
		}

		else {
			$obiecte_viz = "-";
		}

		$tip_viz_index = array_rand($tip, 1);
		$tip_viz = $tip[$tip_viz_index];

		$rezumat_viz_index = array_rand($rezumat, 1);
		$rezumat_viz = $rezumat[$rezumat_viz_index];
	}

	$query = $conn->prepare('INSERT INTO programari (ID_VIZITATOR, ID_DETINUT, DATA_VIZITEI, NATURA_VIZITEI, REZUMATUL_DISCUTIEI, OBIECTE_ADUSE, RELATIA_DETINUT) VALUES (?, ?, ?, ?, ?, ?, ?)');
	$query->bind_param('iisssss', $id_viz, $id_det, $date_viz, $tip_viz, $rezumat_viz, $obiecte_viz, $status_viz);
	$query->execute();
}
?>
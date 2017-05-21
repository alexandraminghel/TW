<?php  
session_start();
require('connection.php');

if (! isset($_GET['id'])) {
	$message = "Eroare la introducerea vizitei</br>Redirectare spre pagina principala in 3 secunde.";
}

else {
	$id_prog = $_GET['id'];

	if (! (isset($_POST["ora"]) && isset($_POST["durata"]) && isset($_POST["martor"]) && isset($_POST["obiected"]) && (!empty($_POST['info'])) && isset($_POST["sanatate"]))) {
		$message = "Atentie! Campuri obligatorii necompletate!</br>Redirectare spre pagina principala in 3 secunde.";
	}

	else {
		$ora = strtotime($_POST["ora"]);

		if ($ora == false || $ora == -1) {
			$message = "Ora trebuie introdusa in format HH:MM.</br>Redirectare spre pagina principala in 3 secunde.";
		}

		else {
			$date = DateTime::createFromFormat( 'H:i', $_POST['ora']);
			$ora_fin = $date->format( 'H:i:s');
			$dispozitie = "";

			foreach ($_POST['info'] as $element) {
				$dispozitie = $element." ".$dispozitie; 
			}

			$query = $conn->prepare('SELECT * FROM PROGRAMARI WHERE ID = ?');
			$query->bind_param('i', $id_prog);

			$query->execute();
			$result = $query->get_result();
			$row = $result->fetch_assoc();

			$id_viz = $row['ID_VIZITATOR'];
			$id_det = $row['ID_DETINUT'];
			$data_viz_init = $row['DATA_VIZITEI']." 00:00:00";
			$data_format = date_create_from_format('Y-m-d H:i:s', $data_viz_init);
			$data_viz = date_format($data_format,"Y/m/d H:i:s");
			$nat_viz = $row['NATURA_VIZITEI'];
			$rez_disc = $row['REZUMATUL_DISCUTIEI'];
			$obiecte = $row['OBIECTE_ADUSE'];
			$relatie = $row['RELATIA_DETINUT'];

			$query = $conn->prepare('INSERT INTO VIZITE (ID_VIZITATOR, ID_DETINUT, DATA_VIZITEI, NATURA_VIZITEI, REZUMATUL_DISCUTIEI, OBIECTE_ADUSE, RELATIA_DETINUT, ORA, DURATA, NUME_MARTOR, OBIECTE_OFERITE, STARE_SPIRIT, STARE_SANATATE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$query->bind_param('iissssssissss', $id_viz, $id_det, $data_viz, $nat_viz, $rez_disc, $obiecte, $relatie, $ora_fin, $_POST['durata'], $_POST['martor'], $_POST['obiected'], $dispozitie, $_POST['sanatate']);
			$query->execute();
			$result = $query->get_result();

			if (! ($conn->errno == 0)) {
				echo $result."</br>";
				$message = "Eroare la inserare.</br>Redirectare spre pagina principala in 3 secunde.";
			}

			else {
				$query = $conn->prepare('DELETE FROM PROGRAMARI WHERE ID = ?');
				$query->bind_param('i', $id_prog);
				$query->execute();
				$result = $query->get_result();

				if (! ($conn->errno == 0)) {
					echo "Eroare la stergerea programarii din baza de date";
				}

				else {
					$message = "Vizita introdusa.</br>Redirectare spre pagina principala in 3 secunde.";
				}
			}
		}
	}

	echo $message;
	header('Refresh: 3;URL=admin.html');
}
?>
<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('connection.php');

$added = 0;
$message = 0;

if (! (isset($_POST["nume"]) && isset($_POST["prenume"]) && isset($_POST["datanastere"]) && isset($_POST["dataincarc"]) && isset($_POST["pedeapsa"]) && isset($_POST["crima"]))) {
	$message = "Atentie! Campuri obligatorii necompletate!</br>Redirectare spre pagina principala in 3 secunde.";
}

else {
	$nume = $_POST["nume"];
	$prenume = $_POST["prenume"];

	$datanastere_string = $_POST["datanastere"];
	$datanastere_format = date_create_from_format('Y-m-d H:i:s', $datanastere_string." 00:00:00");

	$dataincarc_string = $_POST["dataincarc"];
	$dataincarc_format = date_create_from_format('Y-m-d H:i:s', $dataincarc_string." 00:00:00");

	$data_current = date('Y-m-d H:i:s', time());

	if ($data_current < $dataincarc_string." 00:00:00") {
		$message = "Atentie! Data incarcerarii are valoare gresita.</br>Redirectare spre pagina principala in 3 secunde.";
	}

	else if ($data_current <= $datanastere_string." 00:00:00") {
		$message = "Atentie! Data nasterii are valoare gresita.</br>Redirectare spre pagina principala in 3 secunde.";	
	}

	else {

		$datanastere_fin = date_format($datanastere_format,"Y/m/d H:i:s");
		$dataincarc_fin = date_format($dataincarc_format,"Y/m/d H:i:s");

		$pedeapsa = $_POST["pedeapsa"];
		$crima = $_POST["crima"];

		$query = $conn->prepare('INSERT INTO DETINUTI (NUME, PRENUME, DATANASTERE, DATAINCARCERARE, PEDEAPSA, CRIMA) VALUES (?, ?, ?, ?, ?, ?)');
		$query->bind_param('ssssss', $nume, $prenume, $datanastere_fin, $dataincarc_fin, $pedeapsa, $crima);
		$query->execute();

		$result = $query->get_result();

		if (! ($conn->errno == 0)) {
			$message = "Eroare la inserare.</br>Redirectare spre pagina principala in 3 secunde.";
		}

		else {
			$message = "Inserare reusita.</br>Redirectare spre pagina principala in 3 secunde.";
		}
	}
}

echo $message;
header('Refresh: 3;URL=admin.php');
?>
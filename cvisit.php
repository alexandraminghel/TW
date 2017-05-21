<?php 
session_start();
require ('connection.php');

$added = 0;
$message = "";
$email = $_SESSION['email'];

if (! (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["date"]) && isset($_POST["reasonforvisit"]) && isset($_POST["related"])))
	$message = "Atentie! Campuri obligatorii necompletate!";

else if (strtolower($_POST["related"]) <> "avocat" && !isset($_POST["talksummary"]))
	$message = "Atentie! Campuri obligatorii necompletate!";

else {
	$lastname = $_POST["lastname"];
	$firstname = $_POST["firstname"];

	$query = $conn->prepare('SELECT id FROM detinuti WHERE nume like ? AND prenume like ?');
	$query->bind_param('ss', $lastname, $firstname);

	$query->execute();
	$result = $query->get_result();

	if (mysqli_num_rows($result) == 0) {
		$message = "Detinutul cu numele $lastname $firstname nu se afla in baza de date.";
	}

	else if (mysqli_num_rows($result) > 1) {
		$message = "Mai multi detinuti cu acelasi nume";
	}

	else {
		$date = $_POST["date"];
		$date_format = date_create_from_format('Y-m-d H:i:s', $date." 00:00:00");

		$date_current = date('Y-m-d H:i:s', time());

		if ($date_current > $date_format) {
			$message = "Programarea trebuie facuta cu cel putin o zi inainte!";
		} 

		else {
			$row = mysqli_fetch_row($result);
			$id_detinut = $row[0];
			$query = $conn->prepare('SELECT id FROM users where email like ?');
			$query->bind_param('s', $email);
			$query->execute();

			mysqli_free_result($result);
			$result = $query->get_result();

			$row = mysqli_fetch_row($result);
			$id_user = $row[0]; 

			$date_string = date_format($date_format,"Y/m/d H:i:s");

			$query = $conn->prepare('SELECT count(id) FROM programari where id_vizitator like ? and id_detinut like ? and data_vizitei like ?');
			$query->bind_param('iis', $id_user, $id_detinut, $date_string);
			$query->execute();

			mysqli_free_result($result);
			$result = $query->get_result();

 			if (mysqli_num_rows($result) > 0) {
				$message = "Aveti deja o programare pentru data respectiva la detinutul $lastname $firstname";
			}

			else {
				$reason = $_POST["reasonforvisit"];
			
				if ($_POST["objects"] == "") {
					$object = "-";
				}

				else { 
					$object = $_POST["objects"];
				}

				$talksummary = "-";

				if (strtolower($_POST["related"]) == "avocat" && !isset($_POST["talksummary"])) {
						$talksummary = "-";
				}

				else {
					$talksummary = $_POST["talksummary"]; 
				}
			
				$related = $_POST["related"];

				$query = $conn->prepare('INSERT INTO programari(ID_VIZITATOR, ID_DETINUT, DATA_VIZITEI, NATURA_VIZITEI, REZUMATUL_DISCUTIEI, OBIECTE_ADUSE, RELATIA_DETINUT) VALUES (?, ?, ?, ?, ?, ?, ?)');

				$query->bind_param('iisssss', $id_user, $id_detinut, $date_string, $reason, $talksummary, $object, $related);
				$query->execute();

				mysqli_free_result($result);
				$result = $query->get_result();
				$message = "Programare introdusa.";
			}
		}	
	}
}
?>


<?php 
session_start();
require_once ('userobject.php');
require_once ('detinutobject.php');
require_once ('functions.php');
require_once ('connection.php');

$added = 0;
$message = "";
$email = $_SESSION['email'];
$user = new User($email, $conn);

if (! (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["date"]) && isset($_POST["reasonforvisit"]) && isset($_POST["related"])))
	$message = "Atentie! Campuri obligatorii necompletate!";

else if (strtolower($_POST["related"]) <> "avocat" && !isset($_POST["talksummary"]))
	$message = "Atentie! Campuri obligatorii necompletate!";

else {
	$lastname = $_POST["lastname"];
	$firstname = $_POST["firstname"];

	$detinut = new Detinut($lastname, $firstname, $conn);

	if ($detinut->id == 0) {
		$message = "Detinutul cu numele $lastname $firstname nu se afla in baza de date.";
	}

	else {
		$date = $_POST["date"];
		$date_format = date_create_from_format('Y-m-d H:i:s', $date." 00:00:00");

		$date_current = date('Y-m-d H:i:s', time());

		if ($date_current > $date_format) {
			$message = "Programarea trebuie facuta cu cel putin o zi inainte!";
		} 

		else {
			$date_string = date_format($date_format,"Y/m/d H:i:s");

			$query = $conn->prepare('SELECT count(id) FROM programari where id_vizitator like ? and id_detinut like ? and data_vizitei like ?');
			$query->bind_param('iis', $user->id, $detinut->id, $date_string);
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

				$query->bind_param('iisssss', $user->id, $detinut->id, $date_string, $reason, $talksummary, $object, $related);
				$query->execute();

				mysqli_free_result($result);
				$result = $query->get_result();
				$message = "Programare introdusa.";
			}
		}	
	}
}
?>


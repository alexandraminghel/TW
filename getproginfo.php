<?php 
session_start();
require_once ('connection.php');
require_once ('userobject.php');
require_once ('detinutobject.php');

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

		echo "<form action=\"addcompleteinfo.php?id=".$prog_id."\" method=\"POST\">
					<div id=\"informatiiuser\">
						<div id=\"numeviz\"><p>Nume vizitator: </p><p id=\"numev\">".$user->nume."</p></div>";

		$detinut = new Detinut($row['ID_DETINUT'], $conn);

		echo "<div id=\"numedet\"><p>Nume detinut: </p><p id=\"numedetv\">".$detinut->nume."</p></div>
			  <div id=\"data\"><p>Data vizitei: </p><p id=\"datav\">".$row['DATA_VIZITEI']."</p></div>
			  <div id=\"motiv\"><p>Natura vizitei: </p><p id=\"motivv\">".$row['NATURA_VIZITEI']."</p></div>
			  <div id=\"rezumat\"><p>Rezumatul discutiei: </p><p id=\"rezumatv\">".$row['REZUMATUL_DISCUTIEI']."</p></div>
			  <div id=\"obiecte\"><p>Obiecte aduse: </p><p id=\"obiectev\">".$row['OBIECTE_ADUSE']."</p></div>
			  <div id=\"relatie\"><p>Relatia cu detinutul: </p><p id=\"relatiev\">".$row['RELATIA_DETINUT']."</p></div></div>
			  <ul class=\"flex\">
				<li><label for=\"ora\">Ora</label><input type=\"text\" name=\"ora\" id=\"ora\" placeholder=\"Ora vizitei (HH:MM)\"></li>
				<li><label for=\"durata\">Durata vizitei</label><input type=\"text\" name=\"durata\" id=\"durata\" placeholder=\"Durata vizitei (in minute)\"></li>
				<li><label for=\"martor\">Martorul vizitei</label><input type=\"text\" name=\"martor\" id=\"martor\" placeholder=\"Nume si prenume martor\"></li>
				<li><label for=\"obiected\">Obiecte oferite vizitatorului</label><textarea rows=\"2\" name=\"obiected\" id=\"obiected\" placeholder=\"Obiecte oferite vizitatorului\"></textarea></li>
				<li class=\"dispozitie\"><label for=\"dispozitie\">Starea de spirit a detinutului</label><input type=\"checkbox\" name=\"info[]\" id=\"dispozitie\" value=\"trist\">Trist<input type=\"checkbox\" name=\"info[]\" id=\"dispozitie\" value=\"agitat\">Agitat<input type=\"checkbox\" name=\"info[]\" id=\"dispozitie\" value=\"nervos\">Nervos<input type=\"checkbox\" name=\"info[]\" id=\"dispozitie\" value=\"fericit\">Fericit</li>
				<li class=\"sanatate\"><label for=\"sanatate\">Starea de sanatate a detinutului</label><input type=\"radio\" name=\"sanatate\" id=\"sanatate\" value=\"bolnav\">Bolnav<input type=\"radio\" name=\"sanatate\" id=\"sanatate\" value=\"sanatos\">Sanatos</li>
				<li><button type=\"submit\">Inregistrare vizita</button></li></ul></form>";	
	}

	else {
		$ok = 0;
		echo "<h2> ATENTIE! PROGRAMAREA CU ID-UL ".$prog_id." NU EXISTA! </h2></br>";
	}
}

else {
	echo "<h2> ATENTIE! ID INCORECT! </h2></br>";
}
?>

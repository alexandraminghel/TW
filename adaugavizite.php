<?php  
require_once('connection.php');

$nume = array('SMITH','JOHNSON','WILLIAMS','JONES','BROWN','DAVIS','MILLER','WILSON','MOORE','TAYLOR','ANDERSON','THOMAS','JACKSON','WHITE','HARRIS','MARTIN','THOMPSON','GARCIA','MARTINEZ','ROBINSON','JAMES','WATSON','BROOKS','KELLY','SANDERS','PRICE','BENNETT','WOOD','BARNES','ROSS','HENDERSON','COLEMAN','JENKINS','PERRY','POWELL','LONG','PATTERSON','HUGHES','FLORES','WASHINGTON','BUTLER','SIMMONS','FOSTER','GONZALES','BRYANT','ALEXANDER','RUSSELL','GRIFFIN','DIAZ','HAYES','MYERS','FORD','HAMILTON','GRAHAM','SULLIVAN','WALLACE','WOODS','COLE','WEST','JORDAN','OWENS','REYNOLDS','FISHER','ELLIS','HARRISON','GIBSON','MCDONALD','CRUZ','MARSHALL','ORTIZ','GOMEZ','MURRAY','FREEMAN','WELLS','WEBB','SIMPSON','STEVENS','TUCKER','PORTER','HUNTER','HICKS','CRAWFORD','HENRY','BOYD','MASON','MORALES','KENNEDY','WARREN','DIXON','RAMOS','REYES','BURNS','GORDON','SHAW','HOLMES','RICE','ROBERTSON','HUNT');

$prenume = array('JAMES','JOHN','ROBERT','MICHAEL','MARY','WILLIAM','DAVID','RICHARD','CHARLES','JOSEPH','THOMAS','PATRICIA','CHRISTOPHER','LINDA','BARBARA','DANIEL','ELIZABETH','JENNIFER','SUSAN','MARGARET','BLANCHE','JULIAN','EUNICE','ANGIE','ALFREDO','LYNDA','IVAN','INEZ','FREDDIE','DAVE','ALBERTO','MADELINE','DARYL','BYRON','AMELIA', 'ALBERTA','SONYA','PERRY','MORRIS','MONIQUE','MAGGIE','KRISTINE','KAYLA','JODI','JANIE','ISAAC','GENEVIEVE','CANDACE','BETSY','ANDRES','WM','TOMMIE','TERI','ROBBIE','MEREDITH','MERCEDES','MARCO','LYNETTE','EULA','CRISTINA','ARCHIE','ALTON','SOPHIA','ROCHELLE','RANDOLPH','PETE','MERLE','MEGHAN','JONATHON','GRETCHEN','GERARDO','GEOFFREY','GARRY','FELIPE','ELOISE');

$status = array("Sot", "Prieten", "Ruda", "Avocat");
$obiecte = array("Poze", "Carte", "Mancare");
$rezumat = array("Evenimente din familie", "Decursul procesului", "Membrii ai familiei");
$tip = array("Vizita de familie", "Vizita amicala", "Informare proces", "Probleme legale");
$spirit = array("trist", "agitat", "nervos", "fericit");
$sanatate = array("sanatos", "bolnav");

$query = $conn->prepare('SELECT COUNT(*) FROM programari');
$query->execute();
$result = $query->get_result();

for($index = 1; $index <= 3000; $index++) {

	$id_viz = rand(1, 301);
	$id_det = rand(1, 100);

	$status_viz = "-";
	$rezumat_viz = "-";
	$obiecte_viz = "-";
	$obiecte_det = "-";
	$tip_viz = "-";

	$datestart = strtotime('2009-01-01');
	$dateend = strtotime('-1 day', time());
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

	$ora_start = strtotime('09:00');
	$ora_end = strtotime('17:00');
	$ora_rand = rand($ora_start, $ora_end);	

	$ora_fin = date('H:i:s', $ora_rand);

	$durata = rand(10, 40);

	$nume_martor_index = array_rand($nume, 1);
	$nume_martor = $nume[$nume_martor_index];

	$prenume_martor_index = array_rand($prenume, 1);
	$prenume_martor = $prenume[$prenume_martor_index];

	$nume_fin = $nume_martor." ".$prenume_martor;

	$nr_obiecte = rand(0,1);

	if ($nr_obiecte == 1) { 
		$obiecte_det = "Documente";
	}

	$spirit_det_index = array_rand($spirit, 1);
	$spirit_det = $spirit[$spirit_det_index];

	$sanatate_det_index = array_rand($sanatate, 1);
	$sanatate_det = $sanatate[$sanatate_det_index]; 

	$query = $conn->prepare('INSERT INTO vizite (ID_VIZITATOR, ID_DETINUT, DATA_VIZITEI, NATURA_VIZITEI, REZUMATUL_DISCUTIEI, OBIECTE_ADUSE, RELATIA_DETINUT, ORA, DURATA, NUME_MARTOR, OBIECTE_OFERITE, STARE_SPIRIT, STARE_SANATATE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
	$query->bind_param('iissssssissss', $id_viz, $id_det, $date_viz, $tip_viz, $rezumat_viz, $obiecte_viz, $status_viz, $ora_fin, $durata, $nume_fin, $obiecte_det, $spirit_det, $sanatate_det);
	$query->execute();
}
?>
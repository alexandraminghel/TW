<?php  
require_once('connection.php');
require_once('userobject.php');

$parola = password_hash("parola",PASSWORD_DEFAULT);
$nume = array('SMITH','JOHNSON','WILLIAMS','JONES','BROWN','DAVIS','MILLER','WILSON','MOORE','TAYLOR','ANDERSON','THOMAS','JACKSON','WHITE','HARRIS','MARTIN','THOMPSON','GARCIA','MARTINEZ','ROBINSON','JAMES','WATSON','BROOKS','KELLY','SANDERS','PRICE','BENNETT','WOOD','BARNES','ROSS','HENDERSON','COLEMAN','JENKINS','PERRY','POWELL','LONG','PATTERSON','HUGHES','FLORES','WASHINGTON','BUTLER','SIMMONS','FOSTER','GONZALES','BRYANT','ALEXANDER','RUSSELL','GRIFFIN','DIAZ','HAYES','MYERS','FORD','HAMILTON','GRAHAM','SULLIVAN','WALLACE','WOODS','COLE','WEST','JORDAN','OWENS','REYNOLDS','FISHER','ELLIS','HARRISON','GIBSON','MCDONALD','CRUZ','MARSHALL','ORTIZ','GOMEZ','MURRAY','FREEMAN','WELLS','WEBB','SIMPSON','STEVENS','TUCKER','PORTER','HUNTER','HICKS','CRAWFORD','HENRY','BOYD','MASON','MORALES','KENNEDY','WARREN','DIXON','RAMOS','REYES','BURNS','GORDON','SHAW','HOLMES','RICE','ROBERTSON','HUNT');

$prenume = array('JAMES','JOHN','ROBERT','MICHAEL','MARY','WILLIAM','DAVID','RICHARD','CHARLES','JOSEPH','THOMAS','PATRICIA','CHRISTOPHER','LINDA','BARBARA','DANIEL','ELIZABETH','JENNIFER','SUSAN','MARGARET','BLANCHE','JULIAN','EUNICE','ANGIE','ALFREDO','LYNDA','IVAN','INEZ','FREDDIE','DAVE','ALBERTO','MADELINE','DARYL','BYRON','AMELIA', 'ALBERTA','SONYA','PERRY','MORRIS','MONIQUE','MAGGIE','KRISTINE','KAYLA','JODI','JANIE','ISAAC','GENEVIEVE','CANDACE','BETSY','ANDRES','WM','TOMMIE','TERI','ROBBIE','MEREDITH','MERCEDES','MARCO','LYNETTE','EULA','CRISTINA','ARCHIE','ALTON','SOPHIA','ROCHELLE','RANDOLPH','PETE','MERLE','MEGHAN','JONATHON','GRETCHEN','GERARDO','GEOFFREY','GARRY','FELIPE','ELOISE');

for($index = 0; $index < 300; ++$index) {

	$nume_user_index = array_rand($nume, 1);
	$nume_user = $nume[$nume_user_index];

	$prenume_user_index = array_rand($prenume, 1);
	$prenume_user = $prenume[$prenume_user_index];

	$user = new User($nume_user, $prenume_user, $conn);

	if ($user->id != 0) {
		$index--;
	}

	else {
		$email = strtolower($nume_user).strtolower($prenume_user)."@gmail.com";
		$poza = "poze/".$email.".jpg";
		$telefon = "074";
	
		for($index2 = 1; $index2 <= 7; ++$index2) {
			$telefon = $telefon.(rand(0, 9));
		}

		$query = $conn->prepare('INSERT INTO users (NUME, PRENUME, EMAIL, PAROLA, TELEFON, POZA) VALUES (?, ?, ?, ?, ?, ?)');
		$query->bind_param('ssssss', $nume_user, $prenume_user, $email, $parola, $telefon, $poza);
		$query->execute();
	}
}

?>
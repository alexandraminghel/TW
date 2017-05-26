<?php  
require_once('connection.php');

$crimasipedeapsa = array("Omor premeditat" => "35", "Evaziune fiscala" => "20", "Viol" => "15", "Furt" => "10", "Pedofilie" => "50", "Violenta domestica" => "10");

$prenume = array('ANTHONY','KEVIN','JASON','MATTHEW','GARY','TIMOTHY','JOSE','LARRY','JEFFREY','FRANK','SCOTT','ERIC','STEPHEN','ANDREW','RAYMOND','JERRY','GREGORY','JOSHUA','DENNIS','WALTER','WILLIE','PATRICK','TERRY','PETER','HAROLD','HENRY','DOUGLAS','CARL','ARTHUR','RYAN','JOE','ROGER','IAN','KEN','BOB','ALFREDO','IVAN','INEZ','FREDDIE','DAVE','ALBERTO','DARYL','BYRON','MORRIS','ISAAC','WILLARD','VIRGIL','ROSS','ABRAHAM','RUDOLPH','PRESTON','MALCOLM','KELVIN','JOHNATHAN','DAMON','CESAR','ANDRES','WM','TOMMIE','TERI','ROBBIE','MARCO','ARCHIE','ALTON','SOPHIA','ROCHELLE','RANDOLPH','PETE','MERLE','MEGHAN','JONATHON','GRETCHEN','GERARDO','GEOFFREY','GARRY','FELIPE','ELOISE','ED','DOMINIC','DEVIN','CECELIA','CARROLL','RAQUEL','LUCAS','GUILLERMO','EARNEST','DELBERT','COLIN','CLARK','BRYANT','WOODROW','LANDON','JACQUES','HUNG','HOUSTON','HONG','GUSSIE','GERMAN','GERMAINE','GERI','GENARO','FLETCHER','ERROL','EMORY','EMERSON','ELDA','ELBA','EDYTHE','EDWARDO','DORIAN','DIRK','DAREN','DANIAL','DALTON','CORNELL','CARYN','CARSON','BUFORD','BRANDIE','BRANDEN','BOOKER','BENNETT','ARRON','ANTONY');

$nume = array('MYERS','FORD','HAMILTON','GRAHAM','SULLIVAN','WALLACE','WOODS','COLE','WEST','JORDAN','OWENS','REYNOLDS','FISHER','ELLIS','HARRISON','GIBSON','MCDONALD','CRUZ','MARSHALL','ORTIZ','GOMEZ','MURRAY','FREEMAN','WELLS','WEBB','SIMPSON','STEVENS','TUCKER','PORTER','HUNTER','HICKS','CRAWFORD','HENRY','BOYD','MASON','MORALES','KENNEDY','WARREN','DIXON','RAMOS','REYES','BURNS','GORDON','SHAW','HOLMES','RICE','ROBERTSON','HUNT','BLACK','DANIELS','PALMER','MILLS','NICHOLS','GRANT','KNIGHT','FERGUSON','ROSE','STONE','HAWKINS','DUNN','PERKINS','HUDSON','SPENCER','GARDNER','STEPHENS','PAYNE','PIERCE','BERRY','MATTHEWS','ARNOLD','WAGNER','WILLIS','RAY','WATKINS','OLSON','CARROLL','DUNCAN','SNYDER','HART','CUNNINGHAM','BRADLEY','LANE','ANDREWS','RUIZ','HARPER','FOX','RILEY','ARMSTRONG','CARPENTER','WEAVER','GREENE','LAWRENCE','ELLIOTT','CHAVEZ','SIMS','AUSTIN','PETERS','KELLEY','FRANKLIN','LAWSON','FIELDS','GUTIERREZ','RYAN','SCHMIDT','CARR','VASQUEZ','CASTILLO','WHEELER','CHAPMAN','OLIVER','MONTGOMERY','RICHARDS','WILLIAMSON','JOHNSTON','BANKS','MEYER','BISHOP','MCCOY','HOWELL','ALVAREZ','MORRISON','HANSEN','FERNANDEZ','GARZA','HARVEY','LITTLE','BURTON','STANLEY','NGUYEN','GEORGE','JACOBS','REID','KIM','FULLER','LYNCH','DEAN','GILBERT','GARRETT','ROMERO','WELCH','LARSON','FRAZIER','BURKE','HANSON','DAY','MENDOZA','MORENO','BOWMAN','MEDINA','FOWLER','BREWER','HOFFMAN','CARLSON','SILVA','PEARSON','HOLLAND','DOUGLAS','FLEMING','JENSEN','VARGAS','BYRD');

for($index = 1; $index <= 100; $index++) {

	$datestart = strtotime('1955-01-01');
	$dateend = strtotime('1990-12-31');
	$data_nastere_rand = rand($datestart, $dateend);
	$data_nastere = date('Y/m/d H:i:s', $data_nastere_rand);

	$datestart = strtotime('2009-01-01');
	$dateend = time();
	$date_incarcerare_rand = rand($datestart, $dateend);	
	$date_incarcerare = date('Y/m/d H:i:s', $date_incarcerare_rand);

	$nume_det_index = array_rand($nume, 1);
	$nume_det = $nume[$nume_det_index];
	$prenume_det_index = array_rand($prenume, 1);
	$prenume_det = $prenume[$prenume_det_index];

	$crima = array_rand($crimasipedeapsa, 1);
	$pedeapsa = $crimasipedeapsa[$crima];

	$query = $conn->prepare('INSERT INTO detinuti (NUME, PRENUME, DATANASTERE, DATAINCARCERARE, PEDEAPSA, CRIMA) VALUES (?, ?, ?, ?, ?, ?)');
	$query->bind_param('ssssis', $nume_det, $prenume_det, $data_nastere, $date_incarcerare, $pedeapsa, $crima);
	$query->execute();
}
?>
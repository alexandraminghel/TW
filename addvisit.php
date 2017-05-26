<?php
  require('checksession.php');
  require('getproginfo.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Adauga vizita</title>
	<meta charset = "utf-8" name = "viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" type = "text/css" href = "addvisit.css">
</head>
<body>
	<div class = "sidebar">
		<div class = "title">
			<img src = "admin.jpg" class = "imagine">
			<p class = "text">Administrator</p>
		</div>
		<ul class = "nav">
			<li class = "nav-item1">
				<img src = "acasa.png" class = "nav-item1img">
				<a href="admin.php">Cerere Programari</a>
			</li>
			<li class = "nav-item2">
				<img src = "users.png" class = "nav-item2img">
				<a href="admin-utilizatori.php">Utilizatori</a>
			</li>
			<li class = "nav-item3">
				<img src = "detinuti.png" class = "nav-item3img">
				<a href="detinuti.php">Detinuti</a>
			</li>
			<li class = "nav-item4">
				<img src = "statistici.png" class = "nav-item4img">
				<a href="statisticsadmin.html">Statistici</a>
			</li>
			<li class = "logout">
				<a href = "logout.php">Logout</a>
			</li>
		</ul>
	</div>
	<div class = "header">
	<div class = "header-logout">
			<ul>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class = "continut">
		<h4><?php echo $message; ?></h4>
		<form action=<?php echo "\"addcompleteinfo.php?id=".$prog_id."\""; ?> method="POST">
			<div id="informatiiuser">
				<div id="numeviz">
					<p>Nume vizitator: </p>
					<p id="numev"><?php echo $user->nume; ?></p>
				</div>
				<div id="numedet">
					<p>Nume detinut: </p>
					<p id="numedetv"><?php echo $detinut->nume; ?></p>
				</div>
			  	<div id="data">
			  		<p>Data vizitei: </p>
			  		<p id="datav"><?php echo $data_viz; ?></p>
			  	</div>
			  	<div id="motiv">
			  		<p>Natura vizitei: </p>
			  		<p id="motivv"><?php echo $nat_viz; ?></p>
			  	</div>
			  	<div id="rezumat">
			  		<p>Rezumatul discutiei: </p>
			  		<p id="rezumatv"><?php echo $rez_disc; ?></p>
			  	</div>
			  	<div id="obiecte">
			  		<p>Obiecte aduse: </p>
			  		<p id="obiectev"><?php echo $obj_aduse; ?></p>
			  	</div>
			  	<div id="relatie">
			  		<p>Relatia cu detinutul: </p>
			  		<p id="relatiev"><?php echo $rel_det; ?></p>
			  	</div>
			</div>
			<ul class="flex">
				<li>
					<label for="ora">Ora</label>
					<input type="text" name="ora" id="ora" placeholder="Ora vizitei (HH:MM)">
				</li>
				<li>
					<label for="durata">Durata vizitei</label>
					<input type="text" name="durata" id="durata" placeholder="Durata vizitei (in minute)">
				</li>
				<li>
					<label for="martor">Martorul vizitei</label>
					<input type="text" name="martor" id="martor" placeholder="Nume si prenume martor">
				</li>
				<li>
					<label for="obiected">Obiecte oferite vizitatorului</label>
					<textarea rows="2" name="obiected" id="obiected" placeholder="Obiecte oferite vizitatorului"></textarea>
				</li>
				<li class="dispozitie">
					<label for="dispozitie">Starea de spirit a detinutului</label>
					<input type="checkbox" name="info[]" id="dispozitie" value="trist">Trist
					<input type="checkbox" name="info[]" id="dispozitie" value="agitat">Agitat
					<input type="checkbox" name="info[]" id="dispozitie" value="nervos">Nervos
					<input type="checkbox" name="info[]" id="dispozitie" value="fericit">Fericit
				</li>
				<li class="sanatate">
					<label for="sanatate">Starea de sanatate a detinutului</label>
					<input type="radio" name="sanatate" id="sanatate" value="bolnav">Bolnav
					<input type="radio" name="sanatate" id="sanatate" value="sanatos">Sanatos
				</li>
				<li>
					<button type="submit">Inregistrare vizita</button>
				</li>
			</ul>
		</form>	
	</div>
</body>
</html>
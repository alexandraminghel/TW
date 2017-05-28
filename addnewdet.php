<?php
require_once('checksession.php');
require_once('checkadmin.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Adauga detinut</title>
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
				<a href="utilizatori.php">Utilizatori</a>
			</li>
			<li class = "nav-item3">
				<img src = "detinuti.png" class = "nav-item3img">
				<a href="detinuti.php">Detinuti</a>
			</li>
			<li class = "nav-item4">
				<img src = "statistici.png" class = "nav-item4img">
				<a href="statisticsadmin.php">Statistici</a>
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
		<br>
		<form action="addnewconv.php" method="POST">
			<ul class="flex">
				<li>
					<label for="nume">Nume</label>
					<input type="text" name="nume" id="nume" placeholder="Numele de familie">
				</li>
				<li>
					<label for="prenume">Prenume</label>
					<input type="text" name="prenume" id="prenume" placeholder="Prenumele">
				</li>
				<li>
					<label for="datanastere">Data nasterii</label>
					<input type="text" name="datanastere" id="datanastere" placeholder="Data nasterii (aaaa-ll-zz)">
				</li>
				<li>
					<label for="dataincarc">Data incarcerarii</label>
					<input type="text" name="dataincarc" id="dataincarc" placeholder="Data incarcerarii (aaaa-ll-zz)">
				</li>
				<li>
					<label for="datanastere">Pedeapsa</label>
					<input type="text" name="pedeapsa" id="pedeapsa" placeholder="Pedeapsa in ani">
				</li>
				<li>
					<label for="crima">Crima</label>
					<input type="text" name="crima" id="crima" placeholder="Crima pentru care este inchis">
				</li>
				<li>
					<button type="submit">Adauga detinut</button>
				</li>
			</ul>
		</form>	
	</div>
</body>
</html>
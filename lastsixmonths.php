<?php
require_once('checksession.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Statistici ultimele 6 luni</title>
	<meta charset = "utf-8" name = "viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" type = "text/css" href = "statisticsadminlm.css">
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
				<a href="admin-utilizatori.html">Utilizatori</a>
			</li>
			<li class = "nav-item3">
				<img src = "detinuti.png" class = "nav-item3img">
				<a href="detinuti.html">Detinuti</a>
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
		<div class = "line0">
			<h2 id = "lm">Statistici pentru ultimele 6 luni</h2>
		</div>
		<div class = "line1">
			<div class = "statisticsid">
				<form id = "IDsearch" action="lastsixmonthsdet.php" method="post">
					<label class = "textid" for = "id"> Statistici din ultimele 6 luni pentru detinutul</label>
						<input type = "text" name = "id" placeholder="ID">
						<button type = "submit">Cauta</button>
				</form>
			</div>
		</div>

		<div class = "graphs">
			<img src="Visitors.jpg" class = "img1" alt = "grafic vizitatori">
			<img src="population.jpg" class = "img2" alt = "grafic populatie">
		</div>
		
		<ul class = "optiuni">
			<li><a href = "lastmonth.html">Vizite ultima luna</a></li>
			<li><a href = "lastyear.html">Vizite ultimul an</a></li>
		</ul>
	</div>
</body>
</html>

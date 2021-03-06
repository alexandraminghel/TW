<?php  
session_start();
require_once('checksession.php');
require_once('getstatisticstoday.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Statistici</title>
	<meta charset = "utf-8" name = "viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" type = "text/css" href = "statisticsadmin.css">
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
		<div class = "line1">
			<div class = "vizitatori">
				<div class = "textviz">Vizitatori astazi</div>
				<div class = "nrviz"> <h3 id = "numviz"> <?php echo $nr_visits; ?> </h3></div>
			</div>
			<div class = "statisticsid">
				<form id = "IDsearch" action="statisticsdetinut.php" method="post">
					<label class = "textid" for = "id"> Statistici pentru detinutul</label>
					<input type = "text" name = "id" placeholder="ID">
					<button type = "submit">Cauta</button>
				</form>
				<form id="crimesearch" action="statisticscrime.php" method="post">
					<label class = "textid" for = "crima"> Statistici pentru pedeapsa</label>
					<input type = "text" name = "crima" placeholder="Pedeapsa">
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
			<li><a href = "lastsixmonths.php">Vizite ultimele 6 luni</a></li>
			<li><a href = "lastyear.html">Vizite ultimul an</a></li>
		</ul>
	</div>
</body>
</html>
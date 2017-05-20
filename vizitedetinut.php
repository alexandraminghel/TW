<!DOCTYPE html>
<html>
<head>
	<title>Vizite detinut</title>
	<meta charset = "utf-8" name = "viewport" content="width=device-width, initial-scale=1">
	<link rel = "stylesheet" type = "text/css" href = "vizitedetinut.css">
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
				<a href = "#">Pagina de start</a>
			</li>
			<li class = "nav-item2">
				<img src = "users.png" class = "nav-item2img">
				<a href = "#">Utilizatori</a>
			</li>
			<li class = "nav-item3">
				<img src = "detinuti.png" class = "nav-item3img">
				<a href = "#">Detinuti</a>
			</li>
			<li class = "nav-item4">
				<img src = "statistici.png" class = "nav-item4img">
				<a href = "#">Statistici</a>
			</li>
			<li class = "logout">
				<a href = "loginpage.html">Logout</a>
			</li>
		</ul>
	</div>
	<div class = "header">
	<div class = "header-logout">
			<ul>
				<li><a href="loginpage.html">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class = "continut">
		<a href="detinuti.html" class="back">Inapoi</a>
		<div class = "line1">
			<h2 id = "lm">Vizitele detinutului:</h2>
			<h2 id = "numeprenume"><?php require('functions.php'); echo getNameConvict();?></h2>
		</div>
		<?php
			require('cautavizitedet.php');
		?>
	</div>
</body>
</html>
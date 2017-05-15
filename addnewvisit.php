<?php
require ('cvisit.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Programare vizita</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="scheletvisit.css">
</head>
<body>
	<div class = "userheader">

		<div class = "usernav">
			<ul>
				<li><a href="newvisit.html">Acasa</a></li>
				<li><a href="users-contact.html">Contact</a></li>
				<li><a href="arhivauser.html">Arhiva</a></li>
				<li><a href="loginpage.html">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class = "wrap">
		<main>
			<div class = "wrapmain">
				<h2>
				<?php
					echo $message;  
				?>
				</h2>
	    	</div>
		</main>
		<div class = "nav1">
			<div class = "userimg">
				<img src="admin.png" class="imagine">
			</div>
			<a href = "newvisit.html" class = "linknume"><div id = "nume">Popescu Maria</div></a>
			<div class = "infotable">
				<table class = "info">
					<tr>
						<td>Ultima logare </td>
						<td id = "datalog">19.04.2017</td>
					</tr>
					<tr id = "ultimul">
						<td>Ultima vizita </td>
						<td id = "dataviz">14.04.2017</td>
					</tr>
				</table>
			</div>
		</div>
	</div>	
</body>
</html>
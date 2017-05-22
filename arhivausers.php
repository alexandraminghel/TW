<?php  
require_once('checksession.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Arhiva vizite</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="arhiva.css">
</head>
<body>
	<div class = "userheader">
		<div class = "usernav">
			<ul>
				<li><a href="newvisit.php">Acasa</a></li>
				<li><a href="users-contact.html">Contact</a></li>
				<li><a href="arhivauser.php">Arhiva</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class = "wrap">
		<main>
			<div class = "wrapmain">
				<h2>Arhiva vizite</h2>
				<?php 
					require('getusersvisit.php');
				?>
	    	</div>
		</main>
		<?php
			require('infouser.php');
		?>
	</div>	
</body>
</html>
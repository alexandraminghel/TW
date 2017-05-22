<?php
require_once ('cvisit.php');
require_once ('infouser.php');
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
				<h2>
				<?php
					echo $message;  
				?>
				</h2>
	    	</div>
		</main>
		<div class = "nav1">
      		<div class = "userimg">
        		<img src=<?php echo "\"".$user->poza."\"";?> class="imagine">
      		</div>
      		<a href = "newvisit.php" class = "linknume"><div id = "nume"><?php echo $user->nume; ?></div></a>
      		<div class = "infotable">
        		<table class = "info">
          			<tr>
            			<td>Numar vizite programate</td>
            			<td id = "datalog"><?php echo $nr_programari; ?></td>
          			</tr>
          			<tr id = "ultimul">
            			<td>Ultima vizita </td>
            			<td id = "dataviz"><?php echo $ultima_viz; ?></td>
          			</tr>
        		</table>
      		</div>
    	</div>
	</div>	
</body>
</html>
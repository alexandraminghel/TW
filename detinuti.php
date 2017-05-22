<?php  
require_once('checksession.php');
require('getdet.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detinuti</title>
	<meta charset="utf-8" name = "viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="detinuti.css">
</head>
<body>
	<div class="sidebar">
		<div class="title">
			<img src="admin.jpg" class="imagine">
			<p class="text">Administrator</p>
		</div>
		<ul class="nav">
			<li class="nav-item1">
				<img src="acasa.png" class="nav-item1img">
				<a href="admin.php">Cerere Programari</a>
			</li>
			<li class="nav-item2">
				<img src="users.png" class="nav-item2img">
				<a href="admin-utilizatori.html">Utilizatori</a>
			</li>
			<li class="nav-item3">
				<img src="detinuti.png" class="nav-item3img">
				<a href="detinuti.php">Detinuti</a>
			</li>
			<li class="nav-item4">
				<img src="statistici.png" class="nav-item4img">
				<a href="statisticsadmin.html">Statistici</a>
			</li>
		</ul>
	</div>
	<div class="header">
	<div class = "header-logout">
			<ul>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class = "statisticsid">
				<form id = "IDsearch" method="post" action="detnume.php">
					<label class = "textid" for = "id"> Introduceti numele detinului cautat</label>
					<input type = "text" name = "numeprenume" placeholder="Nume Prenume">
					<button type = "submit">Cauta</button>
				</form>
			</div>
	<div class="afisare">
				<div class = "pagination">
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$last\"";?> >Inapoi</a>
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$page\"";?> >Inainte</a>
                </div>
                </br>
                <table class = "info">"
                <tr class="primul"><td>Nume</td><td>Prenume</td><td>Data nastere</td><td>Data incarcerare</td><td>Pedeapsa</td><td>Crima</td></tr>
                <?php
        				for($line = 0; $line < $rownum; ++$line) {
        					echo "<tr>";
        					for($column = 0; $column < 6; ++$column) {
        						echo "<td><a href=\"vizitedetinut.php?id=$id_det\">".$rows[$line][$column]."</td>";
        					}
        					echo "</tr>";
        				}
        			?>

                </table>
	</div>	
</body>
</html>
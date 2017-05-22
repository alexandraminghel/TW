<?php  
require_once('checksession.php');
require('getvisit.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8" name = "viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="admin.css">
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
	<div class="cerere">
	<h1>
		Cerere Programari
	</h1>
	</div>
	<div class="afisaremesaj">
		<div class = "pagination">
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$last\"";?> >Inapoi</a>
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$page\"";?> >Inainte</a>
        </div>
         <table class = "info">
        	</br>
        	<?php
        	if($line==0)  echo $message;
        	else{
        	echo "<tr class=\"primul\"><td>Nume vizitator</td><td>Detinut</td>";
        	
        	
        				for($line = 0; $line < $rownum; ++$line) {
        					echo "<tr>";
        					for($column = 0; $column < 2; ++$column) {
        						echo "<td><a href=\"addvisit.php?id=$id_viz\">".$rows[$line][$column]."</td>";
        					}
        					echo "</tr>";
        				}
        			}
        			?>
        		</table>

	</div>
	
</body>
</html>
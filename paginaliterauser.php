<?php  
require_once('checksession.php');
require('cautautilizatorilitera.php');
require_once('checkadmin.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detinuti</title>
	<meta charset="utf-8" name = "viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="admin-utilizatori.css">
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
				<a href="admin-utilizatori.php">Utilizatori</a>
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
				<button class="buton1"><a href="cautautilizator.php">Cauta un utilizator</a></button>
	
			
			</div>	
	<div class="afisare">
				<div class = "pagination">
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$last&litera=$litera\"; >".$Inapoi."</a>"?>
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$page&litera=$litera\"; >".$Inainte."</a>"?>
                </div>
                <div class="categorii">
		        
			    <a class="alf" href="paginaliterauser.php?litera=A">A</a>
                <a class="alf" href="paginaliterauser.php?litera=B">B</a>
                <a class="alf" href="paginaliterauser.php?litera=C">C</a>
			    <a class="alf" href="paginaliterauser.php?litera=D">D</a>
			    <a class="alf" href="paginaliterauser.php?litera=E">E</a>
			    <a class="alf" href="paginaliterauser.php?litera=F">F</a>
			    <a class="alf" href="paginaliterauser.php?litera=G">G</a>
			    <a class="alf" href="paginaliterauser.php?litera=H">H</a>
			    <a class="alf" href="paginaliterauser.php?litera=I">I</a>
			    <a class="alf" href="paginaliterauser.php?litera=J">J</a>
			    <a class="alf" href="paginaliterauser.php?litera=K">K</a>
			    <a class="alf" href="paginaliterauser.php?litera=L">L</a>
			    <a class="alf" href="paginaliterauser.php?litera=M">M</a>
			    <a class="alf" href="paginaliterauser.php?litera=N">N</a>
			    <a class="alf" href="paginaliterauser.php?litera=O">O</a>
			    <a class="alf" href="paginaliterauser.php?litera=P">P</a>
			    <a class="alf" href="paginaliterauser.php?litera=Q">Q</a>
			    <a class="alf" href="paginaliterauser.php?litera=R">R</a>
			    <a class="alf" href="paginaliterauser.php?litera=S">S</a>
			    <a class="alf" href="paginaliterauser.php?litera=T">T</a>
			    <a class="alf" href="paginaliterauser.php?litera=U">U</a>
			    <a class="alf" href="paginaliterauser.php?litera=V">V</a>
			    <a class="alf" href="paginaliterauser.php?litera=W">W</a>
			    <a class="alf" href="paginaliterauser.php?litera=X">X</a>
			    <a class="alf" href="paginaliterauser.php?litera=Y">Y</a>
			    <a class="alf" href="paginaliterauser.php?litera=Z">Z</a>
			    
			    </div>
                </br>
                <table class = "info">
                </br>
                <?php
        	
        		echo "<div class=\"mesaj\">".$message."</div>";
                echo "<tr class=\"primul\"><td>".$NumeTabel."</td><td>".$PrenumeTabel."</td><td>".$EmailTabel."</td><td>".$TelefonTabel."</td></tr>";
                
        				for($line = 0; $line < $rownum; ++$line) {
        					echo "<tr>";
        					for($column = 0; $column < 4; ++$column) {
        						echo "<td><a href=\"vizitedetinut.php?id=$id_det\">".$rows[$line][$column]."</td>";
        					}
        					echo "</tr>";
        				}
        			
        			?>

                </table>
	</div>	
</body>
</html>
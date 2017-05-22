<?php
require_once('checksession.php');
require_once('cautavizitedet.php');
?>
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
				<a href = "admin.php">Pagina de start</a>
			</li>
			<li class = "nav-item2">
				<img src = "users.png" class = "nav-item2img">
				<a href = "users.php">Utilizatori</a>
			</li>
			<li class = "nav-item3">
				<img src = "detinuti.png" class = "nav-item3img">
				<a href = "detinuti.php">Detinuti</a>
			</li>
			<li class = "nav-item4">
				<img src = "statistici.png" class = "nav-item4img">
				<a href = "statisticsadmin.php">Statistici</a>
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
		<a href="detinuti.php" class="back">Inapoi</a>
		<?php echo $message; ?>
		<div class = "line1">
			<h2 id = "lm">Vizitele detinutului:</h2>
			<h2 id = "numeprenume"><?php echo $detinut->nume;?></h2>
		</div>
		<div class = "pagination">
        	<a href = <?php echo "\"$_SERVER[PHP_SELF]?id=$id_detinut&page=$last\"";?> >Inapoi</a>
        	<a href = <?php echo "\"$_SERVER[PHP_SELF]?id=$id_detinut&page=$page\"";?> >Inainte</a>
        </div>
        </br>
        <table class = "vizite">
        	<th>ID</th><th>Data</th><th>Ora</th><th>Durata</th><th>Nume</th><th>Natura vizitei</th><th>Relatie</th><th id="discutie">Rezumatul discutiei</th><th id="obiecte">Obiecte aduse</th><th id="obiecte">Obiecte oferite</th>
        	<?php
        		for($line = 0; $line < $rownum; ++$line) {
        			echo "<tr>";
        			for($column = 0; $column < 10; ++$column) {
        				echo "<td>".$rows[$line][$column]."</td>";
        			}
        			echo "</tr>";
        		}
        	?>
        </table>
	</div>
</body>
</html>
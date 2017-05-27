<?php  
require_once('checksession.php');
require_once('infouser.php');
require_once('getusersvisit.php');
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
				<li><a href="arhivausers.php">Arhiva</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class = "wrap">
		<main>
			<div class = "wrapmain">
				<h2>Arhiva vizite</h2>
				<?php echo $message; ?>
				<div class = "pagination">
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$last\"";?> >Inapoi</a>
        		<a href = <?php echo "\"$_SERVER[PHP_SELF]?page=$page\"";?> >Inainte</a>
        </div>
        </br>
        <table class = "vizite">
          <th><td>ID</td><td>Data</td><td>Ora</td><td>Nume detinut</td><td>Prenume detinut</td><td>Natura vizitei</td><td>Relatia cu detinutul</td></th>
        			<?php
        				for($line = 0; $line < $rownum; ++$line) {
        					echo "<tr>";
        					for($column = 0; $column < 7; ++$column) {
        						echo "<td>".$rows[$line][$column]."</td>";
        					}
        					echo "</tr>";
        				}
        			?>
        		</table>
	    	</div>
		</main>
		<div class = "nav1">
      		<div class = "userimg">
        		<img src=<?php echo "\"".$poza."\"";?> class="imagine">
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
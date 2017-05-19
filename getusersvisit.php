<?php  
session_start();
require ('connection.php');
//require ('functions.php');
$email = $_SESSION['email'];
$message = "";

$query = "SELECT id FROM users where email like '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$id_viz = $row[0];

$query = "SELECT count(*) FROM programari where id_vizitator like '$id_viz'";
mysqli_free_result($result);
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$nr_progs = $row[0];

if ($nr_progs == 0) {
 	$message = "Nu aveti inca nici o vizita realizata.";
    echo $message;
}
else {
	$limit = 1;
	$pages = ceil($nr_progs / $limit);

	if ( isset($_GET["page"]) ) {
		$page = $_GET["page"];
    	$offset = $limit * ($page - 1);
	} 

	else {
    	$page = 1;
    	$offset = 0;
	}

	$query = "SELECT p.id as \"ID\", d.nume as \"NUME\", d.prenume as \"PRENUME\", p.DATA_VIZITEI, p.NATURA_VIZITEI, p.RELATIA_DETINUT FROM programari p join detinuti d on p.id_detinut = d.id where p.id_vizitator like '$id_viz' LIMIT $limit OFFSET $offset";
	mysqli_free_result($result);
	$result = mysqli_query($conn, $query, MYSQLI_USE_RESULT);

	if (! $result) {
    	$message = "Nu aveti inca nici o vizita realizata";
    	echo $message;
	}

	else {
		if ($page > 1) {

			if( $page == $pages ) {
        		$last = $page - 1;
        		echo "<a href = \"$_SERVER[PHP_SELF]?page=$last\">Inapoi</a>";
     		}

     		else {
        		$last = $page - 1;
        		$page = $page + 1;
        		echo "<div class = "movelinks">";
        		echo "<a href = \"$_SERVER[PHP_SELF]?page=$last\">Inapoi</a> | ";
        		echo "<a href = \"$_SERVER[PHP_SELF]?page=$page\">Inainte</a>";
        		echo "</div";
        	}
    	}

    	else if( $page == 1 ) {

    		if ($pages > $page) {
    			$page = $page + 1;
    		}

        	echo "<a href = \"$_SERVER[PHP_SELF]?page=$page\">Inainte</a>";
    	}

		echo "<table class = \"vizite\">";
		echo "</br>";
        echo "<th><td>ID</td><td>Data</td><td>Ora</td><td>Nume detinut</td><td>Prenume detinut</td><td>Natura vizitei</td><td>Relatia cu detinutul</td></th>";
		
		while ($row = $result->fetch_assoc()) {

			echo "<tr><td>".$row['ID']."</td><td>".$row['DATA_VIZITEI']."</td><td>12:00</td><td>".$row['NUME']."</td><td>".$row['PRENUME']."</td><td>".$row['NATURA_VIZITEI']."</td><td>".$row['RELATIA_DETINUT']."</td></tr>";
		}

		echo "</table>";
	}
}
?>